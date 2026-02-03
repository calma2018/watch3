<?php
/**
 * Customizer Panels Settings - SNS
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */
/* SNS設定 */
$wp_customize->add_section(
	'sns_settings',
	array(
		'title'    => __( 'SNS Setting', 'welcart_mode' ),
		'priority' => 100,
		'panel'    => 'general_settings',
	)
);

/**
 * SNS設定 セッティング
 * ------------------------------------------------------ */
/* 110 facebook ユーザーID */
$wp_customize->add_setting(
	'mode_type_options[facebook_id]',
	array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_facebook_id',
	array(
		'label'       => __( 'Display facebook', 'welcart_mode' ),
		'section'     => 'sns_settings',
		'settings'    => 'mode_type_options[facebook_id]',
		'type'        => 'text',
		'priority'    => 101,
		'description' => __( 'Enter the your page name.', 'welcart_mode' ),
	)
);

/* 111 facebook ボタン表示 */
$wp_customize->add_setting(
	'mode_type_options[facebook_button]',
	array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'control_facebook_button',
	array(
		'label'    => __( 'Show facebook', 'welcart_mode' ),
		'section'  => 'sns_settings',
		'settings' => 'mode_type_options[facebook_button]',
		'type'     => 'checkbox',
		'priority' => 102,
	)
);

/* 120 Twitter ユーザーID */
$wp_customize->add_setting(
	'mode_type_options[twitter_id]',
	array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_twitter_id',
	array(
		'label'       => __( 'Display X', 'welcart_mode' ),
		'section'     => 'sns_settings',
		'settings'    => 'mode_type_options[twitter_id]',
		'type'        => 'text',
		'priority'    => 103,
		'description' => __( 'Enter your user name.', 'welcart_mode' ),
	)
);

/* 121 Twitter ボタン表示 */
$wp_customize->add_setting(
	'mode_type_options[twitter_button]',
	array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'control_twitter_button',
	array(
		'label'    => __( 'Show X', 'welcart_mode' ),
		'section'  => 'sns_settings',
		'settings' => 'mode_type_options[twitter_button]',
		'type'     => 'checkbox',
		'priority' => 104,
	)
);

/* 130 Instagram ユーザーID */
$wp_customize->add_setting(
	'mode_type_options[instagram_id]',
	array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_instagram_id',
	array(
		'label'       => __( 'Display instagram', 'welcart_mode' ),
		'section'     => 'sns_settings',
		'settings'    => 'mode_type_options[instagram_id]',
		'type'        => 'text',
		'priority'    => 105,
		'description' => __( 'Enter your user name.', 'welcart_mode' ),
	)
);

/* 131 Instagram ボタン表示 */
$wp_customize->add_setting(
	'mode_type_options[instagram_button]',
	array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'control_instagram_button',
	array(
		'label'    => __( 'Show instagram', 'welcart_mode' ),
		'section'  => 'sns_settings',
		'settings' => 'mode_type_options[instagram_button]',
		'type'     => 'checkbox',
		'priority' => 106,
	)
);

/* 140 Youtube ユーザーID */
$wp_customize->add_setting(
	'mode_type_options[youtube_id]',
	array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_youtube_id',
	array(
		'label'       => __( 'Display youtube', 'welcart_mode' ),
		'section'     => 'sns_settings',
		'settings'    => 'mode_type_options[youtube_id]',
		'type'        => 'text',
		'priority'    => 107,
		'description' => __( 'Enter your directory name.', 'welcart_mode' ),
	)
);

/* 141 Youtube ボタン表示 */
$wp_customize->add_setting(
	'mode_type_options[youtube_button]',
	array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'control_youtube_button',
	array(
		'label'    => __( 'Show youtube', 'welcart_mode' ),
		'section'  => 'sns_settings',
		'settings' => 'mode_type_options[youtube_button]',
		'type'     => 'checkbox',
		'priority' => 108,
	)
);

/* 150 LINE QRコードURL */
$wp_customize->add_setting(
	'mode_type_options[line_id]',
	array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'control_line_id',
	array(
		'label'       => __( 'Display LINE@ share button', 'welcart_mode' ),
		'section'     => 'sns_settings',
		'settings'    => 'mode_type_options[line_id]',
		'type'        => 'text',
		'priority'    => 109,
		'description' => __( 'Enter your site URL.', 'welcart_mode' ),
	)
);

/* 151 LINE ボタン表示 */
$wp_customize->add_setting(
	'mode_type_options[line_button]',
	array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'control_line_button',
	array(
		'label'    => __( 'Show LINE@', 'welcart_mode' ),
		'section'  => 'sns_settings',
		'settings' => 'mode_type_options[line_button]',
		'type'     => 'checkbox',
		'priority' => 110,
	)
);
