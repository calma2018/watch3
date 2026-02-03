<?php
/**
 * Cart - Completion Page
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();

global $usces;
?>

	<?php
	if ( have_posts() ) :
		usces_remove_filter();
		?>

		<div class="cart-page">
			<article class="post" id="wc_<?php usces_page_name(); ?>">

				<div class="column980">

					<header class="entry-cart-header">
						<div class="en">Completion</div>
						<h1 class="cart_page_title"><?php esc_html_e( 'Completion', 'usces' ); ?></h1>
					</header>

					<div id="cart_completion">

						<h2><?php esc_html_e( 'It has been sent succesfully.', 'usces' ); ?></h2>

						<p><?php esc_html_e( 'Thank you for shopping.', 'usces' ); ?><br /><?php esc_html_e( "If you have any questions, please contact us by 'Contact'.", 'usces' ); ?></p>

						<div class="header_explanation">
							<?php do_action( 'usces_action_cartcompletion_page_header', $usces_entries, $usces_carts ); ?>
						</div><!-- .header_explanation -->

						<?php

						if ( defined( 'WCEX_DLSELLER' ) ) {
							dlseller_completion_info( $usces_carts );
						}

							usces_completion_settlement();
							do_action( 'usces_action_cartcompletion_page_body', $usces_entries, $usces_carts );

						?>

						<div class="footer_explanation">
							<?php do_action( 'usces_action_cartcompletion_page_footer', $usces_entries, $usces_carts ); ?>
						</div><!-- .footer_explanation -->

						<div class="send">
							<a href="<?php echo esc_url( home_url() ); ?>" class="back_to_top_button"><?php esc_html_e( 'Back to the top page.', 'usces' ); ?></a>
						</div>
						<?php echo apply_filters( 'usces_filter_conversion_tracking', null, $usces_entries, $usces_carts ); ?>

					</div><!-- #cart_completion -->


				</div>

			</article>
		</div>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
