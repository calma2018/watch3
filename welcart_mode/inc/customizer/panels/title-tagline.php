<?php
/**
 * Customizer Panels - Title Tagline Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Register Information
 *
 * @param array $wp_customize Register Information.
 * @return void
 */
function welcart_mode_customize_register_info( $wp_customize ) {

	$wp_customize->add_setting(
		'mode_type_options[display_description]',
		array(
			'default'           => false,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'control_display_description',
		array(
			'label'    => __( 'Display the Catchphrase', 'welcart_mode' ),
			'section'  => 'title_tagline',
			'settings' => 'mode_type_options[display_description]',
			'type'     => 'checkbox',
			'priority' => 10,
		)
	);

	/* Fixed Header */
	$wp_customize->add_setting(
		'mode_type_options[fixed_header]',
		array(
			'default'           => false,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'control_fixed_header',
		array(
			'label'    => __( 'Adding Fixed Header', 'welcart_mode' ),
			'section'  => 'title_tagline',
			'settings' => 'mode_type_options[fixed_header]',
			'type'     => 'checkbox',
			'priority' => 11,
		)
	);

	/* Widget Cart for Header */
	$wp_customize->add_setting(
		'mode_type_options[widget_cart_header]',
		array(
			'default'           => false,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'welcart_mode_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'widget_cart_header',
		array(
			'label'           => __( 'Enable Display', 'welcart_mode' ),
			'section'         => 'title_tagline',
			'settings'        => 'mode_type_options[widget_cart_header]',
			'type'            => 'checkbox',
			'priority'        => 12,
			'active_callback' => 'callback_widget_cart_on',
		)
	);

}
add_action( 'customize_register', 'welcart_mode_customize_register_info' );
