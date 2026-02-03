( function( $ ) {
	

	$( window ).on( 'load', function() {

		var window_width = $( window ).width();
		var navmenu_has_child	= $( '.menu-item-has-children' ).children( 'a' );

		if ( window_width < 880 ) {

			navmenu_has_child.after( '<span></span>' );

			$( navmenu_has_child ).next( 'span' ).click( function() {
				
				$( this ).next().slideToggle( 'fast' );
				$( this ).toggleClass( 'open' )
				
			});

		}

	});

	$( window ).on( 'resize', function() {

		var window_width = $( window ).width();

		if ( window_width > 880 ) {

			$( '.menu-item-has-children a + span' ).remove();

		}

	});


} )( jQuery );