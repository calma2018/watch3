<?php
/**
 * Customizer Panels - Theme Option Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Register General
 *
 * @param array $wp_customize Register General.
 * @return void
 */
function welcart_mode_customize_register_general( $wp_customize ) {

	/* panel (theme option) */
	$wp_customize->add_panel(
		'general_settings',
		array(
			'priority'   => 60,
			'capability' => 'edit_theme_options',
			'title'      => __( 'Theme Option', 'welcart_mode' ),
		)
	);

	/**
	 * Requiring customizer setting & control
	*/
	$welcart_mode_sections = array(
		'front-page',
		'item-list',
		'item-single',
		'sidebar',
		'archives',
		'post-single',
		'sns',
		'coordinate-list',
		'features-list',
		'coordinate-single',
		'cart-page',
	);
	foreach ( $welcart_mode_sections as $panels ) {
		require get_template_directory() . '/inc/customizer/panels/settings/' . $panels . '.php';
	}

}
add_action( 'customize_register', 'welcart_mode_customize_register_general' );
