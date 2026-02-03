<?php
/**
 * Archive Template for Post
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();

echo '<header class="entry-head">';
the_archive_title( '<h1 class="page-title">', '</h1>' );
the_archive_description( '<div class="taxonomy-description">', '</div>' );
echo '</header><!-- .entry-head -->';

if ( have_posts() ) {

	$column        = mode_get_options( 'archives_list_column' );
	$archives_cont = mode_get_options( 'archives_cont' );
	$class         = '';
	$class        .= ' layout-list-column' . $column;

	if ( ! in_array( 'thumbnail', $archives_cont, true ) ) {
		$class .= ' not-thumbnail';
	}

	echo '<div class="post-group layout-list-column layout-list layout-list2' . esc_attr( $class ) . '">';

	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/loop/post' );
	}

	echo '</div>';

} else {

	echo '<p class="no-post">' . esc_html__( 'Sorry, no posts matched your criteria.', 'usces' ) . '</p>';

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
