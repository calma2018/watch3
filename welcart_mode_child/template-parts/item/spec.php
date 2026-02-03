<?php
/**
 * 商品スペック情報テンプレート
 * $item_ref, $item_dialcolor, $item_accessory が渡される前提
 */

$item_ref       = $args['item_ref'] ?? '';
$item_rank      = $args['item_rank'] ?? '';
$item_dialcolor = $args['item_dialcolor'] ?? '';
$item_beltsize  = $args['item_beltsize'] ?? '';
$item_accessory = $args['item_accessory'] ?? '';
$item_accessory_other = $args['item_accessory_other'] ?? '';
?>

<section class="p-itemSpec">
	<dl class="p-itemSpec__list">

		<?php if ( $item_ref ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--ref">
				<dt class="p-itemSpec__term">メーカー品番</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_ref ); ?></dd>
			</div>
		<?php endif; ?>

		<?php if ( $item_rank ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--rank">
				<dt class="p-itemSpec__term">ランク</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_rank ); ?></dd>
			</div>
		<?php endif; ?>

		<?php if ( $item_dialcolor ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--dialcolor">
				<dt class="p-itemSpec__term">文字盤色</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_dialcolor ); ?></dd>
			</div>
		<?php endif; ?>

		<?php if ( $item_beltsize ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--beltsize">
				<dt class="p-itemSpec__term">ベルトサイズ</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_beltsize ); ?></dd>
			</div>
		<?php endif; ?>

		<?php
		$accessory_items = array();

		if ( ! empty( $item_accessory ) ) {
			if ( is_array( $item_accessory ) ) {
				foreach ( $item_accessory as $acc ) {
					$accessory_items[] = esc_html( $acc );
				}
			} else {
				$accessory_items[] = esc_html( $item_accessory );
			}
		}

		if ( ! empty( $item_accessory_other ) ) {
			$accessory_items[] = esc_html( $item_accessory_other );
		}

		// 最終的に項目があれば表示
		if ( ! empty( $accessory_items ) ) :
		?>
			<div class="p-itemSpec__row p-itemSpec__row--accessory">
				<dt class="p-itemSpec__term">付属品</dt>
				<dd class="p-itemSpec__desc">
					<ul class="p-itemSpec__accessoryList">
						<?php foreach ( $accessory_items as $item ) : ?>
							<li><?php echo $item; ?></li>
						<?php endforeach; ?>
					</ul>
				</dd>
			</div>
		<?php endif; ?>

	</dl>
</section>
