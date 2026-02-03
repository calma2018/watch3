<?php
/**
 * Customizer Panels Settings - Sidebar
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* サイドバー */
$wp_customize->add_section(
	'sidebar_settings',
	array(
		'title'    => __( 'Sidebar' ),
		'priority' => 20,
		'panel'    => 'general_settings',
	)
);

/**
 * サイドバー セッティング
 * ------------------------------------------------------ */

/* 110: 表示レイアウト */
$wp_customize->add_setting(
	'mode_type_options[sidebar_layout]',
	array(
		'default'    => 'position-left',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_sidebar_layout',
	array(
		'label'    => __( 'Layout', 'welcart_mode' ),
		'section'  => 'sidebar_settings',
		'settings' => 'mode_type_options[sidebar_layout]',
		'type'     => 'radio',
		'choices'  => array(
			'position-left'  => __( 'Left Sidebar', 'welcart_mode' ),
			'position-right' => __( 'Right Sidebar', 'welcart_mode' ),
		),
		'priority' => 21,
	)
);

/* 120: レイアウト適用ページ */
$wp_customize->add_setting(
	'mode_type_options[display_sidebar]',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_multiple_checkbox',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	new vogusih_checkbox_multiple(
		$wp_customize,
		'display_sidebar',
		array(
			'section'  => 'sidebar_settings',
			'settings' => 'mode_type_options[display_sidebar]',
			'type'     => 'checkbox',
			'choices'  => array(
				'home'        => __( 'Home' ),
				'posts'       => __( 'Post list page', 'welcart_mode' ),
				'item-list'   => __( 'Item list page', 'welcart_mode' ),
				'item-single' => __( 'Item single page', 'welcart_mode' ),
				'coordinates' => __( 'Coordinates list page', 'welcart_mode' ),
				'brands'      => __( 'Brand list page', 'welcart_mode' ),
				'features'    => __( 'Feature list Page', 'welcart_mode' ),
				'search'      => __( 'Search result page', 'welcart_mode' ),
			),
			'priority' => 22,
		)
	)
);
