<?php
/**
 * Welcart - Short Code
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * WidgetCart Get Cart Row
 * [get-products num="4" cat="itemreco"]
 *
 * @param int    $atts Atts.
 * @param string $content Content.
 * @return object
 */
function getCatItems( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'num'    => 0,
			'column' => '4',
			'cat'    => 'item',
			'id'     => '',
		),
		$atts
	);

	$num      = (int) $atts['num'];
	$column   = $atts['column'];
	$cat_name = $atts['cat'];
	$id       = $atts['id'];
	$ret_html = '';

	$args = array(
		'post_type'     => 'post',
		'post_status'   => 'publish',
		'orderby'       => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
		'category_name' => $cat_name,
	);
	if ( ! empty( $num ) ) {
		$args['posts_per_page'] = $num;
	}
	if ( ! empty( $id ) ) {
		$ids              = array();
		$ids              = explode( ',', $id );
		$args['post__in'] = $ids;
	}
	$shortcode_query = new WP_Query( $args );
	if ( $shortcode_query->have_posts() ) {
		$ret_html .= '<div class="shortcode-products">';
		$ret_html .= '<div class="column-grid column-grid' . esc_attr( $column ) . '">';
		while ( $shortcode_query->have_posts() ) {
			$shortcode_query->the_post();
			$ret_html .= '<div class="list">';
			$ret_html .= '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '">';
			$ret_html .= '<div class="img square">';
			$ret_html .= usces_the_itemImage( 0, 300, 300, '', 'return' );
			if ( mode_get_produt_tag() ) {
				$ret_html .= mode_get_produt_tag();
			}
			$ret_html .= '</div>';
			$ret_html .= '<div class="info">';
			$ret_html .= '<h2>' . usces_the_itemName( 'return' ) . '</h2>';
			$ret_html .= '<div class="price">' . usces_the_firstPriceCr( 'return' ) . usces_guid_tax( 'return' ) . '</div>';
			$ret_html .= usces_crform_the_itemPriceCr_taxincluded( true, '', '', '', true, false, true, 'return' );
			$ret_html .= '</div>';
			$ret_html .= '</a>';
			$ret_html .= '</div>';
		}
		wp_reset_postdata();
		$ret_html .= '</div>';
		$ret_html .= '</div>';
	}
	return $ret_html;
}
add_shortcode( 'get-products', 'getCatItems' );
