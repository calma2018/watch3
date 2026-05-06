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

/**
 * 先頭SKUの「通常価格(cprice)」「売価(price)」を取り出す
 *
 * @param int $post_id
 * @return array{cprice:int, price:int}
 */
if ( ! function_exists( 'calma_get_first_sku_prices' ) ) {
	function calma_get_first_sku_prices( $post_id ) {

		$cprice = 0;
		$price  = 0;

		// 1) Welcart標準系：usces_get_skus()
		if ( function_exists( 'usces_get_skus' ) ) {
			$skus = usces_get_skus( $post_id );
			if ( is_array( $skus ) && ! empty( $skus ) ) {
				$first = reset( $skus );
				if ( is_array( $first ) ) {
					$cprice = isset( $first['cprice'] ) ? (int) $first['cprice'] : 0;
					$price  = isset( $first['price'] ) ? (int) $first['price'] : 0;
					return array(
						'cprice' => $cprice,
						'price'  => $price,
					);
				}
			}
		}

		// 2) item情報からskuを辿れる環境
		if ( function_exists( 'usces_get_item' ) ) {
			$item = usces_get_item( $post_id );
			if ( is_array( $item ) ) {
				$skus = null;

				if ( isset( $item['sku'] ) && is_array( $item['sku'] ) ) {
					$skus = $item['sku'];
				} elseif ( isset( $item['skus'] ) && is_array( $item['skus'] ) ) {
					$skus = $item['skus'];
				}

				if ( is_array( $skus ) && ! empty( $skus ) ) {
					$first = reset( $skus );
					if ( is_array( $first ) ) {
						$cprice = isset( $first['cprice'] ) ? (int) $first['cprice'] : 0;
						$price  = isset( $first['price'] ) ? (int) $first['price'] : 0;
						return array(
							'cprice' => $cprice,
							'price'  => $price,
						);
					}
				}
			}
		}

		return array(
			'cprice' => 0,
			'price'  => 0,
		);
	}
}

/**
 * 現金特価（売価の3%OFF）
 *
 * @param int $price
 * @return int
 */
if ( ! function_exists( 'watch3_get_cash_price' ) ) {
	function watch3_get_cash_price( $price ) {
		$price = (int) $price;
		if ( $price <= 0 ) {
			return 0;
		}
		return (int) floor( $price * 0.97 );
	}
}

/**
 * 一覧・TOP用 価格HTML
 *
 * @param int $post_id
 * @return string
 */
if ( ! function_exists( 'calma_price_html_list' ) ) {
	function calma_price_html_list( $post_id ) {

		$p          = calma_get_first_sku_prices( $post_id );
		$cprice     = (int) $p['cprice'];
		$price      = (int) $p['price'];
		$cash_price = watch3_get_cash_price( $price );

		// SKUから取れない場合は既存の表示関数からフォールバック
		if ( $price <= 0 ) {
			$regular_raw = '';
			$sale_raw    = '';

			if ( function_exists( 'usces_the_firstCpriceCr' ) ) {
				ob_start();
				usces_the_firstCpriceCr();
				$regular_raw = trim( ob_get_clean() );
			}

			if ( function_exists( 'usces_the_firstPriceCr' ) ) {
				ob_start();
				usces_the_firstPriceCr();
				$sale_raw = trim( ob_get_clean() );
			}

			$cprice = (int) preg_replace( '/[^0-9]/', '', wp_strip_all_tags( $regular_raw ) );
			$price  = (int) preg_replace( '/[^0-9]/', '', wp_strip_all_tags( $sale_raw ) );

			if ( $price <= 0 ) {
				return '';
			}

			$cash_price = watch3_get_cash_price( $price );
		}

		ob_start();
		?>
		<div class="c-priceBox c-priceBox--list">
			<?php if ( $cprice > 0 && $cprice !== $price ) : ?>
				<div class="c-priceBox__row c-priceBox__row--regular">
					<span class="c-priceBox__label"></span>
					<span class="c-priceBox__regular">¥<?php echo number_format( $cprice ); ?></span>
				</div>
			<?php endif; ?>

			<div class="c-priceBox__row c-priceBox__row--sale">
				<span class="c-priceBox__label"></span>
				<span class="c-priceBox__sale">¥<?php echo number_format( $price ); ?></span>
				<span class="c-priceBox__tax">(税込)</span>
			</div>

			<?php if ( $cash_price > 0 ) : ?>
				<div class="c-priceBox__cash">
					<span class="c-priceBox__cashOff">3%<br>OFF</span>
					<span class="c-priceBox__cashLabel">現金<br>特価</span>
					<span class="c-priceBox__cashPrice">¥<?php echo number_format( $cash_price ); ?></span>
					<span class="c-priceBox__cashTax">(税込)</span>
				</div>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}
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
			mode_produt_tag();
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
			$price_html = calma_price_html_list( get_the_ID() );
			if ( $price_html ) :
			?>
				<div class="price"><?php echo wp_kses_post( $price_html ); ?></div>
			<?php endif; ?>

			<?php if ( ! usces_have_zaiko_anyone() && in_array( 'item-soldout', $item_cont, true ) ) : ?>
				<div class="itemsoldout">
					<?php welcart_mode_soldout_label( get_the_ID() ); ?>
				</div>
			<?php endif; ?>
		</div>

	</a>
</article>