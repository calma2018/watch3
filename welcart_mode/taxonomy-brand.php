<?php
/**
 * Taxonomy Template for Brand
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();

$term_slug     = get_query_var( 'term' );
$taxonomy_slug = get_query_var( 'taxonomy' );
$term          = get_term_by( 'slug', $term_slug, $taxonomy_slug );
$term_id       = $term->term_id;
$term_name     = $term->name;
$term_desc     = $term->description;
$current_page  = get_query_var( 'paged' );
$term_info     = '';
$term_info    .= '<div class="tax-info">';
$term_img      = get_term_meta( $term_id, 'brand-img-url', true );
if ( ! empty( $term_img ) ) {
	$term_info .= '<div class="brand-img"><img src="' . $term_img . '"></div>';
}
$name_sub = get_term_meta( $term_id, 'name_sub', 1 );
if ( ! empty( $name_sub ) ) {
	$class = ' title-small';
} else {
	$class = ' default';
}
$term_info .= '<header class="entry-head' . $class . '">';
$term_info .= '<h1 class="en">' . $term_name . '</h1>';
if ( ! empty( $name_sub ) ) {
	$term_info .= '<div class="sub">' . $name_sub . '</div>';
}
$term_info .= '</header>';
if ( ! empty( $term_desc ) ) {
	$term_info .= '<div class="brand-description">' . $term_desc . '</div>';
}
$term_info .= '</div>';

echo wp_kses_post( $term_info );

if ( have_posts() ) {

	$count_num    = $term->count;
	$current_page = 0 === $current_page ? '1' : $current_page;
	$max_pages    = $wp_query->max_num_pages;

	echo '<div class="brand-info">';
	echo '<h2 class="headline">' . esc_html( $term_name ) . esc_html__( 'Product List of', 'welcart_mode' ) . '</h2>';
	/* count items */
	echo '<div class="count-items"><span class="num">' . esc_html( $count_num ) . '</span>items</div>';

	echo '<div class="inbox">';
	/* pages */
	echo '<div class="pages-info">Page ' . esc_html( $current_page ) . ' of ' . esc_html( $max_pages ) . '</div>';
	$args           = array(
		'type'      => 'list',
		'prev_text' => __( ' &laquo; ' ),
		'next_text' => __( ' &raquo; ' ),
	);
	$paginate_links = paginate_links( $args );
	if ( $paginate_links ) {
		echo '<div class="pagination-wrap top">' . wp_kses_post( $paginate_links ) . '</div>';
	}
	echo '</div>';

	echo '</div>';

	$column = mode_get_options( 'item_list_column' );
	echo '<div class="product-group column-grid column-grid' . esc_attr( $column ) . '">';
	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/loop/product' );
	}
	echo '</div>';

} else {

	echo '<p class="no-post">' . esc_html__( 'The product was not found.', 'welcart_mode' ) . '</p>';

}

$args           = array(
	'type'      => 'list',
	'prev_text' => __( ' &laquo; ' ),
	'next_text' => __( ' &raquo; ' ),
);
$paginate_links = paginate_links( $args );
if ( $paginate_links ) {
	echo '<div class="pagination-wrap bottom">' . wp_kses_post( $paginate_links ) . '</div>';
}

get_footer();
