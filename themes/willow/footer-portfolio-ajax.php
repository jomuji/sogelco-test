		
		<script type="text/javascript">
		;(function( $ ) {
			"use strict";

			$( document ).on( 'ready', function() {

				var inIframe = function() {
					try {
						return window.self !== window.top;
					} catch (e) {
						return true;
					}
				};

				if ( inIframe() ) {

					$( '.js-close-magnificpopup' ).on( 'click', function(e) {
						e.preventDefault();
						window.parent.closeMagnificPopup( window.frameElement );
					})

					$( window ).on( 'load', function() {
						window.parent.animateMagnificPopup( window.frameElement );
					});
				};
			});

		})( jQuery );
		</script>

	</body>

	<?php wp_footer(); ?>

</html>