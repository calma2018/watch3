<?php
/**
 * 商品詳細ページ：ブランド情報ブロック
 */

if ( empty( $args['brand_term'] ) || ! ( $args['brand_term'] instanceof WP_Term ) ) {
	return;
}

$brand_term = $args['brand_term'];
$brand_name = $brand_term->name;

// 説明文（HTML・改行をすべて除去して1行に）
$brand_desc_raw = term_description( $brand_term, 'brand' );

// HTMLタグ除去
$brand_desc = wp_strip_all_tags( $brand_desc_raw );

// 改行除去（\r, \n）
$brand_desc = str_replace( array("\r", "\n"), '', $brand_desc );

// 前後の空白をトリム
$brand_desc = trim( $brand_desc );

// ブランドタームのリンク
$brand_link = get_term_link( $brand_term, 'brand' );
if ( is_wp_error( $brand_link ) ) {
	$brand_link = '';
}

// 何も出力する内容がなければ終了
if ( '' === $brand_desc && '' === $brand_link ) {
	return;
}
?>

<dl class="p-itemBrand">
  <?php if ( ! empty( $brand_name ) ) : ?>
    <dt class="p-itemBrand__title"><?php echo esc_html( $brand_name ); ?></dt>
  <?php endif; ?>

  <?php if ( '' !== $brand_desc ) : ?>
    <dd class="p-itemBrand__desc">
      <?php echo esc_html( $brand_desc ); ?>
    </dd>
  <?php endif; ?>

  <?php if ( '' !== $brand_link && ! empty( $brand_name ) ) : ?>
    <dd class="p-itemBrand__link">
      <a href="<?php echo esc_url( $brand_link ); ?>" class="c-textLink">
        <?php echo esc_html( $brand_name ); ?>の商品一覧
      </a>
    </dd>
  <?php endif; ?>
</dl>
