<?php
/**
 * Member - New Member Page
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

		<article class="post" id="wc_<?php usces_page_name(); ?>">

			<div class="column980 member-signup">

				<header class="entry-member-header">
					<div class="en">Sign up</div>
					<h1 class="member_page_title"><?php esc_html_e( 'New enrollment form', 'usces' ); ?></h1>
				</header>

				<div class="header_explanation">
					<ul>
						<li><?php esc_html_e( 'All your personal information  will be protected and handled with carefull attention.', 'usces' ); ?></li>
						<li><?php esc_html_e( 'Your information is entrusted to us for the purpose of providing information and respond to your requests, but to be used for any other purpose. More information, please visit our Privacy  Notice.', 'usces' ); ?></li>
						<li><?php esc_html_e( 'The items marked with *, are mandatory. Please complete.', 'usces' ); ?></li>
						<li><?php esc_html_e( 'Please use Alphanumeric characters for numbers.', 'usces' ); ?></li>
					</ul>
					<?php do_action( 'usces_action_newmember_page_header' ); ?>
				</div><!-- .header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>

				<form action="<?php echo apply_filters( 'usces_filter_newmember_form_action', usces_url( 'member', 'return' ) ); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
					<table cellpadding="0" cellspacing="0" class="customer_form">
						<?php uesces_addressform( 'member', usces_memberinfo( null ), 'echo' ); ?>
						<tr class="email-row">
							<th scope="row"><em><?php esc_html_e( '*', 'usces' ); ?></em><?php esc_html_e( 'e-mail adress', 'usces' ); ?></th>
							<td colspan="2"><input name="member[mailaddress1]" id="mailaddress1" type="text" value="<?php usces_memberinfo( 'mailaddress1' ); ?>" readonly onfocus="this.removeAttribute('readonly');" /></td>
						</tr>
						<tr class="email-confirm-row">
							<th scope="row"><em><?php esc_html_e( '*', 'usces' ); ?></em><?php esc_html_e( 'E-mail address (for verification)', 'usces' ); ?></th>
							<td colspan="2"><input name="member[mailaddress2]" id="mailaddress2" type="text" value="<?php usces_memberinfo( 'mailaddress2' ); ?>" readonly onfocus="this.removeAttribute('readonly');" /></td>
						</tr>
						<tr class="password-row">
							<th scope="row"><em><?php esc_html_e( '*', 'usces' ); ?></em><?php esc_html_e( 'password', 'usces' ); ?></th>
							<td colspan="2"><input name="member[password1]" id="password1" type="password" value="<?php usces_memberinfo( 'password1' ); ?>" readonly onfocus="this.removeAttribute('readonly');" /><?php welcart_mode_password_policy_message(); ?></td>
						</tr>
						<tr class="password-confirm-row">
							<th scope="row"><em><?php esc_html_e( '*', 'usces' ); ?></em><?php esc_html_e( 'Password (confirm)', 'usces' ); ?></th>
							<td colspan="2"><input name="member[password2]" id="password2" type="password" value="<?php usces_memberinfo( 'password2' ); ?>" readonly onfocus="this.removeAttribute('readonly');" /></td>
						</tr>
					</table>

					<?php usces_agree_member_field(); ?>

					<div class="send">
						<?php usces_newmember_button( $member_regmode ); ?>
					</div>
					<?php do_action( 'usces_action_newmember_page_inform' ); ?>

				</form>

				<div class="footer_explanation">
					<?php do_action( 'usces_action_newmember_page_footer' ); ?>
				</div><!-- .footer_explanation -->

			</div>

		</article>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
