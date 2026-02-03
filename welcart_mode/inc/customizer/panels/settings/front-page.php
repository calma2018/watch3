<?php
/**
 * Customizer Panels Settings - Front Page
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* フロント設定　*/
$wp_customize->add_section(
	'front_settings',
	array(
		'title'    => __( 'Front Setting', 'welcart_mode' ),
		'priority' => 10,
		'panel'    => 'general_settings',
	)
);

/**
 * フロント設定 セッティング
 * ------------------------------------------------------ */

/* 110: 特集記事一覧の表示*/
$wp_customize->add_setting(
	'mode_type_options[display_features]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_display_features',
	array(
		'label'    => __( 'Display features', 'welcart_mode' ),
		'section'  => 'front_settings',
		'settings' => 'mode_type_options[display_features]',
		'type'     => 'checkbox',
		'priority' => 11,
	)
);

/* 120: 特集記事一覧の表示件数*/
$wp_customize->add_setting(
	'mode_type_options[features_num]',
	array(
		'default'    => 5,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'features_num',
	array(
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[features_num]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min' => '1',
		),
		'active_callback' => 'callback_display_features',
		'priority'        => 12,
		'description'     => __( 'Please select a display number.', 'welcart_mode' ),
	)
);

/* 140: 特集記事一覧のモバイルスライド機能 */
$wp_customize->add_setting(
	'mode_type_options[features_slide]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_features_slide',
	array(
		'label'           => __( 'Slide Function', 'welcart_mode' ),
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[features_slide]',
		'type'            => 'checkbox',
		'active_callback' => 'callback_display_features',
		'priority'        => 13,
	)
);

/* 140: 特集記事一覧のモバイルスライド機能 */
$wp_customize->add_setting(
	'mode_type_options[features_slide_mobile]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_features_slide_mobile',
	array(
		'label'           => __( 'Mobile only', 'welcart_mode' ),
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[features_slide_mobile]',
		'type'            => 'checkbox',
		'active_callback' => 'callback_features_slide_mobile',
		'priority'        => 14,
	)
);

/* 150: 特集記事一覧のコンテンツ選択 */
$wp_customize->add_setting(
	'mode_type_options[features_cont]',
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
		'features_cont',
		array(
			'section'         => 'front_settings',
			'settings'        => 'mode_type_options[features_cont]',
			'type'            => 'checkbox',
			'active_callback' => 'callback_display_features',
			'choices'         => array(
				'thumbnail' => _x( 'Featured image', 'post' ),
				'term'      => __( 'Categories' ),
				'date'      => __( 'Date' ),
				'title'     => __( 'Title' ),
				'excerpt'   => __( 'Excerpt' ),
			),
			'priority'        => 15,
		)
	)
);


/* 160: 商品一覧ウィジェットのスライダー */
$wp_customize->add_setting(
	'mode_type_options[display_widget_slide]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_widget_slide',
	array(
		'label'           => __( 'Slide Function', 'welcart_mode' ),
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[display_widget_slide]',
		'type'            => 'checkbox',
		'active_callback' => 'callback_is_front_page',
		'priority'        => 16,
	)
);

/* 170: 商品一覧ウィジェットのモバイルスライド機能 */
$wp_customize->add_setting(
	'mode_type_options[item_widget_slide_mobile]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_item_widget_slide_mobile',
	array(
		'label'           => __( 'Mobile only', 'welcart_mode' ),
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[item_widget_slide_mobile]',
		'type'            => 'checkbox',
		'active_callback' => 'callback_itemlist_slide_mobile',
		'priority'        => 17,
	)
);


/* 180: コーディネート記事一覧の表示 */
$wp_customize->add_setting(
	'mode_type_options[display_coordinate]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_display_coordinate',
	array(
		'label'    => __( 'Display Coordinate', 'welcart_mode' ),
		'section'  => 'front_settings',
		'settings' => 'mode_type_options[display_coordinate]',
		'type'     => 'checkbox',
		'priority' => 18,
	)
);

/* 190: コーディネート記事一覧の表示件数 */
$wp_customize->add_setting(
	'mode_type_options[coordinate_num]',
	array(
		'default'    => 5,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'coordinate_num',
	array(
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[coordinate_num]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min' => '1',
		),
		'active_callback' => 'callback_display_coordinate',
		'priority'        => 19,
		'description'     => __( 'Please select a display number.', 'welcart_mode' ),
	)
);

/* 200: 特集記事一覧のモバイルスライド機能 */
$wp_customize->add_setting(
	'mode_type_options[coordinates_slide]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_coordinates_slide',
	array(
		'label'    => __( 'Slide Function', 'welcart_mode' ),
		'section'  => 'front_settings',
		'settings' => 'mode_type_options[coordinates_slide]',
		'type'     => 'checkbox',
		'priority' => 20,
	)
);

/* 210: 特集記事一覧のモバイルスライド機能 */
$wp_customize->add_setting(
	'mode_type_options[coordinates_slide_mobile]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_coordinates_slide_mobile',
	array(
		'label'           => __( 'Mobile only', 'welcart_mode' ),
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[coordinates_slide_mobile]',
		'type'            => 'checkbox',
		'active_callback' => 'callback_coordinate_slider_mobile',
		'priority'        => 21,
	)
);


/* 220: コーディネート記事一覧のカラム数 */
$wp_customize->add_setting(
	'mode_type_options[coordinate_column]',
	array(
		'default'    => 5,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'coordinate_column',
	array(
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[coordinate_column]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min' => '3',
			'max' => '6',
		),
		'active_callback' => 'callback_display_coordinate',
		'priority'        => 22,
		'description'     => __( 'Please select a display column.', 'welcart_mode' ),
	)
);

/* 230: ブランド記事一覧の表示　*/
$wp_customize->add_setting(
	'mode_type_options[display_brand]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_display_brand',
	array(
		'label'    => __( 'Display Brand', 'welcart_mode' ),
		'section'  => 'front_settings',
		'settings' => 'mode_type_options[display_brand]',
		'type'     => 'checkbox',
		'priority' => 23,
	)
);

/* 240: ブランド記事一覧の表示件数　*/
$wp_customize->add_setting(
	'mode_type_options[brand_num]',
	array(
		'default'    => 10,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'brand_num',
	array(
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[brand_num]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min' => '1',
		),
		'active_callback' => 'callback_display_brand',
		'priority'        => 24,
		'description'     => __( 'Please select a display number.', 'welcart_mode' ),
	)
);

/* 250: ブランド記事一覧のカラム数　*/
$wp_customize->add_setting(
	'mode_type_options[brand_column]',
	array(
		'default'    => 5,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'brand_column',
	array(
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[brand_column]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min' => '4',
			'max' => '6',
		),
		'active_callback' => 'callback_display_brand',
		'priority'        => 25,
		'description'     => __( 'Please select a display column.', 'welcart_mode' ),
	)
);

/* 260: ブランドのロゴ周りボーダーを設定　*/
$wp_customize->add_setting(
	'mode_type_options[logo_border]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_logo_border',
	array(
		'label'           => __( 'Border around the image', 'welcart_mode' ),
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[logo_border]',
		'type'            => 'checkbox',
		'active_callback' => 'callback_display_brand',
		'priority'        => 26,
	)
);

/* 270: ブランド記事一覧のロゴ周りボーダー色を設定　*/
$wp_customize->add_setting(
	'logo_border_color',
	array(
		'default'           => '#cccccc',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'logo_border_color',
		array(
			'label'           => __( 'Border Color', 'welcart_mode' ),
			'section'         => 'front_settings',
			'active_callback' => 'callback_display_logo_border',
			'priority'        => 27,
		)
	)
);

/* 280: 投稿記事一覧の表示　*/
$wp_customize->add_setting(
	'mode_type_options[display_posts]',
	array(
		'default'    => false,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'control_display_posts',
	array(
		'label'    => __( 'Display Posts', 'welcart_mode' ),
		'section'  => 'front_settings',
		'settings' => 'mode_type_options[display_posts]',
		'type'     => 'checkbox',
		'priority' => 28,
	)
);

/* 290: 投稿記事一覧のレイアウト（リスト）　*/
$wp_customize->add_setting(
	'mode_type_options[posts_list_column]',
	array(
		'default'    => 2,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'posts_list_column',
	array(
		'section'     => 'front_settings',
		'settings'    => 'mode_type_options[posts_list_column]',
		'type'        => 'number',
		'input_attrs' => array(
			'min' => '1',
			'max' => '2',
		),
		'priority'    => 29,
		'description' => __( 'Please select a display column.', 'welcart_mode' ),
	)
);

/* 300: 投稿記事一覧のカテゴリー選択　*/
$wp_customize->add_setting(
	'mode_type_options[posts_category]',
	array(
		'default'    => mode_get_category_default(),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'posts_category',
	array(
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[posts_category]',
		'type'            => 'select',
		'choices'         => mode_get_categories(),
		'active_callback' => 'callback_display_posts',
		'priority'        => 30,
		'description'     => __( 'Please select a category to be displayed.', 'welcart_mode' ),
	)
);

/* 310: 投稿記事一覧のコンテンツ内容選択　*/
$wp_customize->add_setting(
	'mode_type_options[posts_cont]',
	array(
		'default'           => array(
			'thumbnail',
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
		'posts_cont',
		array(
			'section'         => 'front_settings',
			'settings'        => 'mode_type_options[posts_cont]',
			'type'            => 'checkbox',
			'active_callback' => 'callback_display_posts',
			'choices'         => array(
				'thumbnail' => _x( 'Featured image', 'post' ),
				'date'      => __( 'Date' ),
				'title'     => __( 'Title' ),
				'excerpt'   => __( 'Excerpt' ),
			),
			'priority'        => 31,
		)
	)
);

/* 320: 投稿記事一覧のコンテンツ内容選択　*/
$wp_customize->add_setting(
	'mode_type_options[posts_num]',
	array(
		'default'    => 3,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'posts_num',
	array(
		'section'         => 'front_settings',
		'settings'        => 'mode_type_options[posts_num]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min' => '1',
		),
		'active_callback' => 'callback_display_posts',
		'priority'        => 32,
		'description'     => __( 'Please select a display number.', 'welcart_mode' ),
	)
);
