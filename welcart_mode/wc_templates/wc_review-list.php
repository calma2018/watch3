<?php
/**
 * Review List
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/* It does not display anything when you do not accept the comment. */
if ( comments_open() ) :
	?>

	<div id="wc_reviews">

	<?php
	/* If this product has review */
	if ( have_comments() ) :
		?>

		<ol class="wc_reviewlist cf">

		<?php
			$listargs = array(
				'type'     => 'comment',
				'callback' => 'wc_review',
			);
			wp_list_comments( $listargs );
			?>

		</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?> 
				<div id="review-paginate">
					<?php paginate_comments_links(); ?>
				</div><!-- #review-paginate -->
			<?php endif; ?>

	<?php else : /* or, if we don't have reviews */ ?>

		<p class="nowc_reviews"><?php esc_html_e( 'We hope that you will post a review.', 'welcart_mode' ); ?></p>

		<?php
		endif; /* end have_comments */
	?>

	</div><!-- #wc_reviews -->

	<?php
endif; /* end ! comments_open */
