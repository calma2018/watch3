<?php
/**
 * Customizer Panels Settings - Coordinate Single
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* コーディネート詳細 */
$wp_customize->add_section(
	'coordinate_post_settings',
	array(
		'title'    => __( 'Coordinates single page', 'welcart_mode' ),
		'priority' => 90,
		'panel'    => 'general_settings',
	)
);

/**
 * コーディネート詳細ページ セッティング
 * ------------------------------------------------------ */

/* 91: ページタイトルの表示 */
$wp_customize->add_setting(
	'mode_type_options[display_coordinate_title]',
	array(
		'default'    => 'show',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_coordinate_title',
	array(
		'label'    => __( 'Display page title', 'welcart_mode' ),
		'section'  => 'coordinate_post_settings',
		'settings' => 'mode_type_options[display_coordinate_title]',
		'type'     => 'radio',
		'priority' => 91,
		'choices'  => array(
			'show' => __( 'Show', 'welcart_mode' ),
			'hide' => __( 'Do not show', 'welcart_mode' ),
		),
	)
);

/* 96: サブタイトル　*/
$wp_customize->add_setting(
	'mode_type_options[display_coordinate_subtitle]',
	array(
		'default'           => __( 'Styling Item', 'welcart_mode' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'display_coordinate_subtitle',
	array(
		'section'     => 'coordinate_post_settings',
		'settings'    => 'mode_type_options[display_coordinate_subtitle]',
		'type'        => 'text',
		'priority'    => 92,
		'description' => __( 'Please set the Sub title.', 'welcart_mode' ),
	)
);

/* 92: モデル情報 */
$wp_customize->add_setting(
	'mode_type_options[display_post_model_info]',
	array(
		'default'    => 'show',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_post_model_info',
	array(
		'label'    => __( 'Display a Model Information', 'welcart_mode' ),
		'section'  => 'coordinate_post_settings',
		'settings' => 'mode_type_options[display_post_model_info]',
		'type'     => 'radio',
		'priority' => 93,
		'choices'  => array(
			'show' => __( 'Show', 'welcart_mode' ),
			'hide' => __( 'Do not show', 'welcart_mode' ),
		),
	)
);

/* 93: モデル情報表示項目 */
$wp_customize->add_setting(
	'mode_type_options[display_post_model_items]',
	array(
		'default'           => array( 'thumbnail', 'name', 'sex', 'height' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_multiple_checkbox',
	)
);
$wp_customize->add_control(
	new vogusih_checkbox_multiple(
		$wp_customize,
		'display_post_model_items',
		array(
			'section'         => 'coordinate_post_settings',
			'settings'        => 'mode_type_options[display_post_model_items]',
			'type'            => 'checkbox',
			'priority'        => 94,
			'active_callback' => 'callback_post_model_info_items',
			'choices'         => array(
				'thumbnail' => _x( 'Featured image', 'post' ),
				'name'      => __( 'Name' ),
				'sex'       => __( 'Type', 'welcart_mode' ),
				'height'    => __( 'Height', 'welcart_mode' ),
			),
		)
	)
);

/* 94: コーディネイト一覧 */
$wp_customize->add_setting(
	'mode_type_options[display_model_coordinates]',
	array(
		'default'    => 'show',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_model_coordinates',
	array(
		'label'    => __( 'Display The Model Coordinate List', 'welcart_mode' ),
		'section'  => 'coordinate_post_settings',
		'settings' => 'mode_type_options[display_model_coordinates]',
		'type'     => 'radio',
		'priority' => 95,
		'choices'  => array(
			'show' => __( 'Show', 'welcart_mode' ),
			'hide' => __( 'Do not show', 'welcart_mode' ),
		),
	)
);

/* 95: コーディネイトタグ一覧 */
$wp_customize->add_setting(
	'mode_type_options[display_coordinate_tags]',
	array(
		'default'    => 'show',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_coordinate_tags',
	array(
		'label'    => __( 'Display The Coordinate Tag List', 'welcart_mode' ),
		'section'  => 'coordinate_post_settings',
		'settings' => 'mode_type_options[display_coordinate_tags]',
		'type'     => 'radio',
		'priority' => 96,
		'choices'  => array(
			'show' => __( 'Show', 'welcart_mode' ),
			'hide' => __( 'Do not show', 'welcart_mode' ),
		),
	)
);
