<?php
/**
 * Customizer Panels Settings - Item List
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

$wp_customize->add_section(
	'item_list_settings',
	array(
		'title'    => __( 'Item List', 'welcart_mode' ),
		'priority' => 30,
		'panel'    => 'general_settings',
	)
);

/**
 * 商品一覧レイアウト セッティング
 * ------------------------------------------------------ */

/* 150: 商品一覧ページにサブカテゴリーを表示する */
$wp_customize->add_setting(
	'mode_type_options[display_sub_categories]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_sub_categories',
	array(
		'label'    => __( 'Display a list of child categories on the product category page', 'welcart_mode' ),
		'section'  => 'item_list_settings',
		'settings' => 'mode_type_options[display_sub_categories]',
		'type'     => 'checkbox',
		'priority' => 31,
	)
);

/* 190: コーディネート記事一覧のカラム数 */
$wp_customize->add_setting(
	'mode_type_options[item_list_column]',
	array(
		'default'    => 5,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'item_list_column',
	array(
		'section'     => 'item_list_settings',
		'settings'    => 'mode_type_options[item_list_column]',
		'type'        => 'number',
		'input_attrs' => array(
			'min' => '3',
			'max' => '6',
		),
		'priority'    => 32,
		'description' => __( 'Please select a display column.', 'welcart_mode' ),
	)
);

/* 290: 投稿記事一覧のコンテンツ内容選択　*/
$wp_customize->add_setting(
	'mode_type_options[item_cont]',
	array(
		'default'           => array(
			'item-img',
			'item-name',
			'item-soldout',
			'item-tag',
			'brand',
		),
		'sanitize_callback' => 'sanitize_multiple_checkbox',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	new vogusih_checkbox_multiple(
		$wp_customize,
		'item_cont',
		array(
			'section'  => 'item_list_settings',
			'settings' => 'mode_type_options[item_cont]',
			'type'     => 'checkbox',
			'choices'  => array(
				'item-img'     => __( 'Item image', 'usces' ),
				'item-name'    => __( 'item name', 'usces' ),
				'item-soldout' => __( 'Sold Out', 'usces' ),
				'item-tag'     => __( 'item tag', 'welcart_mode' ),
				'brand'        => __( 'Brand label', 'welcart_mode' ),
			),
			'priority' => 33,
		)
	)
);
$wp_customize->add_setting(
	'mode_type_options[display_produt_tag]',
	array(
		'default'           => true,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'display_produt_tag',
	array(
		'label'    => __( 'Display the produt tag', 'welcart_mode' ),
		'section'  => 'item_list_settings',
		'settings' => 'mode_type_options[display_produt_tag]',
		'type'     => 'checkbox',
		'priority' => 34,
	)
);

$wp_customize->add_setting(
	'mode_type_options[display_newtag_text]',
	array(
		'default'           => __( 'New', 'welcart_mode' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'display_newtag_text',
	array(
		'label'    => __( 'Text to be displayed on "New" tag', 'welcart_mode' ),
		'section'  => 'item_list_settings',
		'settings' => 'mode_type_options[display_newtag_text]',
		'priority' => 35,
	)
);

$wp_customize->add_setting(
	'mode_type_options[display_hottag_text]',
	array(
		'default'           => __( 'Recommend', 'welcart_mode' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'display_hottag_text',
	array(
		'label'    => __( 'Text to be displayed on "Recommend" tag', 'welcart_mode' ),
		'section'  => 'item_list_settings',
		'settings' => 'mode_type_options[display_hottag_text]',
		'priority' => 36,
	)
);

$wp_customize->add_setting(
	'mode_type_options[display_saletag_text]',
	array(
		'default'           => __( 'Sale', 'welcart_mode' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'display_saletag_text',
	array(
		'label'       => __( 'Text to be displayed on "Sale" tag', 'welcart_mode' ),
		'section'     => 'item_list_settings',
		'settings'    => 'mode_type_options[display_saletag_text]',
		'description' => __( 'If blank, "Sale" tag is not displayed.', 'welcart_mode' ),
		'priority'    => 37,
	)
);

$wp_customize->add_setting(
	'mode_type_options[subimage_hover]',
	array(
		'default'           => true,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'subimage_hover',
	array(
		'label'    => __( 'Display a Sub Image when Hover', 'welcart_mode' ),
		'section'  => 'item_list_settings',
		'settings' => 'mode_type_options[subimage_hover]',
		'type'     => 'checkbox',
		'priority' => 38,
	)
);
$wp_customize->add_setting(
	'mode_type_options[image_square]',
	array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'image_square',
	array(
		'label'    => __( 'Display Images of List to Square', 'welcart_mode' ),
		'section'  => 'item_list_settings',
		'settings' => 'mode_type_options[image_square]',
		'type'     => 'checkbox',
		'priority' => 39,
	)
);
