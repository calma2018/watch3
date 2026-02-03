<?php
/**
 * Create Taxonomies
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Create Model Taxonomie
 *
 * @return void
 */
function mode_create_model() {

	$labels = array(
		'name'              => __( 'Models', 'welcart_mode' ),
		'singular_name'     => __( 'Model', 'welcart_mode' ),
		'search_items'      => __( 'Search Models', 'welcart_mode' ),
		'all_items'         => __( 'All Models', 'welcart_mode' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Model', 'welcart_mode' ),
		'update_item'       => __( 'Update Model', 'welcart_mode' ),
		'add_new_item'      => __( 'Add New Model', 'welcart_mode' ),
		'menu_name'         => __( 'Model', 'welcart_mode' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'model' ),
	);
	register_taxonomy( 'model', 'coordinates', $args );

	$argss = array(
		'hierarchical'          => false,
		'update_count_callback' => '_update_post_term_count',
		'labels'                => 'Coordinate Tags',
		'public'                => true,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
	);
	register_taxonomy( 'coorditag', 'coordinates', $argss );

}
add_action( 'init', 'mode_create_model' );

/**
 * Create Feature Taxonomie
 *
 * @return void
 */
function mode_create_featurecat() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category', 'welcart_mode' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => _x( 'Categories', 'taxonomy general name' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'features_cat' ),
	);
	register_taxonomy( 'features_cat', 'features', $args );

}
add_action( 'init', 'mode_create_featurecat' );

/**
 * Create Brand Taxonomie
 *
 * @return void
 */
function mode_create_brand() {

	$labels = array(
		'name'              => __( 'Brands', 'welcart_mode' ),
		'singular_name'     => __( 'Brand', 'welcart_mode' ),
		'search_items'      => __( 'Search Brands', 'welcart_mode' ),
		'all_items'         => __( 'All Brands', 'welcart_mode' ),
		'parent_item'       => __( 'Parent Brand', 'welcart_mode' ),
		'parent_item_colon' => __( 'Parent Brand:', 'welcart_mode' ),
		'edit_item'         => __( 'Edit Brand', 'welcart_mode' ),
		'update_item'       => __( 'Update Brand', 'welcart_mode' ),
		'add_new_item'      => __( 'Add New Brand', 'welcart_mode' ),
		'menu_name'         => __( 'Brand', 'welcart_mode' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => false,
		'rewrite'           => array( 'slug' => 'brand' ),
	);
	register_taxonomy( 'brand', array( 'post' ), $args );

}
add_action( 'init', 'mode_create_brand' );

/**
 * Remove Brand Submenu
 *
 * @return void
 */
function remove_brand_submenu() {

	remove_submenu_page( 'edit.php?post_type=coordinates', 'edit-tags.php?taxonomy=brand&amp;post_type=coordinates' );
	remove_submenu_page( 'edit.php?post_type=features', 'edit-tags.php?taxonomy=brand&amp;post_type=features' );

}
add_action( 'admin_menu', 'remove_brand_submenu' );

/**
 * Hide Brand Adder
 *
 * @return void
 */
function hide_brand_adder() {
	global $pagenow;
	global $post_type;
	if ( is_admin() ) {
		echo '<style type="text/css"> .welcart-shop_page_usces_itemedit #brand-adder{display:none;} </style>';
	}
}
add_action( 'admin_head', 'hide_brand_adder' );
