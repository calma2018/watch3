( function( $ ) {
	
	$( window ).on( 'load resize', function() {
		
		var window_width		= window.innerWidth;
		var window_height		= $( window ).height();
		var header_height		= $( '.header-group' ).innerHeight();
		var shop_nav_height 	= $( '.shopping-navigation' ).innerHeight();


		if ( window_width < 880 ) {

			$( '.drawer-menu-sp' ).css({
				'display': 'none',
				'height': '100vh'
			});

			$( '.drawer-menu-sp > .in' ).css( 'padding-top', shop_nav_height + 'px' );
			$( '.open-check-sp' ).on( 'change', open_menu_check );

			// Reset .open-check-pc
			$( '.open-check-pc' ).removeAttr( 'checked' ).prop( 'checked', false ).change();
			$( '.drawer-menu-pc > .in' ).css( 'padding-top', '0' );

		} else {

			$( '.open-check-sp' ).removeAttr( 'checked' ).prop( 'checked', false ).change();
			$( '.open-check-sp' ).off( 'change' );
			
			$( '.drawer-menu-sp' ).removeClass( 'open' );
			$( '.drawer-menu-sp' ).css({
				'display': 'block',
				'height': 'auto'
			});
			$( '.drawer-menu-sp > .in' ).css( 'padding-top', '0' );
			
			
			$( '.drawer-menu-pc > .in' ).css( 'padding-top', shop_nav_height + 'px' );
			// .open-check-pc
			$( '.open-check-pc' ).on( 'change', function() {

				if ( $( this ).prop( 'checked' ) == true ) {

					$( '#site' ).addClass( 'open' );
					
				} else {

					$( '#site' ).removeClass( 'open' );
					
				}

			});

			// .drawe-bg-pc
			$( '.drawe-bg-pc' ).on( 'click', function() {

				$( '#site' ).removeClass( 'open' );
				$( '.open-check-pc' ).removeAttr( 'checked' ).prop( 'checked', false ).change();

			});

		}

	});

	window.addEventListener( "pageshow", function ( event ) {
		var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
		if ( historyTraversal ) {
			if ( $( '.open-check-pc' ).prop( 'checked' ) == true ) {
				$( '.open-check-pc' ).prop('checked', false).change();
			}
			if ( $( '.open-check-sp' ).prop( 'checked' ) == true ) {
				$( '.open-check-sp' ).prop('checked', false).change();
			}
		}
	});

	function open_menu_check() {

		if ( $( '.open-check-sp' ).prop( 'checked' ) == true ) {

			setTimeout( function() {
				$( '.drawer-menu-sp' ).stop().slideDown( 300 );
			}, 200 );

			setTimeout( function() {
				$( '.drawer-menu-sp' ).addClass( 'open' );
			}, 400 );
			$( '.drawer-menu-sp' ).css( 'visibility', 'unset' );

			var window_height		= $( window ).height();
			var header_height		= $( '.header-group' ).innerHeight();

			$( 'html' ).css({
				'overflow': 'hidden',
				'height': window_height + 'px'
			});

		} else {

			setTimeout( function() {
				$( '.drawer-menu-sp' ).removeClass( 'open' );
			}, 100 );

			setTimeout( function() {
				$( '.drawer-menu-sp' ).stop().slideUp( 300 );
			}, 200 );

			$( 'html' ).css({
				'overflow': 'scroll',
				'height': 'auto'
			});

		}

	}


} )( jQuery );