<?php
/**
 * Coordinates Associated SKUs
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

namespace Welcart\Themes\Mode\Coordinates\Models;

use Welcart\Themes\Mode\Coordinates\Master;

/**
 * Coordinates post associated SKUs meta data
 */
class AssociatedSkus {

	/**
	 * Post ID
	 *
	 * @var int
	 */
	private $postId;

	/**
	 * Total units price of all associated SKUs
	 *
	 * @var int
	 */
	private $totalPrice = 0;

	/**
	 * Total units price of all associated SKUs
	 *
	 * @var int
	 */
	private $totalPrice_taxincluded = 0;

	/**
	 * Array of data for associated SKUs
	 *
	 * @var array
	 */
	private $skus = array();

	/**
	 * Array of meta IDs pointing to associated SKU data
	 *
	 * @var int[]
	 */
	private $metaIds = array();

	/**
	 * Fetches associated SKU data for a coordinates post type given its post ID
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @global \wpdb $wpdb
	 * @global \usc_e_shop $usces
	 * @param int $post_id Comments.
	 * @return void
	 */
	public function __construct( $post_id ) {
		global $wpdb, $usces;

		$this->postId = (int) $post_id;
		$results      = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s ORDER BY meta_id ASC",
				$this->postId,
				Master::KEY
			)
		);

		if ( empty( $results ) ) {
			return;
		}

		foreach ( $results as $i => $obj ) {
			$metaId          = (int) $obj->meta_value;
			$this->metaIds[] = $metaId;

			$sku = wel_get_sku_by_id( $metaId );
			if ( false === $sku ) {
				continue;
			}

			$sku_post_id = (int) $sku['post_id'];

			$tab_image  = '';
			$item_image = '';
			$sku_img_id = $usces->get_subpictid( $sku['code'] );
			if ( $sku_img_id ) {
				$tab_image  = wp_get_attachment_image( $sku_img_id, 'tab-thumb', true );
				$item_image = wp_get_attachment_image( $sku_img_id, array( 268, 300 ), true );
			} else {
				$pict_id = $usces->get_mainpictid( $usces->getItemCode( $sku_post_id ) );
				if ( ! empty( $pict_id ) ) {
					$tab_image  = wp_get_attachment_image( $pict_id, 'tab-thumb', true );
					$item_image = wp_get_attachment_image( $pict_id, array( 268, 300 ), true );
				} else {
					$tab_image  = Master::getNoImageHtml( 40, 40 );
					$item_image = Master::getNoImageHtml( 268, 300 );
				}
			}
			$this->totalPrice += (int) $sku['price'];

			if ( ( isset( $usces->options['tax_display'] ) && 'deactivate' === $usces->options['tax_display'] ) || ( isset( $usces->options['tax_mode'] ) && 'include' === $usces->options['tax_mode'] ) ) {
				$price_taxincluded = 0;
			} else {
				$tax_rate                      = $this->get_sku_tax_rate( $sku_post_id, $sku['code'] );
				$tax                           = (float) sprintf( '%.3f', (float) $sku['price'] * (float) $tax_rate / 100 );
				$tax                           = usces_tax_rounding_off( $tax );
				$this->totalPrice_taxincluded += (int) $sku['price'] + $tax;
				$price_taxincluded             = (int) $sku['price'] + $tax;
			}

			$this->skus[] = array(
				'post_id'           => $sku_post_id,
				'meta_id'           => $metaId,
				'itemName'          => $usces->getItemName( $sku_post_id ),
				'cartItemName'      => $usces->getCartItemName( $sku_post_id, urldecode( $sku['code'] ) ),
				'tabImage'          => $tab_image,
				'itemImage'         => $item_image,
				'permalink'         => get_permalink( $sku_post_id ),
				'code'              => $sku['code'],
				'name'              => $sku['name'],
				'cprice'            => (int) $sku['cprice'],
				'price'             => (int) $sku['price'],
				'price_taxincluded' => $price_taxincluded,
				'unit'              => $sku['unit'],
				'stocknum'          => $sku['stocknum'],
				'stock'             => $sku['stock'],
				'gp'                => $sku['gp'],
				'taxrate'           => isset( $sku['taxrate'] ) ? $sku['taxrate'] : '',
				'sort'              => $sku['sort'],
				'advance'           => isset( $sku['advance'] ) ? $sku['advance'] : '',
			);

		}
	}

	/**
	 * Saves/updates a coordinate post's associated SKU meta IDs
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @global \wpdb $wpdb
	 * @param int   $post_id Comments.
	 * @param array $metaIds Comments.
	 * @return int|bool
	 */
	public static function save( $post_id, array $metaIds ) {
		global $wpdb;

		/* first, delete current entries */
		$wpdb->delete(
			$wpdb->postmeta,
			array(
				'post_id'  => (int) $post_id,
				'meta_key' => Master::KEY,
			),
			array( '%d', '%s' )
		);
		foreach ( $metaIds as $metaId ) {
			$res = $wpdb->insert(
				$wpdb->postmeta,
				array(
					'post_id'    => (int) $post_id,
					'meta_key'   => Master::KEY,
					'meta_value' => (int) $metaId,
				),
				array( '%d', '%s', '%d' )
			);
		}

		return $res;
	}

	/**
	 * Returns array of data for each associated SKU item
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return array
	 */
	public function getSkusData() {
		return $this->skus;
	}

	/**
	 * Returns total units price of all associated SKUs
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return int
	 */
	public function getTotalPrice() {
		return $this->totalPrice;
	}

	/**
	 * Getter for `metaIds`
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return int[]
	 */
	public function getMetaIds() {
		return $this->metaIds;
	}

	/**
	 * Getter for `postId`
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return int
	 */
	public function getPostId() {
		return $this->postId;
	}

	/**
	 * Returns total units price of all associated SKUs
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return int
	 */
	public function getTotalPrice_taxincluded() {
		return $this->totalPrice_taxincluded;
	}

	/**
	 * Get the applicable tax rate
	 *
	 * @param  int    $post_id Post ID.
	 * @param  string $sku SKU Code.
	 * @return int
	 */
	public function get_sku_tax_rate( $post_id, $sku ) {
		global $usces;

		$skus = $usces->get_skus( $post_id, 'code' );
		if ( isset( $skus[ $sku ]['taxrate'] ) ) {
			$applicable_taxrate = $skus[ $sku ]['taxrate'];
		} else {
			$applicable_taxrate = 'standard';
		}
		if ( 'reduced' === $applicable_taxrate ) {
			$tax_rate = $usces->options['tax_rate_reduced'];
		} else {
			$tax_rate = $usces->options['tax_rate'];
		}
		return $tax_rate;
	}
}
