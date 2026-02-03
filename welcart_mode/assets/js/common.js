( function( $ ) {

	$( function() {

		$( '.site-content input[type=checkbox]' ).after( '<span class="checkmark"></span>' );
		$( '.site-content input[type=radio]' ).after( '<span class="radiomark"></span>' );

	});


	$(function(){
		var selectBox = $('ul.is-child')
		var display = $('.selected-category')

		display.on('click',function(){
			selectBox.fadeToggle('fast');
			return false;
		})

	})
	
	// アドミンバーがある時のヘッダー固定
	$(window).scroll(function() {
	var sitetop = $(this).scrollTop();
		if ( sitetop < 46 ) {
			$('.admin-bar #site').addClass('loginbar');
		} else {
			$('.admin-bar #site').removeClass('loginbar');
		}
	});


	$( function() {
		var pair = location.search.substring(1).split('&');
		var arg = new Object;
		for( var i = 0; pair[i]; i++ ) {
			var kv = pair[i].split('=');
			arg[kv[0]] = kv[1];
		}
		if( undefined != arg.from_item && undefined != arg.from_sku ) {
			$('.wpcf7-submit').on('click', function() {
				var form = $(this).parents('form');
				form.attr('action', $(this).data('action'));
				$('<input>').attr({
					'type': 'hidden',
					'name': 'from_item',
					'value': arg.from_item
				}).appendTo(form);
				$('<input>').attr({
					'type': 'hidden',
					'name': 'from_sku',
					'value': arg.from_sku
				}).appendTo(form);
			});
		}
	});

	$( '#toTop' ).hide();
	$( window ).scroll( function () {
		if ( $( this ).scrollTop() > 100 ) {
			$( '#toTop' ).fadeIn();
		} else {
			$( '#toTop' ).fadeOut();
		}
	});

	$( '#toTop a' ).click( function() {
		var speed = 800;
		var href = $( this ).attr( "href" );
		var target = $( href === "#masthead" || href === "" ? 'html' : href );
		var position = target.offset().top;
		$( "html, body" ).animate( { scrollTop:position }, speed, "swing" );
		return false;
	});


} )( jQuery );