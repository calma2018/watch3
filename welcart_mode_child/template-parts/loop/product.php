<?php
/**
 * The Content Product Loop template file (CHILD)
 */

$item_cont = mode_get_options( 'item_cont' );
if ( ! is_array( $item_cont ) ) {
	$item_cont = array();
}

if ( ! function_exists( 'calma_capture_output' ) ) {
	function calma_capture_output( $callable ) {
		if ( ! is_callable( $callable ) ) {
			return '';
		}
		ob_start();
		$callable();
		return trim( ob_get_clean() );
	}
}

if ( ! function_exists( 'calma_get_list_prices_html' ) ) {
	function calma_get_list_prices_html() {

		$sale = '';
		if ( function_exists( 'usces_the_firstPriceCr' ) ) {
			$sale = calma_capture_output( function () {
				usces_the_firstPriceCr();
			} );
		}

		$regular = '';

		if ( function_exists( 'usces_the_firstCpriceCr' ) ) {
			$regular = calma_capture_output( function () {
				usces_the_firstCpriceCr();
			} );
		} elseif ( function_exists( 'usces_the_itemCpriceCr' ) ) {
			$regular = calma_capture_output( function () {
				usces_the_itemCpriceCr();
			} );
		}

		if ( $sale === '' && $regular === '' ) {
			return array( '', '' );
		}

		return array( $regular, $sale );
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php usces_the_itemName(); ?>">

<?php if ( function_exists( 'usces_the_item' ) ) usces_the_item(); ?>

<?php
list( $regular_html, $sale_html ) = calma_get_list_prices_html();

$regular_txt = trim( wp_strip_all_tags( $regular_html ) );
$sale_txt    = trim( wp_strip_all_tags( $sale_html ) );

$regular_num = (int) preg_replace( '/[^\d]/', '', $regular_txt );
$sale_num    = (int) preg_replace( '/[^\d]/', '', $sale_txt );

$item_off_rate = 0;
if ( $regular_num > 0 && $sale_num > 0 && $regular_num > $sale_num ) {
	$item_off_rate = (int) floor( ( ( $regular_num - $sale_num ) / $regular_num ) * 100 );
}

$cash_price = ( function_exists( 'watch3_get_cash_price' ) && $sale_num > 0 )
	? watch3_get_cash_price( $sale_num )
	: 0;

$show_regular = ( $regular_num > 0 && $sale_num > 0 && $regular_num !== $sale_num );
?>

<div class="img square">

<?php if ( $item_off_rate > 0 ) : ?>
	<div class="c-itemOffBadge c-itemOffBadge--corner c-itemOffBadge--list">
		<span class="c-itemOffBadge__top">定価より</span>
		<span class="c-itemOffBadge__num"><?php echo esc_html( $item_off_rate ); ?>%</span>
		<span class="c-itemOffBadge__text">OFF</span>
	</div>
<?php endif; ?>

<?php
if ( in_array( 'item-img', $item_cont, true ) ) {
	$sub_img = usces_get_itemSubImageNums();
	if ( ! empty( $sub_img ) && ! wp_is_mobile() && mode_get_options( 'subimage_hover' ) ) {
		echo '<div class="overlay">' . wp_kses_post( usces_the_itemImage( 0, 500, 500, '', 'return' ) ) .
			 '<span class="sub-img">' . wp_kses_post( usces_the_itemImage( 1, 500, 500, '', 'return' ) ) . '</span></div>';
	} else {
		usces_the_itemImage( 0, 500, 500 );
	}
}
?>

<?php do_action( 'usces_theme_favorite_icon' ); ?>

<?php if ( in_array( 'item-tag', $item_cont, true ) ) my_mode_produt_tag(); ?>

</div>

<div class="info">

<?php welcart_mode_campaign_message(); ?>

<?php if ( in_array( 'brand', $item_cont, true ) ) : ?>
	<div class="itembrand">
		<?php
		ob_start();
		mode_brand_label( $post );
		$brand = trim( ob_get_clean() );

		echo ! empty( $brand ) ? wp_kses_post( $brand ) : '-';
		?>
	</div>
<?php endif; ?>

<?php if ( in_array( 'item-name', $item_cont, true ) ) : ?>
	<h2><?php usces_the_itemName(); ?></h2>
<?php endif; ?>

<div class="price c-priceBox c-priceBox--list">

	<div class="c-priceBox__row c-priceBox__row--regular">
		<span class="c-priceBox__regular">
			<?php echo $show_regular ? wp_kses_post( $regular_html ) : '&nbsp;'; ?>
		</span>
	</div>

	<div class="c-priceBox__row c-priceBox__row--sale">
		<span class="c-priceBox__sale"><?php echo wp_kses_post( $sale_html ); ?></span>
		<span class="c-priceBox__tax"><?php usces_guid_tax(); ?></span>
	</div>

	<?php if ( $cash_price > 0 ) : ?>
	<div class="c-priceBox__cash">
		<div class="cashTitle_area">
			<span class="c-priceBox__cashLabel">現金<br>特価</span>
		</div>
		<div class="cashPrice_area">
			<span class="c-priceBox__cashPrice">
				¥<?php echo number_format( $cash_price ); ?><span class="c-priceBox__cashTax"><?php usces_guid_tax(); ?></span>
			</span>
		</div>
	</div>
	<?php endif; ?>

</div>

<?php if ( ! usces_have_zaiko_anyone() && in_array( 'item-soldout', $item_cont, true ) ) : ?>
	<div class="itemsoldout">
		<?php welcart_mode_soldout_label( get_the_ID() ); ?>
	</div>
<?php endif; ?>

</div>
</a>
</article>