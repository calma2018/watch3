<?php
/**
 * Member - Member Completion Page
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

			<div class="column980 member-completion">

				<header class="entry-member-header">
					<div class="en">Completion</div>
					<h1 class="member_page_title"><?php esc_html_e( 'Completion', 'usces' ); ?></h1>
				</header>

				<div id="member_completion">

					<div class="header_explanation">
						<?php do_action( 'usces_action_membercompletion_page_header' ); ?>
					</div><!-- .header_explanation -->

					<?php
					$member_compmode = usces_page_name( 'return' );
					if ( 'newcompletion' === $member_compmode ) :
						?>

						<h2><?php esc_html_e( 'Thank you in new membership.', 'usces' ); ?></h2>

					<?php elseif ( 'editcompletion' === $member_compmode ) : ?>

						<h2><?php esc_html_e( 'Membership information has been updated.', 'usces' ); ?></h2>

					<?php elseif ( 'lostcompletion' === $member_compmode ) : ?>

						<h2><?php esc_html_e( 'I transmitted an email.', 'usces' ); ?></h2>
						<p><?php esc_html_e( 'Change your password by following the instruction in this mail.', 'usces' ); ?></p>

					<?php elseif ( 'changepasscompletion' === $member_compmode ) : ?>

						<h2><?php esc_html_e( 'Password has been changed.', 'usces' ); ?></h2>

					<?php endif; ?>

					<div class="footer_explanation">
						<?php do_action( 'usces_action_membercompletion_page_footer' ); ?>
					</div><!-- .footer_explanation -->

					<div class="send">
						<a href="<?php usces_url( 'member' ); ?>"><?php esc_html_e( 'to vist membership information page', 'usces' ); ?></a><br />
						<a href="<?php echo esc_url( home_url() ); ?>" class="back_to_top_button"><?php esc_html_e( 'Back to the top page.', 'usces' ); ?></a>
					</div>

				</div><!-- #member_completion -->

			</div>

		</article><!-- .post -->

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
