<?php
/**
 * Create Custom Post Type
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/*
 * Registing Custom Post Type
 */
add_action( 'init', 'mode_create_feature' );
add_action( 'init', 'mode_create_coordinate' );

/**
 * Create Coordinate
 *
 * @return void
 */
function mode_create_coordinate() {

	$labels = array(
		'name'               => __( 'Coordinates', 'welcart_mode' ),
		'singular_name'      => __( 'Coordinate', 'welcart_mode' ),
		'menu_name'          => __( 'Coordinates', 'welcart_mode' ),
		'name_admin_bar'     => __( 'Coordinate', 'welcart_mode' ),
		'add_new'            => __( 'Add New Cordinate', 'welcart_mode' ),
		'add_new_item'       => __( 'Add New Cordinate', 'welcart_mode' ),
		'new_item'           => __( 'New Coordinate', 'welcart_mode' ),
		'edit_item'          => __( 'Edit Coordinate', 'welcart_mode' ),
		'view_item'          => __( 'View Coordinate', 'welcart_mode' ),
		'all_items'          => __( 'All Coordinates', 'welcart_mode' ),
		'search_items'       => __( 'Search Coordinates', 'welcart_mode' ),
		'not_found'          => __( 'No Coordinates found.', 'welcart_mode' ),
		'not_found_in_trash' => __( 'No Coordinates found in Trash.', 'welcart_mode' ),
	);

	$args = array(
		'labels'        => $labels,
		'public'        => true,
		'rewrite'       => array( 'slug' => 'coordinates' ),
		'has_archive'   => true,
		'menu_position' => 6,
		'menu_icon'     => 'dashicons-camera-alt',
		'supports'      => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions' ),
		'show_ui'       => true,
		'show_in_rest'  => true,
	);
	register_post_type( 'coordinates', $args );

}

/**
 * Create Feature
 *
 * @return void
 */
function mode_create_feature() {

	$labels = array(
		'name'               => __( 'Feature', 'welcart_mode' ),
		'singular_name'      => __( 'Feature', 'welcart_mode' ),
		'menu_name'          => __( 'Features', 'welcart_mode' ),
		'name_admin_bar'     => __( 'Feature', 'welcart_mode' ),
		'add_new'            => __( 'Add New Feature', 'welcart_mode' ),
		'add_new_item'       => __( 'Add New Feature', 'welcart_mode' ),
		'new_item'           => __( 'New Feature', 'welcart_mode' ),
		'edit_item'          => __( 'Edit Feature', 'welcart_mode' ),
		'view_item'          => __( 'View Feature', 'welcart_mode' ),
		'all_items'          => __( 'All Features', 'welcart_mode' ),
		'search_items'       => __( 'Search Features', 'welcart_mode' ),
		'parent_item_colon'  => __( 'Parent Features:', 'welcart_mode' ),
		'not_found'          => __( 'No Features found.', 'welcart_mode' ),
		'not_found_in_trash' => __( 'No Features found in Trash.', 'welcart_mode' ),
	);

	$args = array(
		'labels'        => $labels,
		'public'        => true,
		'rewrite'       => array( 'slug' => 'features' ),
		'has_archive'   => true,
		'menu_position' => 8,
		'menu_icon'     => 'dashicons-edit',
		'supports'      => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions' ),
		'show_ui'       => true,
		'show_in_rest'  => true,
	);
	register_post_type( 'features', $args );

}

/**
 * Rewrite Flush
 *
 * @return void
 */
function mode_rewrite_flush() {

	flush_rewrite_rules();

}
add_action( 'after_switch_theme', 'mode_rewrite_flush' );
