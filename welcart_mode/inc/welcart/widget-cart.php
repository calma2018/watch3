<?php
/**
 * Welcart - Widget Cart
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Get Cart Row
 *
 * @param object $html HTML.
 * @param object $cart Cart.
 * @return object
 */
function mode_widgetcart_get_cart_row( $html, $cart ) {

	global $usces;
	$cart        = $usces->cart->get_cart();
	$total_price = $usces->get_total_price( $cart );
	$total_quant = $usces->get_total_quantity( $cart );
	$row_num     = count( (array) $cart );
	$html        = '';
	$trush_icon  = apply_filters( 'widgetcart_cart_row_trush_icon', get_template_directory_uri() . '/assets/images/trash.svg' );

	if ( $row_num ) {
		$html .= '<div class="wdct_list_block">';
	} else {
		$html .= '<div class="wdct_list_block_none">';
	}

	if ( usces_is_login() && usces_is_membersystem_point() && mode_get_options( 'widget_cart_header' ) ) {
		$html .= '<div id="wgct_point_line"><span class="wgct_point_label">' . esc_html__( 'Your member points', 'widgetcart' ) . '</span> : <span class="wgct_point">' . usces_memberinfo( 'point', 'return' ) . '</span>pt</div>';
	}

	if ( $row_num ) {
		$table = '<table class="widgetcart_rows">';
		if ( $row_num ) {
			$table .= '<tr class="head"><th class="item">' . esc_html__( 'item name', 'usces' ) . '</th><th class="quant">' . esc_html__( 'Quantity', 'usces' ) . '</th><th class="price">' . esc_html__( 'Amount', 'usces' ) . '</th><th class="trush"></th></tr>';
			$i      = 0;
			foreach ( (array) $cart as $cart_row ) {
				$row_id           = $i;
				$post_id          = $cart_row['post_id'];
				$sku              = $cart_row['sku'];
				$sku_code         = urldecode( $cart_row['sku'] ); /* New */
				$quantity         = $cart_row['quantity'];
				$options          = ( ! empty( $cart_row['options'] ) ) ? $cart_row['options'] : array();
				$itemCode         = $usces->getItemCode( $post_id );
				$itemName         = $usces->getItemName( $post_id );
				$sku_name         = $usces->getItemSkuDisp( $post_id, $sku_code );
				$cartrow_itemname = apply_filters( 'widgetcart_cart_row_itemname', $itemName, $itemCode, $post_id, $sku_code, $sku_name );
				$cartItemName     = $usces->getCartItemName( $post_id, $sku_code );
				$skuPrice         = $cart_row['price'];
				$pictids          = $usces->get_pictids( $itemCode );

				$tr  = '<tr>';
				$tr .= '<td class="widgetcart_item"><a href="' . get_permalink( $post_id ) . '">' . esc_html( $cartrow_itemname ) . '</a></td>';
				$tr .= '<td class="widgetcart_quant">' . $quantity . '</td>';
				$tr .= '<td class="widgetcart_price">' . usces_crform( ( $skuPrice * $quantity ), true, false, 'return' ) . '</td>';
				$tr .= '<td class="widgetcart_trush">';
				if ( ! $usces->is_cart_page( isset( $_SERVER['REQUEST_URI'] ) ) ) {
					$tr .= '<a class="cart_trush" href="javascript:void(0)" onclick="return widgetcart.trashCart(' . $row_id . ', ' . $post_id . ', \'' . $sku . '\' )"><img height="12" src="' . $trush_icon . '" title="' . esc_attr__( 'Delete', 'usces' ) . '" /></a>';
					if ( is_array( $options ) && 0 < count( $options ) ) {
						foreach ( $options as $key => $value ) {
							if ( is_array( $value ) ) {
								foreach ( $value as $v ) {
									$tr .= '<input name="itemOption[' . $i . '][' . $post_id . '][' . $sku . '][' . $key . '][' . $v . ']" type="hidden" value="' . $v . '" />';
								}
							} else {
								$tr .= '<input name="itemOption[' . $i . '][' . $post_id . '][' . $sku . '][' . $key . ']" type="hidden" value="' . $value . '" />';
							}
						}
					}
				}
				$tr       .= '</td>';
				$tr       .= '</tr>';
				$materials = compact( 'i', 'cart_row', 'post_id', 'sku', 'sku_code', 'quantity', 'options', 'itemCode', 'itemName', 'cartItemName', 'skuPrice', 'pictids' );
				$table    .= apply_filters( 'widgetcart_cart_row_tr', $tr, $materials );
				$i++;
			}
		}
		$table .= '</table>';
		$html  .= apply_filters( 'widgetcart_filter_table', $table, $cart );
	}

	$html .= '</div>';
	if ( $row_num ) {
		$html .= '<div class="checkout_block">';
	} else {
		$html .= '<div class="checkout_block_none">';
	}

	if ( $row_num ) {
		$total_price_label = apply_filters( 'widgetcart_filter_total_price_label', __( 'total items', 'usces' ) );
		$total_price       = apply_filters( 'widgetcart_filter_total_price', $total_price, $cart );
		$html             .= '<dl id="wgct_total_price"><dt>' . $total_price_label . '</dt><dd>' . usces_crform( $total_price, true, false, 'return' ) . '&nbsp;' . $usces->getGuidTax() . '</dd></dl>';
	}

	if ( $row_num ) {
		$head = '<div id="wdgctToCart"><a href="' . USCES_CART_URL . '">' . esc_html__( 'Change amount', 'widgetcart' ) . '</a></div>';
	} else {
		$head = '<div class="empty_cart">' . esc_html__( 'There are no items in your cart.', 'usces' ) . '</div>';
	}
	$html .= apply_filters( 'widgetcart_filter_head', $head, $cart );

	if ( $row_num ) {
		$button = '<div id="wdgctToCheckout"><a href="' . USCES_CUSTOMER_URL . '">' . esc_html__( 'Proceed to checkout', 'usces' ) . '</a></div>';
	} else {
		$button = '';
	}

	$html .= apply_filters( 'widgetcart_filter_button', $button, $cart );

	$html .= '</div>';
	$res   = $html;

	return $res;

}
add_filter( 'widgetcart_get_cart_row', 'mode_widgetcart_get_cart_row', 10, 2 );

/**
 * Total Quant
 *
 * @param object $html HTML.
 * @param object $cart Cart.
 * @return object
 */
function welcart_mode_widgetcart_total_quant( $html, $cart ) {
	global $usces;
	$quant = $usces->get_total_quantity( $cart );

	$html .= '
	<script type="text/javascript">
		jQuery(".total-quantity").html("' . $quant . '");
	</script>';

	return $html;
}
add_filter( 'widgetcart_get_cart_row', 'welcart_mode_widgetcart_total_quant', 10, 2 );

/**
 * Init
 *
 * @return void
 */
function welcart_mode_widgetcart_init() {
	if ( is_admin() || ! defined( 'WCEX_WIDGET_CART_VERSION' ) ) {
		return;
	}

	if ( version_compare( WCEX_WIDGET_CART_VERSION, '1.2.2', '<' ) ) {
		remove_filter( 'usces_filter_uscesL10n', 'widgetcart_filter_uscesL10n' );
		add_filter( 'usces_filter_uscesL10n', 'welcart_mode_widgetcart_uscesL10n' );
	}
}
add_action( 'init', 'welcart_mode_widgetcart_init', 99 );

/**
 * UscesL10n
 *
 * @return object
 */
function welcart_mode_widgetcart_uscesL10n() {
	global $usces;

	if ( $usces->is_cart_or_member_page( isset( $_SERVER['REQUEST_URI'] ) ) || $usces->is_inquiry_page( isset( $_SERVER['REQUEST_URI'] ) ) ) {
		echo "'widgetcartUrl': '" . esc_url( WCEX_WIDGET_CART_URL ) . "',\n";
		echo "'widgetcartHome': '" . esc_url( USCES_SSL_URL ) . "',\n";
	} else {
		echo "'widgetcartUrl': '" . esc_url( WCEX_WIDGET_CART_URL ) . "',\n";
		echo "'widgetcartHome': '" . esc_html( get_option( 'home' ) ) . "',\n";
	}
	echo "'widgetcartMes01': '" . esc_html__( 'Added to the cart.', 'widgetcart' ) . '<div id="wdgctToCheckout"><a href="' . esc_url( USCES_CUSTOMER_URL ) . '">' . esc_html__( 'Proceed to checkout', 'usces' ) . '</a></div>' . "',\n";
	echo "'widgetcartMes02': '" . esc_html__( 'Deleted from the cart.', 'widgetcart' ) . "',\n";
	echo "'widgetcartMes03': '" . esc_html__( 'Putting this article in the cart.', 'widgetcart' ) . "',\n";
	echo "'widgetcartMes04': '" . esc_html__( 'Please wait for a while.', 'widgetcart' ) . "',\n";
	echo "'widgetcartMes05': '" . esc_html__( 'Deleting an article from the cart.', 'widgetcart' ) . "',\n";
	echo "'widgetcart_fout': 5000,\n";

	return '';
}
