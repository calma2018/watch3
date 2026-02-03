<?php
/**
 * Coordinates Associated Coordinate Posts
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

namespace Welcart\Themes\Mode\Coordinates\Models;

use Welcart\Themes\Mode\Coordinates\Master;

/**
 * Model to manage coordinate posts associated with a given item
 */
class AssociatedCoordinatePosts {

	/**
	 * Item post ID
	 *
	 * @var int
	 */
	private $postId;

	/**
	 * Array of post IDs pointing to an associated coordinates post
	 *
	 * @var int[]
	 */
	private $postIds = array();

	/**
	 * Fetches associated coordinate posts given the post ID of an item
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
		$skus         = $usces->get_skus( $this->postId );
		foreach ( $skus as $sku ) {
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %d AND meta_key = %s",
					(int) $sku['meta_id'],
					Master::KEY
				)
			);

			foreach ( $results as $i => $obj ) {
				$postId     = (int) $obj->post_id;
				$postStatus = get_post_status( $postId );
				if ( is_user_logged_in() ) {
					if ( 'publish' === $postStatus || 'private' === $postStatus ) {
						$this->postIds[] = $postId;
					}
				} else {
					if ( 'publish' === $postStatus ) {
						$this->postIds[] = $postId;
					}
				}
			}
		}
	}

	/**
	 * Returns list of post IDs pointing to an associated coordinate post
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return int[]
	 */
	public function getPostIds() {
		return $this->postIds;
	}
}
