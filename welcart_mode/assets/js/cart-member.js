( function( $ ) {

	$( function() {

		var sub_total_text = $('#cart-table th.subtotal').text();
		$('#cart-table tbody td.subtotal').attr( 'data-subtotal', sub_total_text);

	});


	$( function() {

		var tax_text = $('#history_head:first-child th.tax').text();
		var cod_text = $('#history_head:first-child th.cod').text();
		$('#history_head td.tax').attr( 'data-tax', tax_text);
		$('#history_head td.cod').attr( 'data-cod', cod_text);


	});


} )( jQuery );