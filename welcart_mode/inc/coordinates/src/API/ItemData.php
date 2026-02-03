<?php
/**
 * Coordinates API Item Data
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

namespace Welcart\Themes\Mode\Coordinates\API;

use Welcart\Themes\Mode\Coordinates\Master;
use WP_REST_Request;

/**
 * APIs for retrieving item data
 */
class ItemData {

	/**
	 * Returns select HTML with list of items under a category
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @param WP_REST_Request $request Request.
	 * @return string
	 */
	public function getItemsByCategoryId( WP_REST_Request $request ) {
		$cat_id = $request->get_param( 'catId' );

		$args   = array(
			'category'    => $cat_id,
			'numberposts' => -1,
			'post_status' => array( 'publish', 'private' ),
		);
		$items  = get_posts( $args );
		$option = '<option value="-1">' . __( 'Please select an item', 'usces' ) . '</option>' . "\n";
		foreach ( $items as $item ) {
			$product  = wel_get_product( $item->ID );
			$itemName = $product['itemName'];
			$itemCode = $product['itemCode'];
			$option  .= '<option value="' . urlencode( $itemCode ) . '">' . $itemName . '(' . $itemCode . ')' . '</option>' . "\n";
		}

		return $option;
	}

	/**
	 * Returns SKUs array and table row HTML for the `itemCode`
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @global \usc_e_shop $usces
	 * @param WP_REST_Request $request Request.
	 * @return false|array
	 */
	public function getItemDataByItemCode( WP_REST_Request $request ) {
		global $usces;

		$item_code = $request->get_param( 'itemCode' );
		$post_id   = $usces->get_postIDbyCode( $item_code );
		if ( null === $post_id ) {
			return false;
		}

		remove_filter( 'wp_get_attachment_image_attributes', 'welcart_mode_attachment_image_attributes' );
		$pict_link = '';
		$tab_image = '';
		$pict_id   = $usces->get_mainpictid( $item_code );
		if ( ! empty( $pict_id ) ) {
			$pict_link = wp_get_attachment_image( $pict_id, array( 150, 150 ), true );
			$tab_image = wp_get_attachment_image( $pict_id, 'tab-thumb', true );
		} else {
			$pict_link = Master::getNoImageHtml( 150, 150 );
			$tab_image = Master::getNoImageHtml( 40, 40 );
		}

		$skus = $usces->get_skus( $post_id );
		if ( count( $skus ) < 1 ) {
			return false;
		}

		$selectedCode = $skus[0]['code'];
		$selectedName = $skus[0]['name'];

		$sku_img    = '';
		$sku_img_id = $usces->get_subpictid( $skus[0]['code'] );
		if ( $sku_img_id ) {
			$sku_img = wp_get_attachment_image( $sku_img_id, 'tab-thumb', true );
		}
		$skus[0]['tabImage'] = ! empty( $sku_img ) ? $sku_img : $tab_image;

		ob_start();
		?>
		<tr id="itemdetails" class="item-details">
			<th class="attachment-container" cellpadding="0"><?php echo wp_kses_post( $pict_link ); ?></th>
			<td>
				<div class="description">
					<?php if ( count( $skus ) > 1 ) : ?>
						<div>
							<select id="coordinates-sku-select" value="0">
								<?php for ( $i = 0; $i < count( $skus ); $i++ ) : ?>
									<?php
									$sku_img    = '';
									$sku_img_id = $usces->get_subpictid( $skus[ $i ]['code'] );
									if ( $sku_img_id ) {
										$sku_img = wp_get_attachment_image( $sku_img_id, 'tab-thumb', true );
									}
									$skus[ $i ]['tabImage'] = ! empty( $sku_img ) ? $sku_img : $tab_image;

									$text = $skus[ $i ]['code'];
									if ( ! empty( $skus[ $i ]['name'] ) ) {
										$text = $skus[ $i ]['name'] . ' - ' . $skus[ $i ]['code'];
									}
									?>
									<option value="<?php echo esc_attr( $i ); ?>">
										<?php echo esc_html( $text ); ?>
									</option>
								<?php endfor; ?>
							</select>
						</div>
					<?php endif; ?>
					<div class="text">
						<span><?php esc_html_e( 'SKU code', 'usces' ); ?>：</span>
						<span id="coordinates-sku-code"><?php echo esc_html( $selectedCode ); ?></span>
					</div>
					<div class="text">
						<span><?php esc_html_e( 'SKU display name ', 'usces' ); ?>：</span>
						<span id="coordinates-sku-name"><?php echo esc_html( $selectedName ); ?></span>
					</div>
					<div>
						<input
							id="coordinates-add-sku-button"
							type="button"
							class="button button-primary"
							value="<?php esc_html_e( 'Add To List', 'welcart_mode' ); ?>"
						/>
					</div>
				</div>
			</td>
		</tr>
		<?php
		$html     = ob_get_clean();
		$response = array(
			'skus'     => $skus,
			'itemName' => $usces->getItemName( $post_id ),
			'html'     => $html,
		);

		add_filter( 'wp_get_attachment_image_attributes', 'welcart_mode_attachment_image_attributes', 10, 2 );

		return $response;
	}
}
