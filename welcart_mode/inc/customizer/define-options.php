<?php
/**
 * Customizer - Define Options Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Get Options
 *
 * @param string $key Get Options.
 * @return mixed
 */
function mode_get_options( $key = '' ) {

	$option_value = null;

	if ( empty( $key ) ) {
		return $option_value;
	}

	switch ( $key ) {
		case 'item_cont':
			$option_value = array( 'item-img', 'item-name', 'item-soldout', 'item-tag' );
			break;
	}

	$options = get_option( 'mode_type_options', array() );

	if ( ! is_admin() ) {
		if ( isset( $options[ $key ] ) ) {
			switch ( $key ) {
				case 'display_newtag_text':
					if ( empty( $options[ $key ] ) ) {
						$option_value = __( 'New', 'welcart_mode' );
					} else {
						$option_value = $options[ $key ];
					}
					break;
				case 'display_hottag_text':
					if ( empty( $options[ $key ] ) ) {
						$option_value = __( 'Recommend', 'welcart_mode' );
					} else {
						$option_value = $options[ $key ];
					}
					break;
				default:
					$option_value = $options[ $key ];
			}
		} else {
			switch ( $key ) {

				/* a. Title Tagline */
				case 'display_description':
					$option_value = false;
					break;

				/* b. Nav Menus */
				case 'submenu_type_method':
					$option_value = 'mega-menu';
					break;
				case 'menu_display_method':
					$option_value = 'default-menu';
					break;

				/* c. Theme Option */
				case 'widget_cart_header':
					$option_value = false;
					break;

				/*__ front page _______________________*/

				case 'display_features':
					$option_value = false;
					break;
				case 'features_list_column':
					$option_value = 2;
					break;
				case 'features_slide':
					$option_value = false;
					break;
				case 'features_num':
					$option_value = 5;
					break;
				case 'features_cont':
					$option_value = array( 'thumbnail', 'term', 'date', 'title', 'excerpt' );
					break;

				case 'display_coordinate':
					$option_value = false;
					break;
				case 'coordinate_num':
					$option_value = 10;
					break;
				case 'coordinate_layout':
					$option_value = 'layout-slide';
					break;
				case 'coordinate_column':
					$option_value = 5;
					break;

				case 'display_brand':
					$option_value = false;
					break;
				case 'brand_num':
					$option_value = 10;
					break;
				case 'brand_column':
					$option_value = 5;
					break;
				case 'logo_border':
					$option_value = false;
					break;

				case 'display_posts':
					$option_value = false;
					break;
				case 'posts_layout':
					$option_value = 'module-list';
					break;
				case 'posts_list_column':
					$option_value = 2;
					break;
				case 'posts_category':
					$option_value = mode_get_category_default();
					break;
				case 'posts_num':
					$option_value = 3;
					break;
				case 'posts_cont':
					$option_value = array( 'thumbnail', 'date', 'title', 'excerpt' );
					break;

				/*__ sidebar _______________________*/

				case 'sidebar_layout':
					$option_value = 'position-left';
					break;
				case 'display_sidebar':
					$option_value = '';
					break;
				case 'switch_auto_play':
					$option_value = 'value1';
					break;
				case 'ch_slide_speed':
					$option_value = '3000';
					break;
				case 'ch_animation_speed':
					$option_value = '300';
					break;

				/*__ item list _______________________*/

				case 'display_sub_categories':
					$option_value = false;
					break;
				case 'item_list_column':
					$option_value = 5;
					break;
				case 'display_produt_tag':
					$option_value = true;
					break;
				case 'display_newtag_text':
					$option_value = __( 'New', 'welcart_mode' );
					break;
				case 'display_hottag_text':
					$option_value = __( 'Recommend', 'welcart_mode' );
					break;
				case 'display_saletag_text':
					$option_value = __( 'Sale', 'welcart_mode' );
					break;
				case 'subimage_hover':
					$option_value = true;
					break;
				case 'image_square':
					$option_value = false;
					break;

				/*__ item single _______________________*/

				case 'content_position':
					$option_value = 'initial';
					break;
				case 'item_page_title':
					$option_value = false;
					break;
				case 'cart_button':
					$option_value = __( 'Add to Shopping Cart', 'usces' );
					break;
				case 'soldout_text':
					$option_value = __( 'At present we cannot deal with this product', 'welcart_mode' );
					break;
				case 'display_inquiry':
					$option_value = false;
					break;
				case 'inquiry_position':
					$option_value = 'initial';
					break;
				case 'inquiry_link':
					$option_value = 0;
					break;
				case 'inquiry_text':
					$option_value = __( 'Inquiries about this product', 'welcart_mode' );
					break;
				case 'display_item_single':
					$option_value = array( 'itemcode', 'status', 'review', 'brand' );
					break;

				/*__ cart Page _______________________*/

				case 'continue_shopping_button':
					$option_value = false;
					break;
				case 'continue_shopping_url':
					$option_value = '';
					break;
				case 'archives_cont':
					$option_value = array( 'thumbnail', 'date', 'title', 'excerpt' );
					break;

				/*__ single(post) _______________________*/

				case 'display_post_thumbnail':
					$option_value = 'display';
					break;

				/*__ arhives(post) _______________________*/

				case 'arhives_list_column':
					$option_value = 2;
					break;
				case 'arhives_cont':
					$option_value = array( 'thumbnail', 'date', 'title', 'excerpt' );
					break;

				/*__ arhives(features) _______________________*/

				case 'features_index_layout':
					$option_value = 'default-layout';
					break;
				case 'archive_features_num':
					$option_value = 3;
					break;
				case 'archive_features_cont':
					$option_value = array( 'thumbnail', 'term', 'date', 'title', 'excerpt' );
					break;

				/*__ coordinate _______________________*/

				case 'display_coordinate_title':
					$option_value = 'show';
					break;
				case 'display_model_info':
					$option_value = 'show';
					break;
				case 'coordinates_headline':
					$option_value = __( 'Coordinate', 'welcart_mode' );
					break;
				case 'coordinates_headline_eng':
					$option_value = 'COORDINATE';
					break;
				case 'coordinate_list_cont':
					$option_value = array( 'date', 'title' );
					break;
				case 'display_model_items':
					$option_value = array( 'thumbnail', 'name', 'sex', 'height' );
					break;
				case 'display_coordinate_subtitle':
					$option_value = __( 'Styling Item', 'welcart_mode' );
					break;

				case 'display_post_model_info':
					$option_value = 'show';
					break;
				case 'display_post_model_items':
					$option_value = array( 'thumbnail', 'name', 'sex', 'height' );
					break;
				case 'display_model_coordinates':
					$option_value = 'show';
					break;
				case 'display_coordinate_tags':
					$option_value = 'show';
					break;

				/*__ sns _______________________*/

				case 'facebook_id':
					$option_value = '';
					break;
				case 'facebook_button':
					$option_value = false;
					break;

				case 'twitter_id':
					$option_value = '';
					break;
				case 'twitter_button':
					$option_value = false;
					break;

				case 'instagram_id':
					$option_value = '';
					break;
				case 'instagram_button':
					$option_value = false;
					break;

				case 'youtube_id':
					$option_value = '';
					break;
				case 'youtube_button':
					$option_value = false;
					break;

				case 'line_id':
					$option_value = '';
					break;
				case 'line_button':
					$option_value = false;
					break;
			}
		}
	}

	return $option_value;
}

/**
 * Options
 *
 * @param string $key Options.
 * @return void
 */
function mode_options( $key = '' ) {

	echo esc_html( mode_get_options( $key ) );

}
