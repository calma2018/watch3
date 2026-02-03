<?php
/**
 * Coordinates Master
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

namespace Welcart\Themes\Mode\Coordinates;

/**
 * Loads coordinates customization
 */
class Master {

	/**
	 * Database meta key
	 */
	const KEY = 'mode-coordinates';

	/**
	 * Initializes coordinates customization
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return void
	 */
	public function init() {
		require_once __DIR__ . '/API/ItemData.php';
		require_once __DIR__ . '/Models/AssociatedSkus.php';
		require_once __DIR__ . '/Models/AssociatedCoordinatePosts.php';
		require_once __DIR__ . '/CoordinatesMeta/CoordinatesMeta.php';
		require_once __DIR__ . '/template-functions.php';

		$this->addRoutes();
		( new CoordinatesMeta\CoordinatesMeta() )->init();
	}

	/**
	 * Returns HTML `img` tag for `assets/images/no-image.jpg` file
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @param int $width Default: 235.
	 * @param int $height Default: 300.
	 * @return string
	 */
	public static function getNoImageHtml( $width = 235, $height = 300 ) {
		ob_start();
		?>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ); ?>"
			alt="noimage"
			sizes="(max-width: 235px) 100vw, 235px"
			width="<?php echo esc_attr( $width ); ?>"
			height="<?php echo esc_attr( $height ); ?>"
		/>
		<?php
		return (string) ob_get_clean();
	}

	/**
	 * Adds REST routes
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return void
	 */
	public function addRoutes() {
		add_action(
			'rest_api_init',
			function () {
				$itemData = new API\ItemData();

				register_rest_route(
					'mode',
					'/getItemDataByItemCode',
					array(
						'methods'             => 'GET',
						'callback'            => array( $itemData, 'getItemDataByItemCode' ),
						'permission_callback' => array( $this, 'hasEditorRole' ),
					)
				);
				register_rest_route(
					'mode',
					'/getItemsByCategoryId',
					array(
						'methods'             => 'GET',
						'callback'            => array( $itemData, 'getItemsByCategoryId' ),
						'permission_callback' => array( $this, 'hasEditorRole' ),
					)
				);
			}
		);
	}

	/**
	 * Returns `true` if the current user has necessary permissions for calling admin APIs, `false` otherwise
	 *
	 * @author Evan D Shaw <evandanielshaw@gmail.com>
	 * @return bool
	 */
	public function hasEditorRole() {
		if ( ! current_user_can( 'edit_posts' ) ) {
			return false;
		}

		return true;
	}
}
