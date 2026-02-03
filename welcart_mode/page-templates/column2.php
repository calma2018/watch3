<?php
/**
 * Template Name: ２カラム固定ページ
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

<?php

if ( have_posts() ) {

	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content', get_post_type() );
	}
} else {

	echo '<p class="no-post">' . esc_html__( 'Sorry, no posts matched your criteria.', 'usces' ) . '</p>';

}

?>

<?php
get_footer();
