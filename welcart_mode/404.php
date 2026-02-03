<?php
/**
 * 404 Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<article class="error-404 not-found" id="post-<?php the_ID(); ?>">

		<header class="entry-header">

			<div class="en"><span>404</span>Not Found</div>
			<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'welcart_mode' ); ?></h1>

		</header>


		<div class="entry-content">

			<p><?php esc_html_e( 'There is nothing here. Please try the search.', 'welcart_mode' ); ?></p>

			<?php get_search_form(); ?>

		</div>

	</article>


<?php
get_footer();
