<?php
/**
 * Cart - Cart Page
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

				<nav class="cart-navi">
					<ul>
						<li class="current"><h2><?php esc_html_e( '1.Cart', 'usces' ); ?></h2></li>
						<li><?php esc_html_e( '2.Customer Info', 'usces' ); ?></li>
						<li><?php esc_html_e( '3.Deli. & Pay.', 'usces' ); ?></li>
						<li><?php esc_html_e( '4.Confirm', 'usces' ); ?></li>
					</ul>
				</nav>

				<div class="column1080">

					<div class="header_explanation">
						<?php do_action( 'usces_action_cart_page_header' ); ?>
					</div><!-- .header_explanation -->

					<div class="error_message"><?php usces_error_message(); ?></div>

					<form action="<?php usces_url( 'cart' ); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">

						<?php if ( usces_is_cart() ) : ?>
							<div id="cart">

								<?php echo apply_filters( 'usces_theme_filter_upbutton', '<div class="upbutton"><span class="label">' . __( 'Press the `update` button when you change the amount of items.', 'usces' ) . '</span><input name="upButton" type="submit" value="' . __( 'Quantity renewal', 'usces' ) . '" onclick="return uscesCart.upCart()" /></div>' ); ?>
								<table cellspacing="0" id="cart-table">
									<thead>
										<tr>
											<th scope="row" class="num">No.</th>
											<th class="thumbnail"> </th>
											<th class="productname"><?php esc_html_e( 'item name', 'usces' ); ?></th>
											<th class="unitprice"><?php esc_html_e( 'Unit price', 'usces' ); ?></th>
											<th class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?></th>
											<th class="subtotal"><?php esc_html_e( 'Amount', 'usces' ); ?><?php usces_guid_tax(); ?></th>
											<th class="stock"><?php esc_html_e( 'stock status', 'usces' ); ?></th>
											<th class="action"></th>
										</tr>
									</thead>
									<tbody>
										<?php usces_get_cart_rows(); ?>
									</tbody>
									<tfoot>
										<tr>
											<th class="num"></th>
											<th class="thumbnail"></th>
											<th colspan="4" scope="row" class="aright"><?php esc_html_e( 'total items', 'usces' ); ?><?php usces_guid_tax(); ?></th>
											<th colspan="2" class="aright amount"><?php usces_crform( usces_total_price( 'return' ), true, false ); ?></th>
										</tr>
									</tfoot>
								</table>
								<div class="currency_code"><?php esc_html_e( 'Currency', 'usces' ); ?> : <?php usces_crcode(); ?></div>

								<?php if ( $usces_gp ) : ?>
									<div class="gp">
										<img src="<?php bloginfo( 'template_directory' ); ?>/images/gp.gif" alt="<?php esc_html_e( 'Business package discount', 'usces' ); ?>" />
										<span><?php esc_html_e( 'The price with this mark applys to Business pack discount.', 'usces' ); ?></span>
									</div>
								<?php endif; ?>

							</div><!-- #cart -->


						<?php else : ?>

							<div class="no_cart"><?php esc_html_e( 'There are no items in your cart.', 'usces' ); ?></div>

						<?php endif; ?>

						<div class="send"><?php usces_get_cart_button(); ?></div>
						<?php do_action( 'usces_action_cart_page_inform' ); ?>

					</form>


					<div class="footer_explanation">
						<?php do_action( 'usces_action_cart_page_footer' ); ?>
					</div><!-- .footer_explanation -->

				</div>

			</article>
		</div>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
