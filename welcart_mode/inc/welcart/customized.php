<?php
/**
 * Welcart - Customized
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Icon Dirs
 */
function welcart_mode_icon_dirs() {

	if ( file_exists( get_stylesheet_directory() . '/assets/images/default.png' ) ) {

		$icon_dir     = get_stylesheet_directory() . '/assets/images';
		$icon_dir_uri = get_stylesheet_directory_uri() . '/assets/images';

	} else {

		$icon_dir     = get_template_directory() . '/assets/images';
		$icon_dir_uri = get_template_directory_uri() . '/assets/images';

	}
	$icon_dirs = array( $icon_dir => $icon_dir_uri );

	return $icon_dirs;

}
add_filter( 'icon_dirs', 'welcart_mode_icon_dirs' );

/**
 * Plugin Hook Remove
 * フィルターフックに付加されている関数の除去
 * WCEX Mobile
 */
remove_filter( 'usces_filter_cart_row', 'wcmb_cart_row_of_smartphone_wct', 10, 3 );
remove_filter( 'usces_filter_confirm_row', 'wcmb_confirm_row_of_smartphone_wct', 10, 3 );

/**
 * The Post
 */
function welcart_mode_the_post() {
	global $post;

	if ( 'item' === $post->post_mime_type ) {
		if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
			$product           = wel_get_product( $post->ID );
			$select_sku_switch = ( ! empty( $product['select_sku_switch'] ) ) ? (int) $product['select_sku_switch'] : 0;
			if ( ! defined( 'WCEX_SKU_SELECT' ) || 1 !== (int) $select_sku_switch ) {
				remove_action( 'usces_action_single_item_outform', 'wcad_action_single_item_outform' );
				add_action( 'usces_action_single_item_outform', 'welcart_mode_action_single_item_outform' );
			} else {
				add_filter( 'wcex_sku_select_filter_single_item_autodelivery', 'welcart_mode_single_item_autodelivery_sku_select' );
			}
		}
	}
}
add_action( 'the_post', 'welcart_mode_the_post', 9 );

/**
 * wc_review()
 * 商品レビューリストの遷移
 */
if ( ! function_exists( 'wc_review' ) ) :
	/**
	 * Welcart Review
	 *
	 * @param string $comment Review Comment.
	 * @param array  $args Review Array.
	 * @param int    $depth Review Depth.
	 * @return void
	 */
	function wc_review( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'comment':
				?>
		<li <?php comment_class(); ?> id="li-review-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">

				<?php if ( '0' === $comment->comment_approved ) : ?>

				<em><?php esc_html_e( 'Thank you for the review. Please wait for a while until it is published.', 'welcart_mode' ); ?></em>
				<br />

			<?php else : ?>

				<div class="review-info">
					<div class="review-author vcard">
						<?php /* translators: */ printf( wp_kses_post( __( '%s <span>says</span>', 'welcart_mode' ) ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .review-author .vcard -->
					<div class="review-meta reviewmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( esc_html__( '%1$s at %2$s', 'welcart_mode' ), esc_html( get_comment_date() ), '' );
						?>
							</a>
							<?php
							edit_comment_link( __( '(Edit)', 'welcart_mode' ), ' ' );
							?>
					</div><!-- .review-meta .reviewmetadata -->
				</div>
				<div class="review-body"><?php comment_text(); ?></div>

			<?php endif; ?>

		</div><!-- #review-##  -->

				<?php
				break;
		endswitch;
	}
endif;

/**
 * Login Inform Referer
 */
function welcart_mode_login_inform_referer() {
	if ( isset( $_REQUEST['login_ref'] ) && ! empty( $_REQUEST['login_ref'] ) ) {
		echo '<input type="hidden" name="login_ref" value="' . esc_url( urldecode( $_REQUEST['login_ref'] ) ) . '" >' . "\n";
	}
}
add_action( 'usces_action_login_page_inform', 'welcart_mode_login_inform_referer' );

/**
 * After Login Redirect
 */
function welcart_mode_after_login_redirect() {
	if ( isset( $_REQUEST['login_ref'] ) && ! empty( $_REQUEST['login_ref'] ) ) {
		wp_redirect( esc_url( $_REQUEST['login_ref'] . '#wc_reviews' ) );
		exit;
	}
}
add_action( 'usces_action_after_login', 'welcart_mode_after_login_redirect' );

/**
 * Get Inquiry URL
 *
 * @return string
 */
function welcart_mode_get_inquiry_link_url() {

	if ( defined( 'WPCF7_VERSION' ) ) {
		global $post;

		$item_id  = $post->ID;
		$sku_code = urlencode( usces_the_itemSku( 'return' ) );
		$url      = add_query_arg(
			array(
				'from_item' => $item_id,
				'from_sku'  => $sku_code,
			),
			get_permalink( mode_get_options( 'inquiry_link' ) )
		);

	} else {

		$url = get_permalink( mode_get_options( 'inquiry_link' ) );

	}
	return $url;

}
if ( defined( 'WPCF7_VERSION' ) ) {
	add_filter( 'wpcf7_mail_components', 'welcart_mode_mail_components', 10, 3 );
	/**
	 * Mail Components
	 *
	 * @param object $components Components.
	 * @param object $current_form Current Form.
	 * @param object $mail_object Mail Object.
	 * @return object
	 */
	function welcart_mode_mail_components( $components, $current_form, $mail_object ) {
		global $usces;

		$post_id = isset( $_POST['from_item'] ) ? $_POST['from_item'] : '';
		if ( strlen( $post_id ) > 0 ) {
			$itemname = $usces->getItemName( $post_id );
			$skucode  = isset( $_POST['from_sku'] ) ? $_POST['from_sku'] : '';
			$skuname  = ( strlen( $skucode ) > 0 ) ? $usces->getItemSkuDisp( $post_id, $skucode ) : '';

			$body = $components['body'];

			if ( strlen( $itemname ) > 0 && strlen( $skuname ) > 0 ) {
				$components['body'] = __( 'item name', 'usces' ) . __( ' : ', 'usces' ) . $itemname . ' ' . $skuname . "\n" . $body;
			} elseif ( strlen( $itemname ) > 0 ) {
				$components['body'] = __( 'item name', 'usces' ) . __( ' : ', 'usces' ) . $itemname . "\n" . $body;
			}
		}
		return $components;
	}
}

/**
 * Cart Prebutton
 *
 * @param string $link Cart Prebutton.
 * @return string
 */
function welcart_mode_cart_prebutton( $link ) {
	if ( mode_get_options( 'continue_shopping_button' ) ) {
		$url = mode_get_options( 'continue_shopping_url' );
		if ( empty( $url ) ) {
			$url = esc_url( home_url( '/' ) );
		}
		$link = ' onclick="location.href=\'' . $url . '\'"';
	}
	return $link;
}
add_filter( 'usces_filter_cart_prebutton', 'welcart_mode_cart_prebutton' );

/**
 * Assistance Item List
 *
 * @param array $list Item List.
 * @param array $post Item Post.
 * @return string
 */
function welcart_mode_assistance_item_list( $list, $post ) {
	$post_id = $post->ID;
	$sub_img = usces_get_itemSubImageNums( $post_id );

	$str  = '';
	$str .= '<li class="list">';
	$str .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . usces_the_itemName( 'return' ) . '">';
	$str .= '<div class="img square">';
	if ( ! empty( $sub_img ) ) {
		$str .= '<div class="overlay">' . usces_the_itemImage( 0, 300, 300, $post, 'return' ) . '' .
		'<span class="sub-img">' . usces_the_itemImage( 1, 300, 300, $post, 'return' ) . '</span></div>';
	} else {
		$str .= usces_the_itemImage( 0, 300, 300, $post, 'return' ) . '';
	}
	$str .= '</div>';
	$str .= '<div class="info">';
	$str .= '<h4>' . usces_the_itemName( 'return' ) . '</h4>';
	$str .= '<div class="price">' . usces_the_firstPriceCr( 'return' ) . usces_guid_tax( 'return' ) . '</div>';
	$str .= usces_crform_the_itemPriceCr_taxincluded( true, '', '', '', true, false, true, 'return' );
	$str .= '</div>';

	$str .= '</a>';
	$str .= '</li>';

	return $str;

}
add_filter( 'usces_filter_assistance_item_list', 'welcart_mode_assistance_item_list', 10, 2 );

/**
 * Featured Widget
 *
 * @param array  $list Widget List.
 * @param array  $post Widget Post.
 * @param object $list_index List Index.
 * @param object $instance Widget Instance.
 * @return string
 */
function welcart_mode_featured_widget( $list, $post, $list_index, $instance ) {
	global $usces;
	$post_id = $post->ID;
	$post    = get_post( $post_id );

	$list  = '';
	$list .= '<a href="' . get_permalink( $post_id ) . '">' . "\n";
	$list .= '<div class="img square">' . "\n";
	$list .= usces_the_itemImage( 0, 300, 300, $post, 'return' );
	$list .= '</div>' . "\n";
	$list .= '<div class="info">' . "\n";
	$list .= '<div class="name">' . $usces->getItemName( $post_id ) . '</div>' . "\n";
	$list .= '<div class="price">' . usces_crform( usces_the_firstPrice( 'return', $post ), true, false, 'return' ) . usces_guid_tax( 'return' ) . '</div>' . "\n";
	$list .= usces_crform_itemPriceCr_taxincluded( $post_id );
	if ( ! usces_have_zaiko_anyone( $post_id ) ) {
		$list .= '<div class="itemsoldout">' . welcart_mode_soldout_label( $post_id, 'return' ) . '</div>' . "\n";
	}
	$list .= '</div>' . "\n";
	$list .= '</a>' . "\n";

	return $list;
}
add_filter( 'usces_filter_featured_widget', 'welcart_mode_featured_widget', 10, 4 );

/**
 * Filter Bestseller
 *
 * @param array  $list List.
 * @param int    $post_id Post ID.
 * @param string $i I.
 * @return string
 */
function welcart_mode_filter_bestseller( $list, $post_id, $i ) {
	$post = get_post( $post_id );

	$list  = '<li class="bestseller-item rank' . ( $i + 1 ) . '">' . "\n";
	$list .= '<a href="' . get_permalink( $post_id ) . '">' . "\n";
	$list .= '<div class="rankimg">' . ( $i + 1 ) . '</div>' . "\n";
	$list .= '<div class="img square">' . usces_the_itemImage( 0, 300, 300, $post, 'return' ) . '</div>' . "\n";
	$list .= '<div class="info">' . "\n";
	$list .= '<div class="name">' . usces_the_itemName( 'return', $post ) . '</div>' . "\n";
	$list .= '<div class="price">' . usces_the_firstPriceCr( 'return', $post ) . usces_guid_tax( 'return' ) . '</div>' . "\n";
	$list .= usces_crform_itemPriceCr_taxincluded( $post_id );
	if ( ! usces_have_zaiko_anyone( $post_id ) ) {
		$list .= '<div class="itemsoldout">' . welcart_mode_soldout_label( $post_id, 'return' ) . '</div>' . "\n";
	}
	$list .= '</div>' . "\n";
	$list .= '</a>' . "\n";
	$list .= '</li>' . "\n";

	return $list;
}
add_filter( 'usces_filter_bestseller', 'welcart_mode_filter_bestseller', 10, 3 );

/**
 * Action Single Item Out Form
 * usces_action_single_item_outform
 */
function welcart_mode_action_single_item_outform() {
	global $post, $usces;

	if ( 'regular' === $usces->getItemChargingType( $post->ID ) ) :
		$product      = wel_get_product( $post->ID );
		$regular_unit = $product['wcad_regular_unit'];
		if ( 'day' === $regular_unit ) {
			$regular_unit_name = __( 'Daily', 'autodelivery' );
		} elseif ( 'month' === $regular_unit ) {
			$regular_unit_name = __( 'Monthly', 'autodelivery' );
		} else {
			$regular_unit_name = '';
		}
		$regular_interval  = $product['wcad_regular_interval'];
		$regular_frequency = $product['wcad_regular_frequency'];

		if ( usces_have_zaiko_anyone( $post->ID ) ) :
			usces_the_item();
			ob_start();
			?>
<div id="wc_regular">
	<p class="wcr_tlt"><?php esc_html_e( 'Regular Purchase', 'autodelivery' ); ?></p>
	<div class="field">
		<table class="autodelivery">
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_interval', __( 'Interval', 'autodelivery' ) ); ?></th><td><?php echo esc_html( $regular_interval ); ?><?php echo esc_html( $regular_unit_name ); ?></td></tr>
			<?php if ( 1 < (int) $regular_frequency ) : ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency', __( 'Frequency', 'autodelivery' ) ); ?></th><td><?php echo esc_html( $regular_frequency ); ?><?php esc_html_e( 'times', 'autodelivery' ); ?></td></tr>
		<?php else : ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency_free', __( 'Frequency', 'autodelivery' ) ); ?></th><td><?php echo apply_filters( 'wcad_filter_item_single_value_frequency_free', __( 'Free cycle', 'autodelivery' ) ); ?></td></tr>
		<?php endif; ?>
		</table>
	</div>

	<form action="<?php echo esc_url( USCES_CART_URL ); ?>" method="post">

			<?php while ( usces_have_skus() ) : ?>
		<div class="skuform">
				<?php if ( '' !== usces_the_itemSkuDisp( 'return' ) ) : ?>
			<div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
				<?php endif; ?>

				<?php if ( usces_is_options() ) : ?>
			<dl class="item-option">
					<?php while ( usces_have_options() ) : ?>
				<dt><?php usces_the_itemOptName(); ?></dt>
				<dd><?php wcad_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
					<?php endwhile; ?>
			</dl>
				<?php endif; ?>

				<?php usces_the_itemGpExp(); ?>

			<div class="field">
				<div class="zaikostatus"><?php esc_html_e( 'stock status', 'usces' ); ?> : <?php usces_the_itemZaikoStatus(); ?></div>
				<div class="field_price">
				<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
					<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
				<?php endif; ?>
					<?php wcad_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
				</div>
				<?php wcad_crform_the_itemPriceCr_taxincluded(); ?>
			</div>

				<?php if ( ! usces_have_zaiko() ) : ?>
			<div class="itemsoldout"><?php mode_options( 'soldout_text' ); ?></div>
			<?php else : ?>
			<div class="c-box">
				<span class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php wcad_the_itemQuant(); ?></span><span class="unit_regular"><?php usces_the_itemSkuUnit(); ?></span>
				<span class="cart-button"><?php wcad_the_itemSkuButton( __( 'Apply for a regular purchase', 'autodelivery' ), 0 ); ?></span>
			</div>
			<?php endif; ?>
			<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>
		</div><!-- .skuform -->
			<?php endwhile; ?>

			<?php echo apply_filters( 'wcad_single_item_multi_sku_after_field', null ); ?>
			<?php do_action( 'wcad_action_single_item_inform' ); ?>
	</form>
</div>
			<?php
			$html = ob_get_contents();
			ob_end_clean();

			$html = apply_filters( 'welcart_mode_filter_single_item_autodelivery', $html );
			echo $html;
		endif;
	endif;
}

/**
 * Single Item Auto Delivery & SKU Select
 * wcex_sku_select_filter_single_item_autodelivery
 *
 * @param string $html HTML form.
 * @return string
 */
function welcart_mode_single_item_autodelivery_sku_select( $html ) {
	global $post, $usces;

	if ( 'regular' === $usces->getItemChargingType( $post->ID ) ) :
		$product      = wel_get_product( $post->ID );
		$regular_unit = $product['wcad_regular_unit'];
		if ( 'day' === $regular_unit ) {
			$regular_unit_name = __( 'Daily', 'autodelivery' );
		} elseif ( 'month' === $regular_unit ) {
			$regular_unit_name = __( 'Monthly', 'autodelivery' );
		} else {
			$regular_unit_name = '';
		}

		$regular_interval  = $product['wcad_regular_interval'];
		$regular_frequency = $product['wcad_regular_frequency'];

		if ( usces_have_zaiko_anyone( $post->ID ) ) :
			usces_the_item();
			ob_start();
			?>
<div id="wc_regular">
	<p class="wcr_tlt"><?php esc_html_e( 'Regular Purchase', 'autodelivery' ); ?></p>
	<div class="field">
		<table class="autodelivery">
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_interval', __( 'Interval', 'autodelivery' ) ); ?></th><td><?php echo esc_html( $regular_interval ); ?><?php echo esc_html( $regular_unit_name ); ?></td></tr>
			<?php if ( 1 < (int) $regular_frequency ) : ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency', __( 'Frequency', 'autodelivery' ) ); ?></th><td><?php echo esc_html( $regular_frequency ); ?><?php esc_html_e( 'times', 'autodelivery' ); ?></td></tr>
			<?php else : ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency_free', __( 'Frequency', 'autodelivery' ) ); ?></th><td><?php echo apply_filters( 'wcad_filter_item_single_value_frequency_free', __( 'Free cycle', 'autodelivery' ) ); ?></td></tr>
			<?php endif; ?>
		</table>
	</div>

	<form action="<?php echo esc_url( USCES_CART_URL ); ?>" method="post">
		<div class="skuform" id="skuform_regular">

			<?php wcex_auto_delivery_sku_select_form(); ?>

			<?php if ( usces_is_options() ) : ?>
			<dl class="item-option">
				<?php while ( usces_have_options() ) : ?>
				<dt><?php usces_the_itemOptName(); ?></dt>
				<dd><?php wcad_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
				<?php endwhile; ?>
			</dl>
			<?php endif; ?>

			<div class="field">
				<div class="zaikostatus"><?php esc_html_e( 'stock status', 'usces' ); ?> : <span class="ss_stockstatus_regular"><?php usces_the_itemZaikoStatus(); ?></span></div>
				<div class="field_price">
				<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
					<span class="field_cprice ss_cprice_regular"><?php usces_the_itemCpriceCr(); ?></span>
				<?php endif; ?>
					<span class="sell_price ss_price_regular"><?php wcad_the_itemPriceCr(); ?></span><?php usces_guid_tax(); ?><span class="wcss_loading"></span>
				</div>
				<?php wcex_sku_select_crform_the_itemRPriceCr_taxincluded(); ?>
			</div>

			<?php wcex_sku_select_the_itemGpExp( '', true ); ?>

			<div id="checkout_box">
				<div class="itemsoldout"><?php mode_options( 'soldout_text' ); ?></div>
				<div class="c-box">
					<span class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php wcad_the_itemQuant(); ?></span><span class="unit_regular"><?php usces_the_itemSkuUnit(); ?></span>
					<span class="cart-button"><?php wcad_the_itemSkuButton( __( 'Apply for a regular purchase', 'autodelivery' ), 0 ); ?></span>
				</div>
			</div>
			<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>
		</div><!-- .skuform -->

			<?php echo apply_filters( 'welcart_single_item_multi_sku_after_field', null ); ?>
			<?php do_action( 'wcad_action_single_item_inform' ); ?>
	</form>
</div>
			<?php
			$html = ob_get_contents();
			ob_end_clean();
		endif;
	endif;

	$html = apply_filters( 'welcart_mode_filter_single_item_autodelivery_sku_select', $html );
	return $html;
}

/**
 * Filter Cart Thumbnail
 *
 * @param object $cart_thumbnail Cart Thumbnail.
 * @param int    $post_id Post ID.
 * @param int    $pictid Pict ID.
 * @param string $i I.
 * @param bool   $cart_row Cart Row.
 * @return string
 */
function welcart_mode_filter_cart_thumbnail( $cart_thumbnail, $post_id, $pictid, $i, $cart_row ) {
	global  $usces;

	if ( ! empty( $cart_row ) && isset( $cart_row['sku'] ) ) {
		$sku_code = urldecode( $cart_row['sku'] );
	} else {
		$sku_code = '';
	}
	$cart      = $usces->cart->get_cart();
	$item_code = $usces->getItemCode( $post_id );

	$subpictid = (int) $usces->get_subpictid( $sku_code );
	if ( $subpictid ) {
		$pictid = (int) $usces->get_subpictid( $sku_code );
	} else {
		$pictid = (int) $usces->get_mainpictid( $item_code );
	}
	$cart_thumbnail = '<a href="' . get_permalink( $post_id ) . '">' . wp_get_attachment_image( $pictid, array( 60, 60 ), true ) . '</a>';

	return $cart_thumbnail;
}
add_filter( 'usces_filter_cart_thumbnail', 'welcart_mode_filter_cart_thumbnail', 10, 5 );
