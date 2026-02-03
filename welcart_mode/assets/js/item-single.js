( function( $ ) {

	$( function() {

		$( '.tabs-sp .entry-box:not( .select )' ).hide();
		$( '.tabs-sp .tabs li .label' ).on( 'click', function() {

			var num = $(this).parent('li').index();

			if ( $(this).parent( 'li' ).hasClass( 'active' ) ) {
				$( '.tabs-sp li' ).removeClass( 'active' );
				$( '.tabs-sp .entry-box' ).removeClass( 'select' );
				$( '.tabs-sp .entry-box' ).slideUp( 'fast' );
			} else {

				$( '.tabs-sp li' ).removeClass( 'active' );
				$( '.tabs-sp .entry-box' ).removeClass( 'select' );
				$( '.tabs-sp .entry-box' ).slideUp( 'fast' );

				$(this).parent( 'li' ).addClass( 'active' );
				$(this).parent( 'li' ).children( '.entry-box' ).addClass( 'select' );
				$(this).parent( 'li' ).children( '.entry-box' ).slideDown( 'fast' );

			}

			$( '.tabs-pc li' ).removeClass( 'active' );
			$( '.tabs-pc li' ).eq( num ).addClass( 'active' );

		});

		$( '.tabs-pc .tabs li' ).on( 'click', function() {

			var num = $( '.tabs-pc li' ).index(this);
			$( '.tabs-pc li' ).removeClass( 'active' );
			$( '.tabs-pc .entry-box' ).removeClass( 'select' );
			$( '.tabs-pc .entry-box' ).fadeOut( 'fast' );

			$( this ).addClass( 'active' );
			$( '.tabs-pc .entry-box' ).eq( num ).addClass( 'select' );
			$( '.tabs-pc .entry-box' ).eq( num ).fadeIn( 'fast' );

			$( '.tabs-sp li' ).removeClass( 'active' );
			$( '.tabs-sp li' ).eq( num ).addClass( 'active' );

		});


    });

} )( jQuery );