<?php
/**
 * Customizer Panels - Nav Menus Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Register Menu
 *
 * @param array $wp_customize Register Menu.
 * @return void
 */
function welcart_mode_customize_register_menu( $wp_customize ) {

	/**
	 * カスタマイズ ＞ 「メニュー」
	 * 「メニュー」内に「グローベルナビゲーション」を定義
	 */
	$wp_customize->add_section(
		'global_menu_custom',
		array(
			'title'    => __( 'Global Navigation', 'welcart_mode' ),
			'panel'    => 'nav_menus',
			'priority' => 100,
		)
	);

	/*
	 * setup menu_display_method.
	 * PC サブメニューの表示形式の選択
	 */
	$wp_customize->add_setting(
		'mode_type_options[menu_display_method]',
		array(
			'default'    => 'default-menu',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'control_menu_display_method',
		array(
			'label'    => __( 'Please select a display type.', 'welcart_mode' ),
			'section'  => 'global_menu_custom',
			'settings' => 'mode_type_options[menu_display_method]',
			'type'     => 'radio',
			'choices'  => array(
				'default-menu' => __( 'Type A', 'welcart_mode' ),
				'tab-menu'     => __( 'Type B', 'welcart_mode' ),
			),
			'priority' => 9999,
		)
	);

}
add_action( 'customize_register', 'welcart_mode_customize_register_menu' );
