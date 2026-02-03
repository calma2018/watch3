<?php
/**
 * The Content Product Loop template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

$item_cont = mode_get_options( 'item_cont' );
if ( ! is_array( $item_cont ) ) {
	$item_cont = array();
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php usces_the_itemName(); ?>">

		<div class="img square">
		<?php
		if ( in_array( 'item-img', $item_cont, true ) ) {
			$sub_img = usces_get_itemSubImageNums();
			if ( ! empty( $sub_img ) && ! wp_is_mobile() && mode_get_options( 'subimage_hover' ) ) {
				echo '<div class="overlay">' . wp_kses_post( usces_the_itemImage( 0, 500, 500, '', 'return' ) ) .
						'<span class="sub-img">' . wp_kses_post( usces_the_itemImage( 1, 500, 500, '', 'return' ) ) . '</span>
						</div>';
			} else {
				usces_the_itemImage( 0, 500, 500 );
			}
		}
		?>
		<?php do_action( 'usces_theme_favorite_icon' ); ?>
		<?php
		if ( in_array( 'item-tag', $item_cont, true ) ) {
			// ★変更: カスタム関数に変更
			my_mode_produt_tag();
		}
		?>
		</div>
		<div class="info">
			<?php welcart_mode_campaign_message(); ?>
			<?php
			if ( in_array( 'brand', $item_cont, true ) ) {
				mode_brand_label( $post );
			}
			?>
			<?php if ( in_array( 'item-name', $item_cont, true ) ) : ?>
				<h2><?php usces_the_itemName(); ?></h2>
			<?php endif; ?>

			<?php
			  // ★追加: カスタム情報を出力（必要ならば表示させる）
			  // if ( function_exists( 'my_child_custom_product_info' ) ) my_child_custom_product_info();
			?>

			<div class="price"><?php usces_the_firstPriceCr(); ?><?php usces_guid_tax(); ?></div>
			<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
			<?php if ( ! usces_have_zaiko_anyone() && in_array( 'item-soldout', $item_cont, true ) ) : ?>
				<div class="itemsoldout">
					<?php welcart_mode_soldout_label( get_the_ID() ); ?>
				</div>
			<?php endif; ?>
		</div>

	</a>
</article>
