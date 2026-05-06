<?php
/**
 * Item Single
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();

/* 詳細説明の場所変更機能 */
$get_subimg       = usces_get_itemSubImageNums();
$cont_position    = mode_get_options( 'content_position' );
$page_title       = mode_get_options( 'item_page_title' );
$display_inquiry  = mode_get_options( 'display_inquiry' );
$inquiry_position = mode_get_options( 'inquiry_position' );
$other_item       = mode_get_options( 'display_item_single' );

if ( ! is_array( $other_item ) ) {
	$other_item = array();
}

if ( 'lp' === $cont_position ) {
	$class = 'layout-lp';
} else {
	$class = 'layout-default';
}

?>

	<?php
	if ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class( $class ); ?> id="post-<?php the_ID(); ?>">

			<?php usces_remove_filter(); ?>
			<?php usces_the_item(); ?>
			<?php usces_have_skus(); ?>

			<?php if ( 'lp' === $cont_position ) : ?>

				<section class="item-content entry-content entry-box">
					<?php if ( $page_title ) : ?>
						<h1 class="item-page-title"><?php the_title(); ?></h1>
					<?php endif; ?>
					<?php the_content(); ?>
				</section>

			<?php endif; ?>


			<?php
$item_cprice   = (int) usces_the_itemCprice( 'return' );
$item_price    = (int) usces_the_itemPrice( 'return' );
$item_off_rate = 0;

if ( $item_cprice > 0 && $item_price > 0 && $item_cprice > $item_price ) {
	$item_off_rate = floor( ( ( $item_cprice - $item_price ) / $item_cprice ) * 100 );
}
?>
			<section class="is-product">

				<div class="gallery">

					<div id="itemimg" class="itemimg">

	<?php if ( $item_off_rate > 0 ) : ?>
		<div class="c-itemOffBadge c-itemOffBadge--corner">
			<span class="c-itemOffBadge__top">定価より</span>
			<span class="c-itemOffBadge__num"><?php echo esc_html( $item_off_rate ); ?>%</span>
			<span class="c-itemOffBadge__text">OFF</span>
		</div>
	<?php endif; ?>

	<div class="slider slider-for">
							<div class="list">
								<?php if ( wp_is_mobile() ) : ?>
									<?php usces_the_itemImage( 0, 600, 600, $post ); ?>
								<?php else : ?>
									<a href="<?php usces_the_itemImageURL( 0 ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); ?>>
										<?php usces_the_itemImage( 0, 600, 600, $post ); ?>
									</a>
								<?php endif; ?>
							</div>
							<?php foreach ( $get_subimg as $subimg ) : ?>
								<div class="list">
									<?php if ( wp_is_mobile() ) : ?>
										<?php usces_the_itemImage( $subimg, 600, 600, $post ); ?>
									<?php else : ?>
										<a href="<?php usces_the_itemImageURL( $subimg ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); ?>>
											<?php usces_the_itemImage( $subimg, 600, 600, $post ); ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<?php do_action( 'usces_theme_favorite_icon' ); ?>
					</div><!-- #itemimg -->

					<?php if ( ! empty( $get_subimg ) ) : ?>
						<div id="itemimg-sub" class="slider slider-nav itemimg-sub">
							<div class="list"><?php usces_the_itemImage( 0, 300, 300, $post ); ?></div>
							<?php foreach ( $get_subimg as $subimg ) : ?>
								<div class="list"><?php usces_the_itemImage( $subimg, 300, 300, $post ); ?></div>
							<?php endforeach; ?>
						</div><!-- #itemimg-sub -->
					<?php endif; ?>

				</div><!-- .gallery -->

				<div class="add-to-cart">

					<!-- ★変更: カスタム関数に変更 -->
				  <?php my_mode_produt_tag(); ?>

					<?php
					if ( in_array( 'brand', $other_item, true ) ) {
						mode_brand_label( $post );
					}
					?>

					<div class="itemname">
						<h1><?php usces_the_itemName(); ?></h1>
						<?php if ( in_array( 'itemcode', $other_item, true ) ) : ?>
							<div class="itemcode"><?php usces_the_itemCode(); ?></div>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<div class="excerpt">
							<p><?php echo esc_html( $post->post_excerpt ); ?></p>
						</div>
					<?php endif; ?>

					<form action="<?php echo esc_url( USCES_CART_URL ); ?>" method="post">

					<?php do { ?>
						<div class="skuform cf">

							<?php if ( '' !== usces_the_itemSkuDisp( 'return' ) ) : ?>
								<div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
							<?php endif; ?>

							<?php do_action( 'usces_theme_item_single_before_options' ); ?>

							<?php if ( usces_is_options() ) : ?>
								<dl class="item-option">
									<?php while ( usces_have_options() ) : ?>
										<dt><?php usces_the_itemOptName(); ?></dt>
										<dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
									<?php endwhile; ?>
								</dl>
							<?php endif; ?>

							<?php
							global $usces;
							$pictid = $usces->get_subpictid( usces_the_itemSku( 'return' ) );
							if ( $pictid ) :
								?>
								<div class="skuimg">
									<?php echo wp_get_attachment_image( $pictid, array( 300, 300 ), true ); ?>
								</div>
								<?php
							endif;
							?>


							<div class="is-cart">

								<?php welcart_mode_campaign_message(); ?>

								<?php if ( in_array( 'status', $other_item, true ) ) : ?>
									<div class="zaikostatus"><?php usces_the_itemZaikoStatus(); ?></div>
								<?php endif; ?>

								<?php if ( 'continue' === welcart_mode_get_item_chargingtype( $post->ID ) ) : ?>
									<div class="frequency"><span class="field_frequency"><?php dlseller_frequency_name( $post->ID, 'amount' ); ?></span></div>
								<?php endif; ?>

								<!-- <div class="field_price">
									<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
										<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
									<?php endif; ?>
									<?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
								</div> -->
								<!-- <div class="field_price">
									<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
										<span class="field_cprice_wrap">
											<span class="field_price_label">[定価]</span>
											<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
										</span>
									<?php endif; ?>

									<span class="field_price_wrap">
										<span class="field_price_label">[売価]</span>
										<span class="field_price_main"><?php usces_the_itemPriceCr(); ?></span>
										<?php usces_guid_tax(); ?>
									</span>
								</div>
								<?php usces_crform_the_itemPriceCr_taxincluded(); ?> -->

								<?php
$item_cprice = (int) usces_the_itemCprice( 'return' );
$item_price  = (int) usces_the_itemPrice( 'return' );
$cash_price  = $item_price > 0 ? (int) floor( $item_price * 0.97 ) : 0;
?>

<?php if ( $item_price > 0 ) : ?>
	<div class="c-priceBox c-priceBox--single">
		<div class="c-priceBox__main">
			<?php if ( $item_cprice > 0 && $item_cprice !== $item_price ) : ?>
				<div class="c-priceBox__row c-priceBox__row--regular">
					<span class="c-priceBox__label"></span>
					<span class="c-priceBox__regular">¥<?php echo number_format( $item_cprice ); ?></span>
				</div>
			<?php endif; ?>

			<div class="c-priceBox__row c-priceBox__row--sale">
				<span class="c-priceBox__label"></span>
				<span class="c-priceBox__sale">¥<?php echo number_format( $item_price ); ?></span>
				<span class="c-priceBox__tax"><?php usces_guid_tax(); ?></span>
			</div>
		</div>

		<?php if ( $cash_price > 0 ) : ?>
			<div class="c-priceBox__cash">
				<div class="cashTitle_area">
					<span class="c-priceBox__cashLabel">現金<br>特価</span>
					<!-- <span class="c-priceBox__cashOff">3%<br>OFF</span> -->
				</div>
				<div class="cashPrice_area">
					<!-- <span class="c-priceBox__cashArrow"></span> -->
					<div class="cashPrice_block">
						<span class="c-priceBox__cashPrice">
							¥<?php echo number_format( $cash_price ); ?>
							<span class="c-priceBox__cashTax"><?php usces_guid_tax(); ?></span>
						</span>
						<span class="c-priceBox__cashTxt">※銀行振込での現金払いに限り（割引上限10万円）</span>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php usces_crform_the_itemPriceCr_taxincluded(); ?>



								<!-- end price -->
								<?php usces_the_itemGpExp(); ?>

									<!-- 追記 -->
									<?php if ( ! usces_have_zaiko() ) : ?>

									<?php if ( $display_inquiry && 'initial' === $inquiry_position ) : ?>
										<div class="contact-item initial"><a href="<?php echo esc_url( welcart_mode_get_inquiry_link_url() ); ?>"><span class="welicon-contact"></span><?php mode_options( 'inquiry_text' ); ?></a></div>
									<?php else : ?>
										<div class="itemsoldout"><?php mode_options( 'soldout_text' ); ?></div>
										<?php if ( $display_inquiry && 'always' === $inquiry_position ) : ?>
										<div class="contact-item always"><a href="<?php echo esc_url( welcart_mode_get_inquiry_link_url() ); ?>"><span class="welicon-contact"></span><?php mode_options( 'inquiry_text' ); ?></a></div>
										<?php endif; ?>
									<?php endif; ?>

								<?php else : ?>
									<!-- 追記ここまで -->
									<div class="c-box">
										<div class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php usces_the_itemQuant(); ?></div><span class="unit"><?php usces_the_itemSkuUnit(); ?></span>
										<?php if ( $display_inquiry && 'always' === $inquiry_position ) : ?>
											<div class="cart-button"><?php usces_the_itemSkuButton( mode_get_options( 'cart_button' ), 0 ); ?></div>
											<div class="contact-item always"><a href="<?php echo esc_url( welcart_mode_get_inquiry_link_url() ); ?>"><span class="welicon-contact"></span><?php mode_options( 'inquiry_text' ); ?></a></div>
										<?php else : ?>
											<div class="cart-button"><?php usces_the_itemSkuButton( mode_get_options( 'cart_button' ), 0 ); ?></div>
										<?php endif; ?>
									</div>

								<?php endif; ?>

								<!-- ★追加：お問い合わせブロックを表示 -->
								<?php get_template_part( 'template-parts/item/contact' ); ?>
								<!-- ★追加：ここまで -->

								<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>

							</div>

						</div><!-- .skuform -->
					<?php } while ( usces_have_skus() ); ?>

						<?php do_action( 'usces_action_single_item_inform' ); ?>
					</form>
					<?php do_action( 'usces_action_single_item_outform' ); ?>

				</div><!-- .add-to-cart -->

				<div class="info">

					<?php if ( wp_is_mobile() ) : ?>
						<div class="tabs-sp">
							<ul class="tabs">

								<?php if ( 'initial' === $cont_position ) : ?>
									<li class="active">
										<div class="label"><?php esc_html_e( 'Item Description', 'welcart_mode' ); ?></div>
										<div class="icon">
											<div class="in"></div>
										</div>
										<div class="entry-box select">
											<!-- ★追加：商品カスタムフィールド（メーカー品番・文字盤色・付属品）を表示 -->
											<?php watch3_show_item_acf_spec( get_the_ID() ); ?>
											<!-- ★追加：ここまで -->
											<?php the_content(); /* パターンB */ ?>
											<!-- ★追加：ブランド情報ブロック・商品ページのタグ一覧を表示 -->
											<?php watch3_show_item_brand( get_the_ID() ); ?>
											<ul class="p-itemRemarks">
												<li>※付属品について写真のものがすべてとなります。</li>
												<li>※入荷時期によって、写真と仕様・付属品が異なる場合がございます。</li>
											</ul>
											<?php watch3_show_item_tags( get_the_ID() ); ?>
											<!-- ★追加：ここまで -->
										</div>
									</li>
								<?php endif; ?>

								<?php
								$item_custom = usces_get_item_custom( $post->ID, 'table', 'return' );
								if ( ! empty( $item_custom ) ) :
									?>
									<li>
										<div class="label"><?php esc_html_e( 'Other', 'welcart_mode' ); ?></div>
										<div class="icon">
											<div class="in"></div>
										</div>

										<div class="entry-box spec"><?php echo wp_kses_post( $item_custom ); ?></div>

									</li>
								<?php endif; ?>

								<?php if ( in_array( 'review', $other_item, true ) ) : ?>
									<li>
										<div class="label"><?php esc_html_e( 'Review', 'welcart_mode' ); ?><span class="review-num">（ <?php echo esc_html( get_comments_number() ); ?> ）</span></div>
										<div class="icon">
											<div class="in"></div>
										</div>
										<div class="entry-box review-list">
											<?php comments_template( '/wc_templates/wc_review-list.php' ); ?>
										</div><!-- .entry-review -->
									</li>
								<?php endif; ?>

							</ul>
						</div>

					<?php else : ?>

						<div class="tabs-pc">
							<ul class="tabs">

								<?php
								if ( 'initial' === $cont_position ) :
									?>
									<li class="active">
										<div class="label"><?php esc_html_e( 'Item Description', 'welcart_mode' ); ?></div>
									</li>
									<?php
									endif;
									$item_custom = usces_get_item_custom( $post->ID, 'table', 'return' );
								if ( ! empty( $item_custom ) ) :
									if ( 'initial' !== $cont_position ) {
										$class = 'active';
									} else {
										$class = 'second-menu';
									}
									?>
									<li class="<?php echo esc_attr( $class ); ?>">
										<div class="label"><?php esc_html_e( 'Other', 'welcart_mode' ); ?></div>

									</li>
									<?php
									endif;
								if ( in_array( 'review', $other_item, true ) ) :
									if ( 'initial' !== $cont_position && ! $item_custom ) {
										$class = 'active';
									} else {
										$class = 'second-menu';
									}
									?>
									<li class="<?php echo esc_attr( $class ); ?>">
										<div class="label"><?php esc_html_e( 'Review', 'welcart_mode' ); ?><span class="review-num">（ <?php echo esc_html( get_comments_number() ); ?> ）</span></div>
									</li>
									<?php
									endif;
								?>

							</ul>

							<?php
							if ( 'initial' === $cont_position ) :
								?>
								<div class="entry-box entry-content select">
									<!-- ★追加：商品カスタムフィールド（メーカー品番・文字盤色・付属品）を表示 -->
									<?php watch3_show_item_acf_spec( get_the_ID() ); ?>
									<!-- ★追加：ここまで -->
									<?php the_content(); /* パターンB */ ?>
									<!-- ★追加：ブランド情報ブロック・商品ページのタグ一覧を表示 -->
									<?php watch3_show_item_brand( get_the_ID() ); ?>
									<ul class="p-itemRemarks">
										<li>※付属品について写真のものがすべてとなります。</li>
										<li>※入荷時期によって、写真と仕様・付属品が異なる場合がございます。</li>
									</ul>
									<?php watch3_show_item_tags( get_the_ID() ); ?>
									<!-- ★追加：ここまで -->
								</div>
								<?php
								endif;
							if ( ! empty( $item_custom ) ) :
								if ( 'initial' !== $cont_position ) {
									$class = ' select';
								} else {
									$class = ' second-menu';
								}
								?>
								<div class="entry-box spec<?php echo esc_attr( $class ); ?>">
									<?php echo wp_kses_post( $item_custom ); ?>
								</div>
								<?php
								endif;
							if ( in_array( 'review', $other_item, true ) ) :
								if ( 'initial' !== $cont_position && empty( $item_custom ) ) {
									$class = ' select';
								} else {
									$class = ' second-menu';
								}
								?>
								<div class="entry-box review-list<?php echo esc_attr( $class ); ?>">
									<?php comments_template( '/wc_templates/wc_review-list.php' ); ?>
								</div><!-- .entry-review -->
								<?php
								endif;
							?>

						</div>

						<?php
					endif;

					if ( in_array( 'review', $other_item, true ) ) :
						?>
						<div class="entry-review">
							<?php comments_template( '/wc_templates/wc_review.php', false ); ?>
						</div>
						<?php
					endif;
					?>

				</div><!-- .info -->

			</section>

			<?php welcart_mode_coordinates_item_models_list(); ?>

			<?php usces_assistance_item( $post->ID, __( 'An article concerned', 'usces' ) ); ?>

		</article>

	<?php else : ?>

		<p class="no-post"><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
