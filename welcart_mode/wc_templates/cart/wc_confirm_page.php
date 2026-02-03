<?php
/**
 * Cart - Confirm Page
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
						<li><?php esc_html_e( '1.Cart', 'usces' ); ?></li>
						<li><?php esc_html_e( '2.Customer Info', 'usces' ); ?></li>
						<li><?php esc_html_e( '3.Deli. & Pay.', 'usces' ); ?></li>
						<li class="current"><h2><?php esc_html_e( '4.Confirm', 'usces' ); ?></h2></li>
					</ul>
				</nav>

				<div class="column1080">

					<div class="header_explanation">
						<?php do_action( 'usces_action_confirm_page_header' ); ?>
					</div><!-- .header_explanation -->

					<div class="error_message"><?php usces_error_message(); ?></div>


					<div class="currency_code"><?php esc_html_e( 'Currency', 'usces' ); ?> : <?php usces_crcode(); ?></div>
					<table cellspacing="0" id="cart-table">
						<thead>
						<tr>
							<th scope="row" class="num"><?php esc_html_e( 'No.', 'usces' ); ?></th>
							<th class="thumbnail"></th>
							<th class="productname"><?php esc_html_e( 'item name', 'usces' ); ?></th>
							<th class="price"><?php esc_html_e( 'Unit price', 'usces' ); ?></th>
							<th class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?></th>
							<th class="subtotal"><?php esc_html_e( 'Amount', 'usces' ); ?></th>
							<th class="action"></th>
						</tr>
						</thead>
						<tbody>
							<?php usces_get_confirm_rows(); ?>
						</tbody>
						<tfoot>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<th colspan="2" class="aright"><?php esc_html_e( 'total items', 'usces' ); ?></th>
							<th colspan="2" class="aright amount"><?php usces_crform( $usces_entries['order']['total_items_price'], true, false ); ?></th>
							<td class="action"></td>
						</tr>
					<?php if ( ! empty( $usces_entries['order']['discount'] ) ) : ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<td colspan="2" class="aright"><?php echo apply_filters( 'usces_confirm_discount_label', __( 'Campaign disnount', 'usces' ) ); ?></td>
							<td colspan="2" class="aright" style="color:#FF0000"><?php usces_crform( $usces_entries['order']['discount'], true, false ); ?></td>
							<td class="action"></td>
						</tr>
					<?php endif; ?>
					<?php if ( usces_is_tax_display() && 'products' === usces_get_tax_target() ) : ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<td colspan="2" class="aright"><?php usces_tax_label(); ?></td>
							<td colspan="2" class="aright"><?php usces_tax( $usces_entries ); ?></td>
							<td class="action"></td>
						</tr>
					<?php endif; ?>
					<?php if ( usces_is_member_system() && usces_is_member_system_point() && ! empty( $usces_entries['order']['usedpoint'] ) && 0 === usces_point_coverage() ) : ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<td colspan="2" class="aright"><?php esc_html_e( 'Used points', 'usces' ); ?></td>
							<td colspan="2" class="aright" style="color:#FF0000"><?php echo number_format( $usces_entries['order']['usedpoint'] ); ?></td>
							<td class="action"></td>
						</tr>
					<?php endif; ?>
					<?php if ( welcart_mode_have_shipped() ) : ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<td colspan="2" class="aright"><?php esc_html_e( 'Shipping', 'usces' ); ?></td>
							<td colspan="2" class="aright"><?php usces_crform( $usces_entries['order']['shipping_charge'], true, false ); ?></td>
							<td class="action"></td>
						</tr>
					<?php endif; ?>
					<?php if ( ! empty( $usces_entries['order']['cod_fee'] ) ) : ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<td colspan="2" class="aright"><?php echo apply_filters( 'usces_filter_cod_label', __( 'COD fee', 'usces' ) ); ?></td>
							<td colspan="2" class="aright"><?php usces_crform( $usces_entries['order']['cod_fee'], true, false ); ?></td>
							<td class="action"></td>
						</tr>
					<?php endif; ?>
					<?php if ( usces_is_tax_display() && 'all' === usces_get_tax_target() ) : ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<td colspan="2" class="aright"><?php usces_tax_label(); ?></td>
							<td colspan="2" class="aright"><?php usces_tax( $usces_entries ); ?></td>
							<td class="action"></td>
						</tr>
					<?php endif; ?>
					<?php if ( usces_is_member_system() && usces_is_member_system_point() && ! empty( $usces_entries['order']['usedpoint'] ) && 1 === usces_point_coverage() ) : ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<td colspan="2" class="aright"><?php esc_html_e( 'Used points', 'usces' ); ?></td>
							<td colspan="2" class="aright" style="color:#FF0000"><?php echo number_format( $usces_entries['order']['usedpoint'] ); ?></td>
							<td class="action"></td>
						</tr>
					<?php endif; ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<th colspan="2" class="aright"><?php esc_html_e( 'Total Amount', 'usces' ); ?></th>
							<th colspan="2" class="aright amount"><?php usces_crform( $usces_entries['order']['total_full_price'], true, false ); ?></th>
							<th class="action"></th>
						</tr>
						</tfoot>
					</table>

					<?php do_action( 'usces_action_confirm_table_after' ); ?>

					<?php if ( usces_is_member_system() && usces_is_member_system_point() && usces_is_login() && welcart_mode_is_available_point() ) : ?>
						<form action="<?php usces_url( 'cart' ); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">

							<div class="error_message"><?php usces_error_message(); ?></div>
							<table cellspacing="0" id="point_table">
								<tr>
									<td class="c-point"><?php esc_html_e( 'The current point', 'usces' ); ?></td>
									<td><span class="point"><?php echo esc_html( $usces_members['point'] ); ?></span>pt</td>
								</tr>
								<tr>
									<td class="u-point"><?php esc_html_e( 'Points you are using here', 'usces' ); ?></td>
									<td><input name="offer[usedpoint]" class="used_point" type="text" value="<?php echo esc_attr( $usces_entries['order']['usedpoint'] ); ?>" />pt</td>
								</tr>
								<tr>
									<td colspan="2" class="point-btn"><input name="use_point" type="submit" class="use_point_button" value="<?php esc_html_e( 'Use the points', 'usces' ); ?>" /></td>
								</tr>
							</table>
							<?php do_action( 'usces_action_confirm_page_point_inform' ); ?>

						</form>
					<?php endif; ?>


					<?php do_action( 'usces_action_confirm_after_form' ); ?>


					<table id="confirm-table">
						<tr class="ttl">
							<td colspan="2"><h3><?php esc_html_e( 'Customer Information', 'usces' ); ?></h3></td>
						</tr>
						<tr>
							<th><?php esc_html_e( 'e-mail adress', 'usces' ); ?></th>
							<td><?php echo esc_html( $usces_entries['customer']['mailaddress1'] ); ?></td>
						</tr>

						<?php uesces_addressform( 'confirm', $usces_entries, 'echo' ); ?>

						<tr class="ttl">
							<td colspan="2"><h3><?php esc_html_e( 'Others', 'usces' ); ?></h3></td>
						</tr>
						<?php if ( welcart_mode_have_shipped() ) : ?>
							<tr>
								<th><?php esc_html_e( 'shipping option', 'usces' ); ?></th>
								<td><?php echo esc_html( usces_delivery_method_name( $usces_entries['order']['delivery_method'], 'return' ) ); ?></td>
							</tr>
							<tr>
								<th><?php esc_html_e( 'Delivery date', 'usces' ); ?></th>
								<td><?php echo esc_html( $usces_entries['order']['delivery_date'] ); ?></td>
							</tr>
							<tr>
								<th><?php esc_html_e( 'Delivery Time', 'usces' ); ?></th>
								<td><?php echo esc_html( $usces_entries['order']['delivery_time'] ); ?></td>
							</tr>
						<?php endif; ?>
						<tr>
							<th><?php esc_html_e( 'payment method', 'usces' ); ?></th>
							<td><?php echo esc_html( $usces_entries['order']['payment_name'] . usces_payment_detail( $usces_entries ) ); ?></td>
						</tr>
						<?php usces_custom_field_info( $usces_entries, 'order', '' ); ?>
						<tr class="notes">
							<th><?php esc_html_e( 'Notes', 'usces' ); ?></th>
							<td><?php echo nl2br( esc_html( $usces_entries['order']['note'] ) ); ?></td>
						</tr>
						<?php if ( welcart_mode_have_dlseller_content() ) : ?>
							<tr>
								<th><?php esc_html_e( 'Terms of Use', 'dlseller' ); ?></th>
								<td><?php echo esc_html( $usces_entries['order']['terms'] ? __( 'Agree', 'welcart_mode' ) : '' ); ?></td>
							</tr>
						<?php endif; ?>
					</table>

					<?php do_action( 'usces_action_confirm_page_notes' ); ?>

					<?php usces_purchase_button(); ?>

					<div class="footer_explanation">
						<?php do_action( 'usces_action_confirm_page_footer' ); ?>
					</div><!-- .footer_explanation -->


				</div>

			</article>
		</div>


	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
