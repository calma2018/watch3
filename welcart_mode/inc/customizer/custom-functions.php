<?php
/**
 * Customizer - Custom Functions Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Sanitization Functions
 */

/**
 * Sanitize Checkbox
 *
 * @param string $checked Sanitize Checkbox.
 * @return string
 */
function welcart_mode_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize Select
 *
 * @param string $value Sanitize Select.
 * @return string
 */
function welcart_mode_sanitize_select( $value ) {
	if ( is_array( $value ) ) {
		foreach ( $value as $key => $subvalue ) {
			$value[ $key ] = esc_attr( $subvalue );
		}
		return $value;
	}
	return esc_attr( $value );
}

/**
 * Sanitize Number Absint
 *
 * @param string $number Sanitize Number Absint.
 * @param string $setting Sanitize Number Absint.
 * @return string
 */
function welcart_mode_sanitize_number_absint( $number, $setting ) {
	$number = absint( $number );
	return ( $number ? $number : $setting->default );
}

/**
 * Sanitize Multiple Checkbox
 *
 * @param string $values Sanitize Multiple Checkbox.
 * @return string
 */
function sanitize_multiple_checkbox( $values ) {

	$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
	return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();

}

/**
 * Callback Functions
 */

/**
 * Callback IS Front Page
 *
 * @return string
 */
function callback_is_front_page() {
	return 'posts' === get_option( 'show_on_front' ) && ( is_home() || is_front_page() );
}

/**
 * Callback Display Slide Chose
 *
 * @param string $control Callback Display Slide Chose.
 * @return bool
 */
function callback_display_slide_chose( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( 'value1' === $control->manager->get_setting( 'mode_type_options[switch_fade_slide]' )->value() ) {
		return true;
	}
}

/**
 * Callback Header Slider
 *
 * @param string $control Callback Header Slider.
 * @return bool
 */
function callback_header_slider( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[ch_show_slide_number]' )->value() >= 2 || 'value2' === $control->manager->get_setting( 'mode_type_options[switch_fade_slide]' )->value() ) {
		return true;
	}
}

/**
 * Callback Autoplay Slide
 *
 * @param string $control Callback Autoplay Slide.
 * @return bool
 */
function callback_autopaly_slide( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( 'value1' === $control->manager->get_setting( 'mode_type_options[switch_auto_play]' )->value() ) {
		return true;
	}
}

/**
 * Callback Display Features
 *
 * @param string $control Callback Display Features.
 * @return bool
 */
function callback_display_features( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_features]' )->value() ) {
		return true;
	}
}

/**
 * Callback Features List
 *
 * @param string $control Callback Features List.
 * @return bool
 */
function callback_features_list( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_features]' )->value() && 'module-list' === $control->manager->get_setting( 'mode_type_options[display_features]' )->value() ) {
		return true;
	}
}

/**
 * Callback Features Grid
 *
 * @param string $control Callback Features Grid.
 * @return bool
 */
function callback_features_grid( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_features]' )->value() && 'module-grid' === $control->manager->get_setting( 'mode_type_options[features_layout]' )->value() ) {
		return true;
	}
}

/**
 * Callback Features Slide Mobile
 *
 * @param string $control Callback Features Slide Mobile.
 * @return bool
 */
function callback_features_slide_mobile( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[features_slide]' )->value() ) {
		return true;
	}
}

/**
 * Callback Display Section Layout
 *
 * @param string $control Callback Display Section Layout.
 * @return bool
 */
function callback_display_section_layout( $control ) {
	if ( ! ( 'features' === get_post_type() ) ) {
		return false;
	}

	if ( 'section-layout' === $control->manager->get_setting( 'mode_type_options[features_index_layout]' )->value() ) {
		return true;
	}
}

/**
 * Item List
 */

/**
 * Callback Item List Slide Mobile
 *
 * @param string $control Callback Item List Slide Mobile.
 * @return bool
 */
function callback_itemlist_slide_mobile( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_widget_slide]' )->value() ) {
		return true;
	}
}

/**
 * Callback Display Coordinate
 *
 * @param string $control Callback Display Coordinate.
 * @return bool
 */
function callback_display_coordinate( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_coordinate]' )->value() ) {
		return true;
	}
}

/**
 * Callback Coordinate Slider Mobile
 *
 * @param string $control Callback Coordinate Slider Mobile.
 * @return bool
 */
function callback_coordinate_slider_mobile( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[coordinates_slide]' )->value() ) {
		return true;
	}
}

/**
 * Callback Model Information Items
 *
 * @param string $control Callback Model Information Items.
 * @return bool
 */
function callback_model_info_items( $control ) {
	if ( ! ( 'coordinates' === get_post_type() ) ) {
		return false;
	}

	if ( 'show' === $control->manager->get_setting( 'mode_type_options[display_model_info]' )->value() ) {
		return true;
	}
}

/**
 * Callback Post Model Info Items
 *
 * @param string $control Callback Post Model Info Items.
 * @return bool
 */
function callback_post_model_info_items( $control ) {
	if ( ! ( is_single() && 'coordinates' === get_post_type() ) ) {
		return false;
	}

	if ( 'show' === $control->manager->get_setting( 'mode_type_options[display_post_model_info]' )->value() ) {
		return true;
	}
}

/**
 * Callback Display Brand
 *
 * @param string $control Callback Display Brand.
 * @return bool
 */
function callback_display_brand( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_brand]' )->value() ) {
		return true;
	}
}

/**
 * Callback Display Logo Border
 *
 * @param string $control Callback Display Logo Border.
 * @return bool
 */
function callback_display_logo_border( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[logo_border]' )->value() ) {
		return true;
	}
}

/**
 * Callback Display Posts
 *
 * @param string $control Callback Display Posts.
 * @return bool
 */
function callback_display_posts( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_posts]' )->value() ) {
		return true;
	}
}

/**
 * Callback Posts List
 *
 * @param string $control Callback Posts List.
 * @return bool
 */
function callback_posts_list( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

}

/**
 * Callback Posts Grid
 *
 * @param string $control Callback Posts Grid.
 * @return bool
 */
function callback_posts_grid( $control ) {
	if ( ! is_front_page() && ! is_home() ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[display_posts]' )->value() && 'module-grid' === $control->manager->get_setting( 'mode_type_options[posts_layout]' )->value() ) {
		return true;
	}
}

/**
 * Callback Is Item Single
 *
 * @return bool
 */
function callback_is_itemsingle() {

	return is_single() && usces_is_item();

}

/**
 * Callback Content Position
 *
 * @param string $control Callback Content Position.
 * @return bool
 */
function callback_content_position( $control ) {

	return is_single() && usces_is_item() && $control->manager->get_setting( 'mode_type_options[content_position]' )->value() === 'lp';

}

/**
 * Callback Display Inquiry
 *
 * @param string $control Callback Display Inquiry.
 * @return bool
 */
function callback_display_inquiry( $control ) {

	return is_single() && usces_is_item() && $control->manager->get_setting( 'mode_type_options[display_inquiry]' )->value();

}

/**
 * Callback Widget Cart On
 *
 * @param string $control Callback Widget Cart On.
 * @return bool
 */
function callback_widget_cart_on( $control ) {
	if ( ! defined( 'WCEX_WIDGET_CART' ) ) {
		return false;
	}

	if ( $control->manager->get_setting( 'mode_type_options[widget_cart_header]' )->value() ) {
		return true;
	}
}

/**
 * Get Categories
 *
 * @return string
 */
function mode_get_categories() {
	$target_arg        = array(
		'exclude_tree' => usces_get_cat_id( 'item' ),
	);
	$target_categories = get_terms( 'category', $target_arg );
	$select_categories = array();

	foreach ( $target_categories as $target_cat ) {
		$select_categories[ $target_cat->slug ] = $target_cat->name;
	}
	return $select_categories;
}

/**
 * Get Category Default
 *
 * @return string
 */
function mode_get_category_default() {
	$select_categories = mode_get_categories();
	reset( $select_categories );
	return key( $select_categories );
}

