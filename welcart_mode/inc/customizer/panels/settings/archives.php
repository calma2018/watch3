<?php
/**
 * Customizer Panels Settings - Arcives
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* 投稿一覧 */
$wp_customize->add_section(
	'archives_settings',
	array(
		'title'    => __( 'Post list page', 'welcart_mode' ),
		'priority' => 60,
		'panel'    => 'general_settings',
	)
);

/* 261: 投稿記事一覧のレイアウト（リスト）　*/
$wp_customize->add_setting(
	'mode_type_options[archives_list_column]',
	array(
		'default'    => 2,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'archives_list_column',
	array(
		'section'     => 'archives_settings',
		'settings'    => 'mode_type_options[archives_list_column]',
		'type'        => 'number',
		'input_attrs' => array(
			'min' => '1',
			'max' => '2',
		),
		'priority'    => 61,
		'description' => __( 'Please select a display column.', 'welcart_mode' ),
	)
);

/* 290: 投稿記事一覧のコンテンツ内容選択　*/
$wp_customize->add_setting(
	'mode_type_options[archives_cont]',
	array(
		'default'           => array( 'thumbnail', 'date', 'title', 'excerpt' ),
		'sanitize_callback' => 'sanitize_multiple_checkbox',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	new vogusih_checkbox_multiple(
		$wp_customize,
		'archives_cont',
		array(
			'section'  => 'archives_settings',
			'settings' => 'mode_type_options[archives_cont]',
			'type'     => 'checkbox',
			'choices'  => array(
				'thumbnail' => _x( 'Featured image', 'post' ),
				'date'      => __( 'Date' ),
				'title'     => __( 'Title' ),
				'excerpt'   => __( 'Excerpt' ),
			),
			'priority' => 62,
		)
	)
);
