<?php
/**
 * Customizer Panels Settings - Cart Page
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* カートページ　*/
$wp_customize->add_section(
	'cart_settings',
	array(
		'title'    => __( 'Cart page', 'usces' ),
		'priority' => 50,
		'panel'    => 'general_settings',
	)
);

/**
 * カートページ セッティング
 * ------------------------------------------------------ */

/* 110: 買い物を続けるボタン表示 */
$wp_customize->add_setting(
	'mode_type_options[continue_shopping_button]',
	array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'control_continue_shopping_button',
	array(
		'label'    => __( 'Change the link destination of the Continue shopping button', 'welcart_mode' ),
		'section'  => 'cart_settings',
		'settings' => 'mode_type_options[continue_shopping_button]',
		'type'     => 'checkbox',
		'priority' => 51,
	)
);

$wp_customize->add_setting(
	'mode_type_options[continue_shopping_url]',
	array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	)
);
$wp_customize->add_control(
	'control_continue_shopping_url',
	array(
		'section'     => 'cart_settings',
		'settings'    => 'mode_type_options[continue_shopping_url]',
		'type'        => 'url',
		'priority'    => 52,
		'description' => __( 'Destination URL', 'welcart_mode' ),
	)
);
