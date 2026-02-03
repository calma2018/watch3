<?php
/**
 * Customizer Panels - Colors Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Register Colors
 *
 * @param array $wp_customize Register Colors.
 * @return void
 */
function welcart_mode_customize_register_color( $wp_customize ) {

	/**
	 * Primary
	 */

	/* Background Color */
	$wp_customize->add_setting(
		'primary_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 1,
			)
		)
	);

	/* Text Color */
	$wp_customize->add_setting(
		'primary_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 2,
			)
		)
	);

	/* Link Color */
	$wp_customize->add_setting(
		'primary_link_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_link_color',
			array(
				'label'    => __( 'Link Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 3,
			)
		)
	);

	/* Border Color */
	$wp_customize->add_setting(
		'primary_border_color',
		array(
			'default'           => '#e8e8e8',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_border_color',
			array(
				'label'    => __( 'Border Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 4,
			)
		)
	);

	/* Table Color */
	$wp_customize->add_setting(
		'primary_th_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_th_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting(
		'primary_th_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_th_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 6,
			)
		)
	);

	$wp_customize->add_setting(
		'primary_table_border_color',
		array(
			'default'           => '#e8e8e8',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_table_border_color',
			array(
				'label'    => __( 'Border Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 7,
			)
		)
	);

	/* Button Color */
	$wp_customize->add_setting(
		'primary_button_bg_color',
		array(
			'default'           => '#777777',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_button_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 8,
			)
		)
	);
	$wp_customize->add_setting(
		'primary_button_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_button_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 9,
			)
		)
	);
	$wp_customize->add_setting(
		'primary_sub_button1_bg_color',
		array(
			'default'           => '#777777',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_sub_button1_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 10,
			)
		)
	);
	$wp_customize->add_setting(
		'primary_sub_button1_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_sub_button1_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 11,
			)
		)
	);
	$wp_customize->add_setting(
		'primary_sub_button2_bg_color',
		array(
			'default'           => '#eeeeee',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_sub_button2_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 11,
			)
		)
	);
	$wp_customize->add_setting(
		'primary_sub_button2_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_sub_button2_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 12,
			)
		)
	);

	/**
	 * Header
	 */

	$wp_customize->add_setting(
		'header_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 20,
			)
		)
	);
	$wp_customize->add_setting(
		'header_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 21,
			)
		)
	);
	$wp_customize->add_setting(
		'header_border_color',
		array(
			'default'           => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_border_color',
			array(
				'label'    => __( 'Border Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 22,
			)
		)
	);
	$wp_customize->add_setting(
		'header_sub_bg_color',
		array(
			'default'           => '#f3f3f3',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_sub_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 23,
			)
		)
	);
	$wp_customize->add_setting(
		'header_sub_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_sub_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 24,
			)
		)
	);
	$wp_customize->add_setting(
		'header_button_border_color',
		array(
			'default'           => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_button_border_color',
			array(
				'label'    => __( 'Border Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 25,
			)
		)
	);
	$wp_customize->add_setting(
		'cart_quantity_background_color',
		array(
			'default'           => '#9ea640',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cart_quantity_background_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 26,
			)
		)
	);

	/**
	 * Footer
	 */

	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'default'           => '#f4f4f4',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 30,
			)
		)
	);
	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 31,
			)
		)
	);
	$wp_customize->add_setting(
		'footer_border_color',
		array(
			'default'           => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_border_color',
			array(
				'label'    => __( 'Border Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 32,
			)
		)
	);
	$wp_customize->add_setting(
		'footer_icon_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_icon_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 33,
			)
		)
	);
	$wp_customize->add_setting(
		'footer_icon_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_icon_color',
			array(
				'label'    => __( 'Icon Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 34,
			)
		)
	);
	$wp_customize->add_setting(
		'copyright_bg_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 35,
			)
		)
	);
	$wp_customize->add_setting(
		'copyright_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 36,
			)
		)
	);

	/**
	 * Item
	 */

	$wp_customize->add_setting(
		'price_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'price_color',
			array(
				'label'    => __( 'Price Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 40,
			)
		)
	);
	$wp_customize->add_setting(
		'soldout_color',
		array(
			'default'           => '#dd0000',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'soldout_color',
			array(
				'label'    => __( 'Sold out', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 41,
			)
		)
	);
	$wp_customize->add_setting(
		'cart_button_bg_color',
		array(
			'default'           => '#777777',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cart_button_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 42,
			)
		)
	);
	$wp_customize->add_setting(
		'cart_button_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cart_button_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 43,
			)
		)
	);

	/* ---- 商品タグ ---- */

	$wp_customize->add_setting(
		'opt_new_color',
		array(
			'default'           => '#b5cc18',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'opt_new_color',
			array(
				'label'    => __( 'New Item Tag', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 44,
			)
		)
	);
	$wp_customize->add_setting(
		'opt_reco_color',
		array(
			'default'           => '#21ba45',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'opt_reco_color',
			array(
				'label'    => __( 'Recommend Item Tag', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 45,
			)
		)
	);
	$wp_customize->add_setting(
		'opt_stock_color',
		array(
			'default'           => '#00b5ad',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'opt_stock_color',
			array(
				'label'    => __( 'Few Stock Tag', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 46,
			)
		)
	);
	$wp_customize->add_setting(
		'opt_sale_color',
		array(
			'default'           => '#e03997',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'opt_sale_color',
			array(
				'label'    => __( 'Sale Tag', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 47,
			)
		)
	);

	/* ---- ここから商品詳細ページ ---- */
	$wp_customize->add_setting(
		'tabs_bg_color',
		array(
			'default'           => '#eeeeee',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'tabs_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 48,
			)
		)
	);
	$wp_customize->add_setting(
		'tabs_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'tabs_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 49,
			)
		)
	);
	$wp_customize->add_setting(
		'tabs_border_color',
		array(
			'default'           => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'tabs_border_color',
			array(
				'label'    => __( 'Border Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 50,
			)
		)
	);
	$wp_customize->add_setting(
		'tabs_current_bg_color',
		array(
			'default'           => '#9c9c9c',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'tabs_current_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 51,
			)
		)
	);
	$wp_customize->add_setting(
		'tabs_current_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'tabs_current_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 52,
			)
		)
	);

	/**
	 * Other
	 */

	$wp_customize->add_setting(
		'calendar_holiday_bg_color',
		array(
			'default'           => '#eeeeee',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'calendar_holiday_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 60,
			)
		)
	);
	$wp_customize->add_setting(
		'calendar_holiday_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'calendar_holiday_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 61,
			)
		)
	);

	/* レビュー・ログイン・マイページ・ */
	$wp_customize->add_setting(
		'entry_bg_color',
		array(
			'default'           => '#f2f2f2',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_bg_color',
			array(
				'label'    => __( 'Background Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 62,
			)
		)
	);
	$wp_customize->add_setting(
		'entry_text_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_text_color',
			array(
				'label'    => __( 'Text Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 63,
			)
		)
	);
	$wp_customize->add_setting(
		'entry_border_color',
		array(
			'default'           => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_border_color',
			array(
				'label'    => __( 'Border Color', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 64,
			)
		)
	);
	$wp_customize->add_setting(
		'error_message',
		array(
			'default'           => '#dd0000',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'error_message',
			array(
				'label'    => __( 'Error Message', 'welcart_mode' ),
				'section'  => 'colors',
				'priority' => 65,
			)
		)
	);

}
add_action( 'customize_register', 'welcart_mode_customize_register_color' );
