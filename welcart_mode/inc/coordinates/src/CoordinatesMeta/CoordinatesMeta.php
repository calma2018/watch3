<?php
/**
 * Coordinates Coordinates Meta
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

namespace Welcart\Themes\Mode\Coordinates\CoordinatesMeta;

use Welcart\Themes\Mode\Coordinates\Models\AssociatedSkus;

/**
 * Initializes post meta box for coordinate post types
 */
class CoordinatesMeta {

	/**
	 * Meta setup
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return void
	 */
	public function init() {
		add_action( 'save_post', array( $this, 'saveCoordinatesMetaData' ), 10, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'loadCoordinatesMetaBoxAssets' ), 10, 1 );

		/* Add 40x40 thumbnail size so that drag-and-drop tab images load faster */
		add_action(
			'after_setup_theme',
			function () {
				add_image_size( 'tab-thumb', 40, 40, true );
			}
		);

		add_action(
			'add_meta_boxes',
			function () {
				add_meta_box(
					'coordinates',
					__( 'Related Items Selection', 'welcart_mode' ),
					array( $this, 'metabox' ),
					'coordinates'
				);
			}
		);
	}

	/**
	 * Loads coordinates meta box displayed at the bottom of the block editor
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @global string $typenow Comments.
	 * @param string $hook_suffix Comments.
	 * @return void
	 */
	public function loadCoordinatesMetaBoxAssets( $hook_suffix ) {
		global $typenow;

		if ( 'coordinates' === $typenow && ( 'post.php' === $hook_suffix || 'post-new.php' === $hook_suffix ) ) {
			$handle = 'mode-coordinates';
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script(
				$handle,
				MODE_COORDINATES_URL . '/src/CoordinatesMeta/CoordinatesMeta.js',
				array( 'jquery-ui-sortable' ),
				MODE_VERSION,
				false
			);
			wp_enqueue_style(
				$handle,
				MODE_COORDINATES_URL . '/src/CoordinatesMeta/CoordinatesMeta.css',
				array(),
				MODE_VERSION
			);
			wp_localize_script(
				$handle,
				'mode',
				array(
					'endpoint' => esc_url_raw( rest_url() ),
					'nonce'    => wp_create_nonce( 'wp_rest' ),
					'loader'   => '<img src="' . USCES_PLUGIN_URL . '/images/loading.gif" />',
				)
			);
		}
	}

	/**
	 * Saves coordinates meta data on draft save or publish
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @param int $post_id Comments.
	 * @return mixed
	 */
	public function saveCoordinatesMetaData( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( empty( $_POST['coordinates-meta-ids'] ) ) {
			return $post_id;
		}

		AssociatedSkus::save( $post_id, $_POST['coordinates-meta-ids'] );
	}

	/**
	 * Adds coordinates meta box to the bottom of the post edit page
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @param \WP_Post $post Comments.
	 * @return void
	 */
	public function metabox( $post ) {
		$meta = new AssociatedSkus( $post->ID );
		$tabs = $meta->getSkusData();
		?>
		<div id="addItemDialog" class="coordinates">
			<div class="add-item-header"><h4><?php esc_html_e( 'Add item', 'usces' ); ?></h4><div id="loading"></div></div>
			<div id="coordinates-api-response"></div>
			<div class="boxes">
				<div class="left-box">
					<table id="coordinates-meta-table" class="meta-table">
						<tbody>
							<tr>
								<th><?php esc_html_e( 'Item Category', 'usces' ); ?></th>
								<td>
									<?php
									$idObj            = get_category_by_slug( 'item' );
									$dropdown_options = apply_filters(
										'usces_filter_ordereditform_dropdown_options',
										array(
											'show_option_none' => __( 'Select a category', 'usces' ),
											'name'         => 'coordinates-category',
											'id'           => 'coordinates-category',
											'hide_empty'   => 1,
											'hierarchical' => 1,
											'orderby'      => 'name',
											'child_of'     => $idObj->term_id,
										)
									);
									wp_dropdown_categories( $dropdown_options );
									?>
								</td>
							</tr>
							<tr>
								<th><?php esc_html_e( 'Item to be added', 'usces' ); ?></th>
								<td><select name="coordinates-itemcode" id="coordinates-itemcode"></select></td>
							</tr>
							<tr id="coordinates-t-bottom">
								<th><?php esc_html_e( 'item code', 'usces' ); ?></th>
								<td>
									<input
										type="text"
										name="coordinates-itemcodein"
										id="coordinates-itemcodein"
										class="text"
									/>
									<input
										name="getitem"
										id="coordinates-getitembtn"
										type="button"
										class="button button-primary"
										value="<?php esc_html_e( 'Get Results', 'welcart_mode' ); ?>"
									/>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="item-tabs-container" class="right-box">
					<ul id="item-tabs">
						<?php foreach ( $tabs as $sku ) : ?>
							<?php
							$skuName = ! empty( $sku['name'] ) ? $sku['name'] : $sku['code'];
							?>
							<li class="ui-state-default">
								<input
									type="hidden"
									name="coordinates-meta-ids[]"
									value="<?php echo esc_attr( $sku['meta_id'] ); ?>"
								/>
								<div class="li-wrapper">
									<?php
									if ( ! empty( $sku['tabImage'] ) ) {
										echo wp_kses_post( $sku['tabImage'] );
									}
									?>
									<div class="li-item-name">
										<span><?php echo esc_html( $sku['itemName'] . '&emsp;' . $skuName ); ?></span>
										<div class="li-delete">
											<span class="dashicons dashicons-dismiss"></span>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}
