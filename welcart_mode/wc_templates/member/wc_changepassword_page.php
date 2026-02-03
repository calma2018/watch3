<?php
/**
 * Member - Change Password Page
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

			<div class="column980 member-pass">

				<header class="entry-member-header">
					<div class="en">Password</div>
					<h1 class="member_page_title"><?php esc_html_e( 'Change password', 'usces' ); ?></h1>
				</header>

				<div class="header_explanation">
					<?php do_action( 'usces_action_changepass_page_header' ); ?>
				</div><!-- .header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>

				<div class="loginbox">

					<form name="loginform" id="loginform" action="<?php usces_url( 'member' ); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
						<table>
							<tr>
								<th><?php esc_html_e( 'password', 'usces' ); ?></th>
								<td><input type="password" name="loginpass1" id="loginpass1" class="loginpass" value="" size="20" autocomplete="off"/><?php welcart_mode_password_policy_message(); ?></td>
							</tr>
							<tr>
								<th><?php esc_html_e( 'Password (confirm)', 'usces' ); ?></th>
								<td><input type="password" name="loginpass2" id="loginpass2" class="loginpass" value="" size="20" autocomplete="off"/></td>
							</tr>
						</table>

						<div class="send submit">
							<input type="submit" name="changepassword" id="member_login" value="<?php esc_attr_e( 'Register', 'usces' ); ?>" />
						</div>

						<?php do_action( 'usces_action_changepass_page_inform' ); ?>
					</form>

				</div>

				<div class="footer_explanation">
					<?php do_action( 'usces_action_changepass_page_footer' ); ?>
				</div><!-- .footer_explanation -->

				<script type="text/javascript">
					try{document.getElementById('loginpass1').focus();}catch(e){}
				</script>

			</div>

		</article>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>


<?php
get_footer();
