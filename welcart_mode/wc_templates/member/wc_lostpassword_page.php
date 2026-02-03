<?php
/**
 * Member - Lost Password Page
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
					<div class="en">Login</div>
					<h1 class="member_page_title"><?php esc_html_e( 'The new password acquisition', 'usces' ); ?></h1>
				</header>

				<div class="header_explanation">
					<?php do_action( 'usces_action_newpass_page_header' ); ?>
				</div><!-- .header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>

				<div class="loginbox">

					<form name="loginform" id="loginform" action="<?php usces_url( 'member' ); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">

						<p><?php esc_html_e( 'Change your password by following the instruction in this mail.', 'usces' ); ?></p>
						<table>
							<tr>
								<th><?php esc_html_e( 'e-mail adress', 'usces' ); ?></th>
								<td><input type="text" name="loginmail" id="loginmail" class="loginmail" value="" size="20" /></td>
							</tr>
						</table>
						<div class="send submit">
							<input type="submit" name="lostpassword" id="member_login" value="<?php esc_attr_e( 'Obtain new password', 'usces' ); ?>" />
							<?php if ( ! usces_is_login() ) : ?>
								<a href="<?php usces_url( 'login' ); ?>" title="<?php esc_attr_e( 'Log-in', 'usces' ); ?>"><?php esc_html_e( 'Log-in', 'usces' ); ?></a>
							<?php endif; ?>
						</div>
						<?php do_action( 'usces_action_newpass_page_inform' ); ?>
					</form>

				</div>

				<div class="footer_explanation">
					<?php do_action( 'usces_action_newpass_page_footer' ); ?>
				</div><!-- .footer_explanation -->


				<script type="text/javascript">
					try{document.getElementById('loginmail').focus();}catch(e){}
				</script>

			</div>

		</article><!-- .post -->

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
