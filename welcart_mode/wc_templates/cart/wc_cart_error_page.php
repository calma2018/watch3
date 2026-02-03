<?php
/**
 * Cart - Cart Error Page
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<?php
	if ( have_posts() ) :
		usces_remove_filter();
		?>

		<div class="cart-page">
			<article class="post" id="wc_<?php usces_page_name(); ?>">

				<div class="column980">

					<header class="entry-cart-header">
						<div class="en">Completion Error</div>
						<h1 class="cart_page_title"><?php esc_html_e( 'Your order has not been completed', 'usces' ); ?></h1>
					</header>

					<div id="error-page">

						<div class="post">
							<?php uesces_get_error_settlement(); ?>
						</div><!-- .post -->

					</div><!-- #error-page -->

				</div>

			</article><!-- .post -->
		</div>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
