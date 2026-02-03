<?php
/**
 * Customizer Panels - Custom Headeer Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Custom Header
 *
 * @param array $wp_customize Custom Header.
 * @return void
 */
function welcart_mode_customize_custom_header( $wp_customize ) {

	/* Switching Fade or Slide */
	$wp_customize->add_setting(
		'mode_type_options[switch_fade_slide]',
		array(
			'default'    => 'value1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'control_switch_fade_slide',
		array(
			'label'    => __( 'Switching Fade or Slide for Header image', 'welcart_mode' ),
			'section'  => 'header_image',
			'settings' => 'mode_type_options[switch_fade_slide]',
			'type'     => 'radio',
			'priority' => 10,
			'choices'  => array(
				'value1' => __( 'Slide', 'welcart_mode' ),
				'value2' => __( 'Fade', 'welcart_mode' ),
			),
		)
	);

	/* Decide a Slider Quantity */
	$wp_customize->add_setting(
		'mode_type_options[ch_show_slide_number]',
		array(
			'default'    => '1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'ch_show_slide_number',
		array(
			'section'         => 'header_image',
			'settings'        => 'mode_type_options[ch_show_slide_number]',
			'type'            => 'number',
			'input_attrs'     => array(
				'min' => '1',
				'max' => '4',
			),
			'active_callback' => 'callback_display_slide_chose',
			'priority'        => 11,
			'description'     => __( 'Please select a display column.', 'welcart_mode' ),
		)
	);

	/* Switching The Auto Play */
	$wp_customize->add_setting(
		'mode_type_options[switch_auto_play]',
		array(
			'default'    => 'value1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'control_switch_auto_play',
		array(
			'label'    => __( 'Switching The Auto Play for The Slider', 'welcart_mode' ),
			'section'  => 'header_image',
			'settings' => 'mode_type_options[switch_auto_play]',
			'type'     => 'radio',
			'priority' => 12,
			'choices'  => array(
				'value1' => __( 'Activate', 'welcart_mode' ),
				'value2' => __( 'Deactivate', 'welcart_mode' ),
			),
		)
	);

	/* Decide Speed for Slide */
	$wp_customize->add_setting(
		'mode_type_options[ch_slide_speed]',
		array(
			'default'    => '3000',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'ch_slide_speed',
		array(
			'section'         => 'header_image',
			'settings'        => 'mode_type_options[ch_slide_speed]',
			'type'            => 'number',
			'input_attrs'     => array( 'step' => '1000' ),
			'priority'        => 13,
			'description'     => __( 'Autoplay speed (in seconds)', 'welcart_mode' ),
			'active_callback' => 'callback_autopaly_slide',
		)
	);

	/* Decide Speed for Fade */
	$wp_customize->add_setting(
		'mode_type_options[ch_animation_speed]',
		array(
			'default'    => '300',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'ch_animation_speed',
		array(
			'section'     => 'header_image',
			'settings'    => 'mode_type_options[ch_animation_speed]',
			'type'        => 'number',
			'input_attrs' => array( 'step' => '100' ),
			'priority'    => 14,
			'description' => __( 'Slide and Fade animation speed', 'welcart_mode' ),
		)
	);

}
add_action( 'customize_register', 'welcart_mode_customize_custom_header' );
