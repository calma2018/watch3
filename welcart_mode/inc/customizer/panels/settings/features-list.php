<?php
/**
 * Customizer Panels Settings - Features List
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* 特集一覧 */
$wp_customize->add_section(
	'features_settings',
	array(
		'title'    => __( 'Features list page', 'welcart_mode' ),
		'priority' => 70,
		'panel'    => 'general_settings',
	)
);

/**
 * 特集一覧 セッティング
 * ------------------------------------------------------ */

/* 110: 表示レイアウト */
$wp_customize->add_setting(
	'mode_type_options[features_index_layout]',
	array(
		'default'    => 'default-layout',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_features_index_layout',
	array(
		'label'    => __( 'Features List Top', 'welcart_mode' ),
		'section'  => 'features_settings',
		'settings' => 'mode_type_options[features_index_layout]',
		'type'     => 'radio',
		'choices'  => array(
			'default-layout' => __( 'Default display', 'welcart_mode' ),
			'section-layout' => __( 'Display by category', 'welcart_mode' ),
		),
		'priority' => 71,
	)
);

/* 261: 特集記事一覧のレイアウト　*/
$wp_customize->add_setting(
	'mode_type_options[archive_features_num]',
	array(
		'default'    => 3,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'archive_features_num',
	array(
		'section'         => 'features_settings',
		'settings'        => 'mode_type_options[archive_features_num]',
		'type'            => 'number',
		'priority'        => 72,
		'description'     => __( 'Please set the number of items to be displayed.', 'welcart_mode' ),
		'active_callback' => 'callback_display_section_layout',
	)
);

/* 150: 特集記事一覧のコンテンツ選択 */
$wp_customize->add_setting(
	'mode_type_options[archive_features_cont]',
	array(
		'default'           => array(
			'thumbnail',
			'term',
			'date',
			'title',
			'excerpt',
		),
		'sanitize_callback' => 'sanitize_multiple_checkbox',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	new vogusih_checkbox_multiple(
		$wp_customize,
		'archive_features_cont',
		array(
			'section'  => 'features_settings',
			'settings' => 'mode_type_options[archive_features_cont]',
			'type'     => 'checkbox',
			'choices'  => array(
				'thumbnail' => _x( 'Featured image', 'post' ),
				'term'      => __( 'Category', 'welcart_mode' ),
				'date'      => __( 'Date' ),
				'title'     => __( 'Title' ),
				'excerpt'   => __( 'Excerpt' ),
			),
			'priority' => 73,
		)
	)
);
