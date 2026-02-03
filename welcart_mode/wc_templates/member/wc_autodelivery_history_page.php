<?php
/**
 * Member - Auto Delivery History Page
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

			<div class="column980 member-page">

				<header class="entry-member-header">
					<h1 class="member_page_title"><?php esc_html_e( 'Regular Purchase', 'autodelivery' ); ?></h1>
				</header>

				<div id="memberinfo">

					<div class="header_explanation">
						<?php do_action( 'wcad_action_autodelivery_history_page_header' ); ?>
					</div><!-- .header_explanation -->

					<h2 class="information_title"><?php esc_html_e( 'Regular purchase information', 'autodelivery' ); ?></h2>
					<div class="currency_code"><?php esc_html_e( 'Currency', 'usces' ); ?> : <?php usces_crcode(); ?></div>

					<div class="error_message"><?php usces_error_message(); ?></div>

					<form action="<?php usces_url( 'member' ); ?>#autodelivery" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
						<?php welcart_mode_autodelivery_history(); ?>
						<input name="member_regmode" type="hidden" value="editmemberform" />
						<input name="member_id" type="hidden" value="<?php usces_memberinfo( 'ID' ); ?>" />
						<div class="send">
							<input name="back" type="button" value="<?php esc_html_e( 'Back to the member page.', 'autodelivery' ); ?>" onclick="location.href='<?php echo esc_url( USCES_MEMBER_URL ); ?>'" />
							<input name="top" type="button" value="<?php esc_html_e( 'Back to the top page.', 'usces' ); ?>" onclick="location.href='<?php echo esc_url( home_url() ); ?>'" />
						</div>
						<?php do_action( 'wcad_action_autodelivery_history_page_inform' ); ?>
					</form>

					<div class="footer_explanation">
						<?php do_action( 'wcad_action_autodelivery_history_page_footer' ); ?>
					</div>

				</div><!-- end of memberinfo -->

			</div><!-- .member-page -->

		</article><!-- end of post -->

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
