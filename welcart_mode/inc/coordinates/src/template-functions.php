<?php
/**
 * Coordinates Template Functions
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

use Welcart\Themes\Mode\Coordinates\Master;
use Welcart\Themes\Mode\Coordinates\Models\AssociatedCoordinatePosts;
use Welcart\Themes\Mode\Coordinates\Models\AssociatedSkus;

/**
 * Returns or echos HTML for a list of items associated with the clothes being worn
 * by the model on the current page
 *
 * If `post_id` is not provided, the post ID for the current `$post` object will be used.
 *
 * @author Evan D Shaw <evandanielshaw@gmail.com>
 * @global \usc_e_shop $usces
 * @param int|null $post_id Comments.
 * @param string   $out Set to `return` to return the HTML as a string, otherwise the result
 *                      is echoed. Default: ''.
 * @return string|void
 */
function welcart_mode_coordinate_sku_details_list( $post_id = null, $out = '' ) {
	global $usces;

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
		if ( false === $post_id ) {
			return '';
		}
	}

	$meta = new AssociatedSkus( $post_id );
	$data = $meta->getSkusData();
	if ( empty( $data ) ) {
		return '';
	}

	$tax        = $usces->getGuidTax();
	$totalPrice = $usces->get_currency( $meta->getTotalPrice(), true, false );

	$totalPrice_taxincluded = '';
	if ( 0 < $meta->getTotalPrice_taxincluded() ) {
		$totalPrice_taxincluded = apply_filters( 'welcart_mode_filter_coordinate_sku_totalprice_taxincluded', '<p class="tax_inc_block">(<em class="tax tax_inc_label">' . __( 'tax-included', 'usces' ) . '</em>' . $usces->get_currency( $meta->getTotalPrice_taxincluded(), true, false ) . ')</p>', $meta->getTotalPrice_taxincluded() );
	}
	ob_start();
	?>
	<div class="coordinate_all_price">
		<dl>
			<dt><?php esc_html_e( 'Total Price', 'welcart_mode' ); ?></dt>
			<dd><?php echo esc_html( $totalPrice ); ?><?php echo wp_kses_post( $tax ); ?><?php echo wp_kses_post( $totalPrice_taxincluded ); ?></dd>
		</dl>
	</div>
	<?php
	$header = (string) ob_get_clean();
	$header = apply_filters( 'welcart_mode_filter_coordinate_sku_list_header', $header, $post_id, $meta, $tax, $totalPrice );

	$item_cont = mode_get_options( 'item_cont' );
	if ( ! is_array( $item_cont ) ) {
		$item_cont = array();
	}

	ob_start();
	?>
	<div class="coord_item_list">
		<ul>
			<?php foreach ( $data as $sku ) : ?>
				<?php
				$price  = $usces->get_currency( $sku['price'], true, false );
				$cprice = $usces->get_currency( $sku['cprice'], true, false );
				$price  = apply_filters( 'usces_filter_the_item_price_cr', $price, $sku['price'], 'return' );
				ob_start();
				?>
				<li>
					<div class="tmnimg"><a href="<?php echo esc_url( $sku['permalink'] ); ?>"><?php echo wp_kses_post( $sku['itemImage'] ); ?></a></div>
					<div class="item_detail">
						<?php
						if ( in_array( 'item-tag', $item_cont, true ) ) :
							mode_produt_tag( $sku['post_id'] );
						endif;
						?>
						<p class="title"><?php echo esc_html( $sku['cartItemName'] ); ?></p>
						<p class="price">
							<?php if ( $sku['cprice'] > 0 ) : ?>
								<span class="field_cprice ss_cprice"><?php echo esc_html( $cprice ); ?> </span>
							<?php endif; ?>
							<?php echo esc_html( $price ); ?><?php echo wp_kses_post( $tax ); ?>
						</p>
						<?php welcart_mode_campaign_message( $sku['post_id'] ); ?>
						<?php
						if ( isset( $sku['price_taxincluded'] ) && $sku['price_taxincluded'] > 0 ) :
							$price_taxincluded = apply_filters( 'welcart_mode_filter_coordinate_sku_price_taxincluded', '<p class="tax_inc_block">(<em class="tax tax_inc_label">' . __( 'tax-included', 'usces' ) . '</em>' . $usces->get_currency( $sku['price_taxincluded'], true, false ) . ')</p>', $sku['price_taxincluded'] );
							echo wp_kses_post( $price_taxincluded );
							endif;
						?>
						<nav class="item_link">
							<a href="<?php echo esc_url( $sku['permalink'] ); ?>">
								<?php esc_html_e( 'see the details', 'usces' ); ?>
							</a>
						</nav>
					</div>
				</li>
				<?php
				$li = (string) ob_get_clean();
				echo apply_filters(
					'welcart_mode_filter_coordinate_sku_list_li',
					$li,
					$post_id,
					$sku,
					$tax,
					$price,
					$cprice,
					$meta,
					$totalPrice
				);
				?>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
	$html = $header . (string) ob_get_clean();
	$html = apply_filters( 'welcart_mode_filter_coordinate_sku_list_body', $html, $post_id, $meta, $tax, $totalPrice );
	if ( 'return' === $out ) {
		return $html;
	}

	echo wp_kses_post( $html );
}

/**
 * Returns or echos HTML for a list of models of a coordinate post associated with the current item
 *
 * If `post_id` is not provided, the post ID for the current `$post` object will be used. Note that even if there
 * are more than one associated coordinate posts with the same model, the model will only be displayed once.
 *
 * @author Evan D Shaw <evandanielshaw@gmail.com>
 * @param int|null $post_id Comments.
 * @param string   $out Set to `return` to return the HTML as a string, otherwise the result
 *                      is echoed. Default: ''.
 * @return string|void
 */
function welcart_mode_coordinates_item_models_list( $post_id = null, $out = '' ) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
		if ( false === $post_id ) {
			return '';
		}
	}

	$associations = new AssociatedCoordinatePosts( $post_id );
	$postIds      = $associations->getPostIds();
	if ( empty( $postIds ) ) {
		return '';
	}

	$processedTermIds = array();
	ob_start();
	?>
	<div class="arrange_item">
		<h3 class="arrange_title"><?php esc_html_e( 'Models sporting this item', 'welcart_mode' ); ?></h3>
		<div class="coordinate-column column-grid column-grid5 single_arrange_item">
			<?php foreach ( $postIds as $coordinatesPostId ) : ?>
				<?php
				$permalink    = get_the_permalink( $coordinatesPostId );
				$articleClass = get_post_class( 'list', $coordinatesPostId );
				$post_title   = get_the_title( $coordinatesPostId );
				$terms        = get_the_terms( $coordinatesPostId, 'model' );
				$eyecatch     = '';
				if ( has_post_thumbnail( $coordinatesPostId ) ) {
					$eyecatch = get_the_post_thumbnail( $coordinatesPostId, array( 235, 300 ) );
				} else {
					$eyecatch = Master::getNoImageHtml();
				}
				?>
				<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
					<?php foreach ( $terms as $term ) : ?>
						<?php
						$termId             = (int) $term->term_id;
						$processedTermIds[] = $termId;
						$type               = get_term_meta( $termId, 'model_type', true );
						$height             = get_term_meta( $termId, 'model_height', true );
						$model_img_url      = get_term_meta( $termId, 'model-img-url', true );
						$model_img_id       = get_term_meta( $termId, 'model-img-id', true );
						$modelimg           = '';
						if ( ! empty( $model_img_id ) ) {
							$modelimg = wp_get_attachment_image( $model_img_id, array( 150, 150 ) );
						} elseif ( ! empty( $model_img_url ) ) {
							$modelimg = '<img src="' . esc_url( $model_img_url ) . '" height="150" width="150" class="attachment-150x150 size-150x150" />';
						}
						ob_start();
						?>
						<article class="<?php echo esc_attr( join( ' ', $articleClass ) ); ?>">
							<a href="<?php echo esc_url( $permalink ); ?>">
								<div class="img square">
									<?php echo wp_kses_post( $eyecatch ); ?>
								</div>
								<div class="model-info">
									<div class="thumbnail">
										<?php echo wp_kses_post( $modelimg ); ?>
									</div>
									<div class="in">
										<div class="name">
											<?php echo esc_html( $term->name ); ?>
										</div>
										<?php
										if ( ! empty( $type ) || ! empty( $height ) ) :
											?>
											(
												<?php if ( ! empty( $type ) ) : ?>
													<span class="type"><?php echo esc_html( $type ); ?></span>
												<?php endif; ?>
												<?php if ( ! empty( $height ) ) : ?>
													<span class="height"><?php echo esc_html( $height ); ?>cm</span>
												<?php endif; ?>
											)
											<?php
										endif;
										?>
									</div>
								</div>
							</a>
						</article>
						<?php
						$article = (string) ob_get_clean();
						echo apply_filters(
							'welcart_mode_filter_coordinate_model_article',
							$article,
							$term,
							$articleClass,
							$permalink,
							$eyecatch,
							$type,
							$height,
							$model_img_url,
							$model_img_id,
							$modelimg
						);
						?>
					<?php endforeach; ?>
					<?php
					else :
						ob_start();
						?>
					<article class="<?php echo esc_attr( join( ' ', $articleClass ) ); ?>">
						<a href="<?php echo esc_url( $permalink ); ?>">
							<div class="img square">
								<?php echo wp_kses_post( $eyecatch ); ?>
							</div>
							<div class="name"><?php echo esc_html( $post_title ); ?></div>
						</a>
					</article>
						<?php
						$article = (string) ob_get_clean();
						echo apply_filters(
							'welcart_mode_filter_coordinate_article',
							$article,
							$articleClass,
							$permalink,
							$eyecatch
						);
						?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
	$html = (string) ob_get_clean();
	$html = apply_filters( 'welcart_mode_filter_coordinate_models_list_html', $html, $post_id, $associations );
	if ( 'return' === $out ) {
		return $html;
	}

	echo wp_kses_post( $html );
}
