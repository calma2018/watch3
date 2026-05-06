<?php
/**
 * 商品スペック情報テンプレート
 * $args に item_ref, item_dialcolor, item_accessory が渡される前提
 */

$item_ref            = $args['item_ref'] ?? '';
$item_rank           = $args['rank'] ?? '';
$item_movement           = $args['item_movement'] ?? '';
$item_dialcolor      = $args['item_dialcolor'] ?? '';
$item_material      = $args['item_material'] ?? '';
$item_beltsize       = $args['item_beltsize'] ?? '';
$item_accessory      = $args['item_accessory'] ?? '';
$item_accessory_other = $args['item_accessory_other'] ?? '';
$item_other = $args['item_other'] ?? '';

// できれば呼び出し元で post_id を渡してほしい（なければ get_the_ID で拾う）
$post_id = !empty($args['post_id']) ? (int)$args['post_id'] : (int)get_the_ID();

/**
 * ACF 選択肢（value => label）を使って、value を label に変換する
 * 例: "adjustable" → "調整可能（サイズ未調整）"
 */
if ( ! empty($item_beltsize) && function_exists('get_field_object') && $post_id ) {
	$field = get_field_object('item_beltsize', $post_id, false, false);
	$choices = (is_array($field) && isset($field['choices']) && is_array($field['choices'])) ? $field['choices'] : [];

	if ( ! empty($choices) ) {
		// 複数選択（配列）にも一応対応
		if ( is_array($item_beltsize) ) {
			$tmp = [];
			foreach ($item_beltsize as $v) {
				$v = (string)$v;
				$tmp[] = $choices[$v] ?? $v; // 見つからなければそのまま
			}
			$item_beltsize = $tmp;
		} else {
			$v = (string)$item_beltsize;
			$item_beltsize = $choices[$v] ?? $item_beltsize; // 見つからなければそのまま
		}
	}
}

?>
<!-- modal -->
<div
	id="rankGuideModal"
	class="p-rankModal"
	hidden
	aria-hidden="true"
>
	<div class="p-rankModal__overlay" data-rank-modal-close></div>

	<div
		class="p-rankModal__dialog"
		role="dialog"
		aria-modal="true"
		aria-labelledby="rankGuideModalTitle"
	>
		<button
			type="button"
			class="p-rankModal__close"
			data-rank-modal-close
			aria-label="閉じる"
		>×</button>

		<div class="p-rankModal__head">
			<h3 id="rankGuideModalTitle" class="p-rankModal__title">ランクについて</h3>
		</div>

		<div class="p-rankModal__body">
			<ul class="p-rankGuide">
				<li class="p-rankGuide__item">
					<div class="p-rankGuide__badge p-rankGuide__badge--n">N</div>
					<div class="p-rankGuide__content">
						<p class="p-rankGuide__name">新品・未使用品</p>
						<p class="p-rankGuide__text">使用感のない状態の良い商品です。</p>
					</div>
				</li>

				<li class="p-rankGuide__item">
					<div class="p-rankGuide__badge p-rankGuide__badge--s">S</div>
					<div class="p-rankGuide__content">
						<p class="p-rankGuide__name">中古品（メンテナンス済）</p>
						<p class="p-rankGuide__text">メンテナンス済みで、比較的きれいな状態の商品です。</p>
					</div>
				</li>

				<li class="p-rankGuide__item">
					<div class="p-rankGuide__badge p-rankGuide__badge--a">A</div>
					<div class="p-rankGuide__content">
						<p class="p-rankGuide__name">中古品（メンテナンス無・多少の使用傷）</p>
						<p class="p-rankGuide__text">多少のスレや小傷はありますが、比較的状態の良い商品です。</p>
					</div>
				</li>

				<li class="p-rankGuide__item">
					<div class="p-rankGuide__badge p-rankGuide__badge--b">B</div>
					<div class="p-rankGuide__content">
						<p class="p-rankGuide__name">中古品（メンテナンス無・通常使用傷）</p>
						<p class="p-rankGuide__text">使用に伴う傷や使用感が見られる一般的な中古商品です。</p>
					</div>
				</li>

				<li class="p-rankGuide__item">
					<div class="p-rankGuide__badge p-rankGuide__badge--c">C</div>
					<div class="p-rankGuide__content">
						<p class="p-rankGuide__name">ジャンク品（一部破損あり）</p>
						<p class="p-rankGuide__text">一部に破損や不具合が見られる商品です。状態をご確認のうえご検討ください。</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- modal end -->
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
		<dd class="p-itemSpec__desc p-itemSpec__desc--rank">
			<span class="p-itemSpec__rankValue"><?php echo esc_html( $item_rank ); ?></span>
			<button
	type="button"
	class="p-itemSpec__rankHelpText"
	data-rank-modal-open
	aria-haspopup="dialog"
	aria-controls="rankGuideModal"
>
	ランク説明
</button>
		</dd>
	</div>
<?php endif; ?>

		<?php if ( $item_movement ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--rank">
				<dt class="p-itemSpec__term">ムーブメント</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_movement ); ?></dd>
			</div>
		<?php endif; ?>

		<?php if ( $item_dialcolor ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--dialcolor">
				<dt class="p-itemSpec__term">文字盤色</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_dialcolor ); ?></dd>
			</div>
		<?php endif; ?>

		<?php if ( $item_material ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--dialcolor">
				<dt class="p-itemSpec__term">素材</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_material ); ?></dd>
			</div>
		<?php endif; ?>

		<?php if ( ! empty($item_beltsize) ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--beltsize">
				<dt class="p-itemSpec__term">ベルトサイズ</dt>
				<dd class="p-itemSpec__desc">
					<?php
					// 配列だった場合は改行 or カンマなどお好みで
					if ( is_array($item_beltsize) ) {
						echo esc_html( implode(' / ', $item_beltsize) );
					} else {
						echo esc_html( $item_beltsize );
					}
					?>
				</dd>
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

		<?php if ( $item_other ) : ?>
			<div class="p-itemSpec__row p-itemSpec__row--dialcolor">
				<dt class="p-itemSpec__term">備考</dt>
				<dd class="p-itemSpec__desc"><?php echo esc_html( $item_other ); ?></dd>
			</div>
		<?php endif; ?>

	</dl>
</section>