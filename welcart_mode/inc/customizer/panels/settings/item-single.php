<?php
/**
 * Customizer Panels Settings - Item Single
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* 商品詳細ページ */
$wp_customize->add_section(
	'item_settings',
	array(
		'title'    => __( 'Item Detail Page', 'welcart_mode' ),
		'priority' => 40,
		'panel'    => 'general_settings',
	)
);

/**
 * 商品詳細ページ セッティング
 * ------------------------------------------------------ */

/* 110: 商品詳細ページの商品説明表示位置*/
$wp_customize->add_setting(
	'mode_type_options[content_position]',
	array(
		'default'    => 'initial',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_content_position',
	array(
		'label'    => __( 'Position of Item Description', 'welcart_mode' ),
		'section'  => 'item_settings',
		'settings' => 'mode_type_options[content_position]',
		'type'     => 'select',
		'choices'  => array(
			'initial' => __( 'Default', 'welcart_mode' ),
			'lp'      => __( 'Top of page', 'welcart_mode' ),
		),
		'priority' => 41,
	)
);

/* 120: 商品詳細ページのページタイトル表示*/
$wp_customize->add_setting(
	'mode_type_options[item_page_title]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_item_page_title',
	array(
		'label'           => __( 'Display page title', 'welcart_mode' ),
		'section'         => 'item_settings',
		'settings'        => 'mode_type_options[item_page_title]',
		'type'            => 'checkbox',
		'active_callback' => 'callback_content_position',
		'priority'        => 42,
	)
);

/* 130: 商品詳細ページのカートボタン名*/
$wp_customize->add_setting(
	'mode_type_options[cart_button]',
	array(
		'default'           => __( 'Add to Shopping Cart', 'usces' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_cart_button',
	array(
		'label'    => __( 'The cart button', 'welcart_mode' ),
		'section'  => 'item_settings',
		'settings' => 'mode_type_options[cart_button]',
		'type'     => 'text',
		'priority' => 43,
	)
);

/* 140: 商品詳細ページの売切れ時の表示文字 */
$wp_customize->add_setting(
	'mode_type_options[soldout_text]',
	array(
		'default'           => __( 'At present we cannot deal with this product', 'welcart_mode' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_soldout_text',
	array(
		'label'       => __( 'Display when sold out', 'welcart_mode' ),
		'section'     => 'item_settings',
		'settings'    => 'mode_type_options[soldout_text]',
		'type'        => 'text',
		'priority'    => 44,
		'description' => __( 'Please set the text.', 'welcart_mode' ),
	)
);

/* 150: 商品詳細ページの商品お問い合わせ表示 */
$wp_customize->add_setting(
	'mode_type_options[display_inquiry]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_display_inquiry',
	array(
		'label'    => __( 'Display the inquiry button', 'welcart_mode' ),
		'section'  => 'item_settings',
		'settings' => 'mode_type_options[display_inquiry]',
		'type'     => 'checkbox',
		'priority' => 45,
	)
);

/* 160: 商品詳細ページの売切れ時お問い合わせ表示 */
$wp_customize->add_setting(
	'mode_type_options[inquiry_position]',
	array(
		'default'    => 'initial',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_inquiry_position',
	array(
		'section'  => 'item_settings',
		'settings' => 'mode_type_options[inquiry_position]',
		'type'     => 'select',
		'choices'  => array(
			'initial' => __( 'Display only when sold out', 'welcart_mode' ),
			'always'  => __( 'Always show', 'welcart_mode' ),
		),
		'priority' => 46,
	)
);

/* 170: 商品詳細ページの売切れ時お問い合わせリンク先 */
$wp_customize->add_setting(
	'mode_type_options[inquiry_link]',
	array(
		'default'    => 0,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_inquiry_link',
	array(
		'section'     => 'item_settings',
		'settings'    => 'mode_type_options[inquiry_link]',
		'type'        => 'dropdown-pages',
		'priority'    => 47,
		'description' => __( 'Please select the destination of the inquiry destination.', 'welcart_mode' ),
	)
);

/* 180: 商品詳細ページのお問い合わせボタン文言 */
$wp_customize->add_setting(
	'mode_type_options[inquiry_text]',
	array(
		'default'           => __( 'Inquiries about this product', 'welcart_mode' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_inquiry_text',
	array(
		'section'     => 'item_settings',
		'settings'    => 'mode_type_options[inquiry_text]',
		'type'        => 'text',
		'priority'    => 48,
		'description' => __( 'Please set the text.', 'welcart_mode' ),
	)
);

$wp_customize->add_setting(
	'mode_type_options[display_item_single]',
	array(
		'default'           => array(
			'itemcode',
			'status',
			'brand',
			'review',
		),
		'sanitize_callback' => 'sanitize_multiple_checkbox',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	new vogusih_checkbox_multiple(
		$wp_customize,
		'display_item_single',
		array(
			'section'  => 'item_settings',
			'settings' => 'mode_type_options[display_item_single]',
			'type'     => 'checkbox',
			'choices'  => array(
				'itemcode' => __( 'item code', 'usces' ),
				'status'   => __( 'stock status', 'usces' ),
				'brand'    => __( 'Brand label', 'welcart_mode' ),
				'review'   => __( 'Review', 'welcart_mode' ),
			),
			'priority' => 49,
		)
	)
);
