<?php
/**
 * Customizer - Custom Shortcuts Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Customize Shortcuts
 *
 * @param array $wp_customize Customize Shortcuts.
 * @return void
 */
function welcart_mode_customize_shortycuts( $wp_customize ) {

	$wp_customize->get_setting( 'header_image' )->transport                            = 'postMessage';
	$wp_customize->get_setting( 'mode_type_options[display_features]' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'mode_type_options[display_widget_slide]' )->transport = 'postMessage';
	$wp_customize->get_setting( 'mode_type_options[display_coordinate]' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'mode_type_options[display_brand]' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'mode_type_options[display_posts]' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'mode_type_options[facebook_id]' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'mode_type_options[menu_display_method]' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial(
			'header_image',
			array(
				'selector' => '.home-slide-container',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'mode_type_options[display_features]',
			array(
				'selector' => '.section-home.features .column1120',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'mode_type_options[display_widget_slide]',
			array(
				'selector' => '.section-home.widget.widget_mode_item_list .column1120 .entryhead',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'mode_type_options[display_coordinate]',
			array(
				'selector' => '.section-home.cordinates .column1120',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'mode_type_options[display_brand]',
			array(
				'selector' => '.section-home.brand .column1120',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'mode_type_options[display_posts]',
			array(
				'selector' => '.section-home.posts .column1120',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'mode_type_options[facebook_id]',
			array(
				'selector' => '.shop-sns',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'mode_type_options[menu_display_method]',
			array(
				'selector' => '.header_inner',
			)
		);

	}
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Customize Shortcuts Adds Styles
	 *
	 * @return void
	 */
	function customize_shortycuts_style_add() { ?>
	<style type="text/css">
		/* ---- for shortycuts ---- */

		.site-logo .customize-partial-edit-shortcut-button {
			left: -10px;
		}
		.home-slide-container .customize-partial-edit-shortcut-button {
			top: 12px;
			left: 10px;
		}
		.section-home.features .customize-partial-edit-shortcut-button,
		.section-home.cordinates .customize-partial-edit-shortcut-button,
		.section-home.brand .customize-partial-edit-shortcut-button,
		.section-home.posts .customize-partial-edit-shortcut-button,
		.section-home.widget.widget_mode_item_list .customize-partial-edit-shortcut-button {
			left: 10px;
		}
		.shop-sns > span {
			top: inherit;
			left: inherit;
			font-size: inherit;
			-webkit-transform: inherit;
			transform: inherit;
		}
		.shop-sns > span .customize-partial-edit-shortcut-button {
			top: -30px;
			left: -15px;
		}
		.footer-navigation .customize-partial-edit-shortcut-button {
			left: 0;
		}
		.header_inner > .customize-partial-edit-shortcut {
			top: 10px;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}
		.site-logo .customize-partial-edit-shortcut-button {
			left: -10px;
		}

	</style>
		<?php
	}
	add_action( 'wp_head', 'customize_shortycuts_style_add' );

}
add_action( 'customize_register', 'welcart_mode_customize_shortycuts' );
