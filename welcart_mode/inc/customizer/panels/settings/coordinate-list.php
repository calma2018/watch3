<?php
/**
 * Customizer Panels Settings - Coordinate List
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* コーディネート一覧 */
$wp_customize->add_section(
	'coordinate_list_settings',
	array(
		'title'    => __( 'Coordinates list page', 'welcart_mode' ),
		'priority' => 80,
		'panel'    => 'general_settings',
	)
);

/**
 * コーディネート一覧ページ セッティング
 * ------------------------------------------------------ */

/* 81: コーディネートの見出し　*/
$wp_customize->add_setting(
	'mode_type_options[coordinates_headline]',
	array(
		'default'           => __( 'Coordinate', 'welcart_mode' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'coordinates_headline',
	array(
		'section'     => 'coordinate_list_settings',
		'settings'    => 'mode_type_options[coordinates_headline]',
		'type'        => 'text',
		'priority'    => 81,
		'description' => __( 'Please set the title.', 'welcart_mode' ),
	)
);

/* 82: コーディネートの見出し（Eng）　*/
$wp_customize->add_setting(
	'mode_type_options[coordinates_headline_eng]',
	array(
		'default'           => 'COORDINATE',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'coordinates_headline_eng',
	array(
		'section'     => 'coordinate_list_settings',
		'settings'    => 'mode_type_options[coordinates_headline_eng]',
		'type'        => 'text',
		'priority'    => 82,
		'description' => __( 'Please set the title(eng).', 'welcart_mode' ),
	)
);

/* 83: 投稿記事一覧のコンテンツ内容選択　*/
$wp_customize->add_setting(
	'mode_type_options[coordinate_list_cont]',
	array(
		'default'           => array( 'date', 'title' ),
		'sanitize_callback' => 'sanitize_multiple_checkbox',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	new vogusih_checkbox_multiple(
		$wp_customize,
		'coordinate_list_cont',
		array(
			'section'     => 'coordinate_list_settings',
			'settings'    => 'mode_type_options[coordinate_list_cont]',
			'type'        => 'checkbox',
			'choices'     => array(
				'date'  => __( 'Date' ),
				'title' => __( 'Title' ),
			),
			'priority'    => 83,
			'description' => __( 'Display selecting the items.', 'welcart_mode' ),
		)
	)
);

/* 84: モデル情報 */
$wp_customize->add_setting(
	'mode_type_options[display_model_info]',
	array(
		'default'    => 'show',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_model_info',
	array(
		'label'    => __( 'Display a Model Information', 'welcart_mode' ),
		'section'  => 'coordinate_list_settings',
		'settings' => 'mode_type_options[display_model_info]',
		'type'     => 'radio',
		'priority' => 84,
		'choices'  => array(
			'show' => __( 'Show', 'welcart_mode' ),
			'hide' => __( 'Do not show', 'welcart_mode' ),
		),
	)
);

/* 85: モデル情報表示項目 */
$wp_customize->add_setting(
	'mode_type_options[display_model_items]',
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
		'display_model_items',
		array(
			'section'         => 'coordinate_list_settings',
			'settings'        => 'mode_type_options[display_model_items]',
			'type'            => 'checkbox',
			'active_callback' => 'callback_model_info_items',
			'priority'        => 85,
			'choices'         => array(
				'thumbnail' => _x( 'Featured image', 'post' ),
				'name'      => __( 'Name' ),
				'sex'       => __( 'Type', 'welcart_mode' ),
				'height'    => __( 'Height', 'welcart_mode' ),
			),
		)
	)
);
