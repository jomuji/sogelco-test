<?php

/*
 * Template Name: One Page
 * Description: Create the famous One Page site with binding scrolling navigation
 */

?>

<?php get_header(); ?>

<?php $is_using_vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<?php if ( $is_using_vc === 'true' ) : ?>

		<div id="page-<?php the_ID(); ?>" <?php post_class( 'visual-composer-page' ); ?>>

			<div class="section-anchor" data-anchor="remove" data-section="#header"></div>

			<?php the_content(); ?>

		</div>

	<?php else : ?>

		<section id="content" class="content-section section">
			<div class="container container-table">

				<div class="main-section" role="main">
					
					<div class="page-loop">

						<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
						</article>

					</div>

					<?php comments_template(); ?>

				</div>

				<?php get_sidebar(); ?>

			</div>
		</section>

	<?php endif; ?>

<?php endwhile; endif; ?>

<?php if ( willow_option( 'enable_preloader', 1 ) ) : ?>
	<div id="jpreContent">
		<div class="site-logo">
			<?php $preloader_logo = willow_option( 'preloader_logo' ); ?>

			<?php if ( ! empty( $preloader_logo ) ) : ?>
				<img src="<?php echo $preloader_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
			<?php else : ?>
				<span><?php bloginfo( 'name' ); ?></span>
			<?php endif ?>
		</div>
	</div>
<?php endif; ?>

<script type="text/javascript">
;(function( $ ) {
	"use strict";

	$( document ).on( 'ready', function() {

		var $anchors   = $( '.section > .section-anchor' ),
		    $menus     = $( '.menu-item > a' ),
		    offset     = 90,
		    HTMLOffset = parseInt( $( 'html' ).css( 'marginTop' ) ) + 1;

		$anchors.waypoint(function( direction ) {
			var $this    = $( this ),
			    anchor   = $this.data( 'anchor' ),
			    $section = $( $this.data( 'section' ) );

			if ( $section.length < 1 ) return;

			var id       = $section.attr( 'id' ),
			    $a       = $menus.filter( '[href$="#' + id + '"]' );

			// current
			if ( anchor == 'top' && direction == 'down' ) {
				$menus.removeClass( 'active-scroll' );
				$a.addClass( 'active-scroll' );
			}
			// before
			else if ( anchor == 'bottom' && direction == 'up' ) {
				$menus.removeClass( 'active-scroll' );
				$a.addClass( 'active-scroll' );
			}
			// remove
			else {
				$menus.removeClass( 'active-scroll' );
			}
		}, { offset: offset + HTMLOffset + 1 });

		window.clickAnchorLink = function( $a, e ) {
			var url = $a.attr( 'href' ),
			    hash = url.indexOf( '#' ),
			    $target = ( hash == -1 ) ? null : $( url.substring( hash ) );

			if ( $target && $target.length > 0 ) {
				e.preventDefault();

				var top = $target.offset().top;

				if ( top <= $( '.visual-composer-page' ).offset().top ) {
					offset = 90;
				} else {
					offset = 70;
				}
				
				$( 'body, html' ).animate({ scrollTop: top - offset - HTMLOffset }, 1000 );
			};
		};

		$( 'body' ).on( 'click', '.js-anchor-link', function( e ) {
			clickAnchorLink( $( this ), e );
		});

		$menus.on( 'click', function( e ) {
			clickAnchorLink( $( this ), e );
		});
	});

})( jQuery );
</script>

<?php get_footer(); ?>