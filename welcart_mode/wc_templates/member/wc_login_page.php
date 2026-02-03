<?php
/**
 * Member - Login Page
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

			<div class="column980 member-login">

				<header class="entry-member-header">
					<div class="en">Login</div>
					<h1 class="member_page_title"><?php esc_html_e( 'Log-in for members', 'usces' ); ?></h1>
				</header>

				<div class="header_explanation">
					<?php do_action( 'usces_action_login_page_header' ); ?>
				</div><!-- .header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>


				<div class="loginbox">
					<form name="loginform" id="loginform" action="<?php echo apply_filters( 'usces_filter_login_form_action', USCES_MEMBER_URL ); ?>" method="post">

						<table>
							<tbody>
								<tr>
									<th><?php esc_html_e( 'e-mail adress', 'usces' ); ?></th>
									<td><input type="text" name="loginmail" id="loginmail" class="loginmail" value="<?php echo esc_attr( usces_remembername( 'return' ) ); ?>" size="20" /></td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'password', 'usces' ); ?></th>
									<td><input type="password" name="loginpass" id="loginpass" class="loginpass" size="20" autocomplete="off"/></td>
								</tr>
							</tbody>
						</table>

						<div class="forgetmenot">
							<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'memorize login information', 'usces' ); ?></label>
						</div>

						<div class="send submit">
							<?php usces_login_button(); ?>
							<a href="<?php usces_url( 'lostmemberpassword' ); ?>" title="<?php esc_html_e( 'Did you forget your password?', 'usces' ); ?>">
								<?php esc_html_e( 'Did you forget your password?', 'usces' ); ?>
							</a>
						</div>
						<?php do_action( 'usces_action_login_page_inform' ); ?>
					</form>

				</div><!-- loginbox -->

				<div class="entry-member">
					<h2><?php esc_html_e( 'Those who have not yet registered as a member', 'welcart_mode' ); ?></h2>
					<div id="nav">
						<a href="<?php usces_url( 'newmember' ) . apply_filters( 'usces_filter_newmember_urlquery', null ); ?>" title="<?php esc_html_e( 'New enrollment for membership.', 'usces' ); ?>">
							<?php esc_html_e( 'New enrollment for membership.', 'usces' ); ?>
						</a>
					</div>
				</div><!-- entry-member -->


				<div class="footer_explanation">
					<?php do_action( 'usces_action_login_page_footer' ); ?>
				</div><!-- .footer_explanation -->

			</div>

			<script type="text/javascript">
				<?php if ( usces_is_login() ) : ?>
						setTimeout( function(){ try{
						d = document.getElementById('loginpass');
						d.value = '';
						d.focus();
						} catch(e){}
						}, 200);
				<?php else : ?>
						try{document.getElementById('loginmail').focus();}catch(e){}
				<?php endif; ?>
			</script>

		</article>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
