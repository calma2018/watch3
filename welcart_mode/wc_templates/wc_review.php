<?php
/**
 * Review
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
	if ( usces_is_membersystem_state() ) :
		/* Only when you are logged in Welcart, the comment form is displayed. */
		if ( usces_is_login() ) :

			$formargs = array(
				'id_form'              => 'reviewform',
				'id_submit'            => 'submit',
				'title_reply'          => '',
				'title_reply_to'       => '',
				'cancel_reply_link'    => '',
				'label_submit'         => __( 'Submit a review', 'welcart_mode' ),
				'comment_field'        => '<p class="review-form-review"><label for="comment">' . __( 'Write a review for this product', 'welcart_mode' ) .
				'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
				'</textarea></p>',

				'must_log_in'          => '',
				'logged_in_as'         => '',
				'comment_notes_before' => '',
				'comment_notes_after'  => '',

				'fields'               => array(
					'author' =>
					'<p class="comment-form-author">' .
					'<label for="author">' . __( 'Nickname', 'welcart_mode' ) . '<span>（' . __( 'Nickname will be published.', 'welcart_mode' ) . '）</span></label> ' .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30" /></p>',
				),
			);
			comment_form( $formargs );

			else : /* if not Welcart login */
				?>

			<p class="nowc_reviews"><?php esc_html_e( 'When you log in you can post a review', 'welcart_mode' ); ?></p>
			<p class="reviews_btn"><a href="<?php echo esc_url( add_query_arg( array( 'login_ref' => urlencode( ( empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ) ), USCES_MEMBER_URL ) ); ?>"><?php esc_html_e( 'To login', 'welcart_mode' ); ?></a></p>

				<?php
			endif; /* end ! usces_is_login */
		endif; /* end ! usces_is_membersystem_state */
	?>

	</div><!-- #wc_reviews -->

	<?php
	endif; /* end ! comments_open */
