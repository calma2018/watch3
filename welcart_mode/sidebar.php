<?php
/**
 * Sidebar Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

?>

<aside id="secondary" class="secondary widget-area" role="complementary">

	<?php
	if ( is_home() || is_front_page() ) {
		if ( is_active_sidebar( 'secondary-widget-area1' ) ) {
			dynamic_sidebar( 'secondary-widget-area1' );
		}
	} elseif ( is_category( 'item' ) || is_category( get_child_category( 'item' ) ) || is_singular( 'post' ) && usces_is_item() || is_post_type_archive( 'coordinates' ) || is_singular( 'coordinates' ) || is_post_type_archive( 'features' ) || is_tax( 'features_cat' ) || is_tax( 'brand' ) || is_search() ) {
		if ( is_active_sidebar( 'secondary-widget-area2' ) ) {
			dynamic_sidebar( 'secondary-widget-area2' );
		}
	} else {
		if ( is_active_sidebar( 'secondary-widget-area3' ) ) {
			dynamic_sidebar( 'secondary-widget-area3' );
		}
	}
	?>

</aside>
