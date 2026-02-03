<?php
/**
 * Single Template for Features
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

			get_template_part( 'template-parts/content', 'features' );
		}
	} else {

		echo '<p class="no-post">' . esc_html__( 'Sorry, no posts matched your criteria.', 'usces' ) . '</p>';

	}

	?>

	<nav class="navigation single-post-navigation" role="navigation">
		<ul class="nav-links">
			<li class="nav-previous"><?php previous_post_link( '%link', '%title' ); ?></li>
			<li class="nav-next"><?php next_post_link( '%link', '%title' ); ?></li>
		</ul>
	</nav>

<?php
get_footer();
