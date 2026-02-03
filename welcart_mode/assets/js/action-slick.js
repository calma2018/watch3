( function( $ ) {

	$( function() {

		// Features Slick
		// Both
		$( '.section-home .features-column-slide' ).slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			centerMode: false,
			arrows: false,
			speed: 600,
			focusOnSelect: false,
			mobileFirst: true,
			responsive: [{
				breakpoint: 620,
				settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						arrows: true,
					}
				}]
		});

		// Coordinates Slick
		// Both
		var column = $('.coordinate-column').data('column');
		$('.section-home .coordinates-column-slide').slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: true,
			centerMode: false,
			arrows: false,
			speed: 600,
			focusOnSelect: false,
			mobileFirst: true,
			responsive: [{
				breakpoint: 620,
				settings: {
						slidesToShow: column,
						slidesToScroll: 1,
						arrows: true,
					}
				}]
		});

		//item-single.php
		$('.gallery .itemimg .slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			centerMode: false,
			focusOnSelect: false,
			arrows: false,
			fade: true,
			asNavFor: '.itemimg-sub'
		});
		$('.gallery .itemimg-sub').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			speed: 600,
			asNavFor: '.itemimg .slider',
			centerMode: false,
			arrows: false,
			dots: false,
			focusOnSelect: true
		});

		$( '.gallery .itemimg' ).on( 'beforeChange', function( event, slick, currentSlide, nextSlide ) {
			if ($( '.gallery .itemimg-sub .slick-thumbnail-item' ).length < 5 ) {
				$('.gallery .itemimg-sub').slick('slickSetOption', 'centerMode', false, true );
			}
		});


	});



} )( jQuery );