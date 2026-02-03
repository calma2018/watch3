( function( $ ) {

	$( window ).on( 'load', function() {

		var window_width = $( window ).width();
		if ( window_width < 880 ) {
			
			// .drawer-tabs > li:first の情報取得
			var tabs_1nth			= $( '.drawer-tabs' ).children( ':first' );
			var tabs_1nth_id		= tabs_1nth.attr( 'id' ).split('tab-item-');
			var tabs_1nth_replace	= 'menu-item-' + tabs_1nth_id[1];
			var navmenu_1nth	= $( '.global-navigation .menu' ).children( ':first' );
			var navmenu_1nth_id	= navmenu_1nth.attr( 'id' );
			var level = 0;

			// .drawer-tabs > li:first に '.current' 付与
			tabs_1nth.addClass( 'current' );

			// .global-navigation > li:first に 'current' 付与
			if ( tabs_1nth_replace === navmenu_1nth_id ) {
				navmenu_1nth.addClass( 'current' );
			}

			// .global-navigation > li.current 以外を非表示
			$( '.global-navigation .menu > li:not(.current)' ).hide();


			$( '.drawer-tabs li' ).click( function() {

				var tabs			= $( this ).attr( 'id' );
				var tabs_id			= tabs.split( 'tab-item-' );
				var tab_replace 	= '#menu-item-' + tabs_id[1];
				var navmeu_not_id	= $( '.global-navigation .menu > li:not( '+tab_replace+' )' )

				// タブ切り替えをおこなった際にリセットをかける
				$( '.menu-item-has-children' ).css( 'position', 'relative' );
				$( '.global-navigation' ).css( 'height', 'auto' );

				$( this ).addClass( 'current' );
				$( '.drawer-tabs li:not( #'+tabs+' )' ).removeClass( 'current' );

				navmeu_not_id.removeClass( 'current' );
				navmeu_not_id.hide();

				$( '.global-navigation ' + tab_replace ).fadeIn( 'slow' );

				level = 0;

			});

			var navmenu_has_child	= $( '.menu-item-has-children' ).children( 'a' );
			navmenu_has_child.after( '<span></span>' );

			$( navmenu_has_child ).next( 'span' ).click( function() {

				$( this ).next().slideToggle( 'fast' );
				$( this ).toggleClass( 'open' )

			});

		} else {

			$( '.drawer-tabs li' ).mouseenter( function() {

				var tabs			= $( this ).attr( 'id' );
				var tabs_id			= tabs.split( 'tab-item-' );
				var tab_replace 	= '#menu-item-' + tabs_id[1];
				var navmeu_not_id	= $( '.global-navigation .menu > li:not( '+tab_replace+' )' )

				// タブ切り替えをおこなった際にリセットをかける
				$( '.global-navigation' ).css( 'height', 'auto' );

				// タブメニュー ホバー時の「current」クラス付与
				$( this ).addClass( 'current' );

				// ホバーしていないタブメニューの「current」クラス削除
				$( '.drawer-tabs li:not( #'+tabs+' )' ).removeClass( 'current' );

				// 表示しないナビメニューの「open」クラス削除
				navmeu_not_id.removeClass( 'open' );

				// 表示ナビメニューに「open」クラス付与
				$( '.global-navigation ' + tab_replace ).addClass( 'open' );

			});

			$( '.global-navigation' ).mouseleave( function() {

				$( '.global-navigation ul.menu > li' ).removeClass( 'open' );
				$( '.drawer-tabs li' ).removeClass( 'current' );

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