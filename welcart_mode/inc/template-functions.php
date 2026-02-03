<?php
/**
 * Template Functions
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/* Header */

/**
 * Site Description
 *
 * @return object
 */
function welcart_mode_site_description() {
	global $post;

	$html = '';

	if ( mode_get_options( 'display_description' ) ) {

		if ( empty( get_bloginfo( 'description' ) ) ) {
			return;
		}

		$html .= '<p class="site-description">' . get_bloginfo( 'description' ) . '</p>' . "\n";

	}

	echo wp_kses_post( $html );

}

/**
 * Title Logo
 *
 * @return void
 */
function welcart_mode_title_logo() {
	global $post;

	$html = '';

	if ( is_home() || is_front_page() ) :
		$tag = 'h1';
	else :
		$tag = 'div';
	endif;

	$html .= '<' . $tag . ' class="';

	if ( has_custom_logo() ) {
		$html .= 'site-logo">' . get_custom_logo();
	} else {
		$html .= 'site-title"><a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>';
	}

	$html .= '</' . $tag . '>' . "\n";

	echo wp_kses_post( $html );

}

/**
 * Header Search Form
 *
 * @return void
 */
function welcart_mode_header_search_form() {
	global $post;

	$form = '<form role="search" method="get" action="' . home_url( '/' ) . '" >
				<div class="search-box">
					<input type="text" value="' . get_search_query() . '" name="s" id="header-search-text" class="search-text" />
					<input type="submit" id="header-search-submit" class="searchsubmit" value="&#xe905" />
				</div>
			</form>';

	echo $form;

}

/**
 * Member Form
 *
 * @return void
 */
function welcart_mode_member_form() {
	global $usces;

	$html  = '';
	$html .= '<div class="membership">' . "\n";
	$html .= '<ul>' . "\n";
	if ( usces_is_login() ) {
		/* translators: */
		$html .= '<li>' . sprintf( __( 'Hello %s', 'usces' ), usces_the_member_name( 'return' ) ) . '</li>' . "\n";
		$html .= '<li><a href="' . USCES_MEMBER_URL . '">' . __( 'My page', 'welcart_mode' ) . '</a></li>' . "\n";
		$html .= '<li>' . usces_loginout( 'return' ) . '</li>' . "\n";
	} else {
		$html .= '<li>' . __( 'guest', 'usces' ) . '</li>' . "\n";
		$html .= '<li>' . usces_loginout( 'return' ) . '</li>' . "\n";
		$html .= '<li><a href="' . USCES_NEWMEMBER_URL . '">' . __( 'New Membership Registration', 'usces' ) . '</a></li>' . "\n";
	}
	$html .= '</ul>' . "\n";
	$html .= '</div>' . "\n";

	echo wp_kses_post( $html );

}

/**
 * Global Navigation
 *
 * @return void
 */
function welcart_mode_global_navigation() {
	global $post;

	$global_menu = 'global-menu';

	if ( 'default-menu' === mode_get_options( 'menu_display_method' ) ) {

		echo '<nav id="global-navigation" class="global-navigation type-mega">';
		$type = 'default-menu';
		$args = array(
			'theme_location' => $global_menu,
			'menu_class'     => $type,
		);
		wp_nav_menu( $args );
		echo '</nav>';

	} else {

		$type      = 'tab-menu';
		$locations = get_nav_menu_locations();
		if ( isset( $locations[ $global_menu ] ) ) {

			$menu_list  = '';
			$menu       = wp_get_nav_menu_object( $locations[ $global_menu ] );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
			$menu_list .= '<ul id="menu-' . $global_menu . '" class="drawer-tabs">';

			foreach ( (array) $menu_items as $key => $menu_item ) {
				if ( 0 === (int) $menu_item->menu_item_parent ) {
					$tab_item_id  = $menu_item->ID;
					$tab_item_url = $menu_item->url;
					$tab_title    = $menu_item->title;
					$menu_list   .= '<li id="tab-item-' . $tab_item_id . '"><a href="' . $tab_item_url . '">' . $tab_title . '</a></li>';
				}
			}

			$menu_list .= '</ul>';
			$menu_list .= '<nav id="global-navigation" class="global-navigation type-mega">';
			$args       = array(
				'theme_location' => $global_menu,
				'echo'           => false,
				'walker'         => new welcart_vogusih_walker(),
			);
			$menu_list .= wp_nav_menu( $args );
			$menu_list .= '</nav>';
			echo wp_kses_post( $menu_list );

		}
	}
}

/**
 * Walker Navgation Menu
 */
class welcart_vogusih_walker extends Walker_Nav_Menu {
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	var $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id',
	);

	/**
	 * Display Element
	 *
	 * @param object  $element Element.
	 * @param object  $children_elements Children Elements.
	 * @param string  $max_depth Max Depth.
	 * @param integer $depth Depth.
	 * @param array   $args Array.
	 * @param object  $output Out Put.
	 * @return object
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args = array(), &$output = '' ) {

		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

	}

	/**
	 * Start LVL
	 *
	 * @param object  $output Out Put.
	 * @param integer $depth Depth.
	 * @param integer $id ID.
	 * @return void
	 */
	public function start_lvl( &$output, $depth = 0, $id = 0 ) {

		/* depth dependent classes */
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); /* code indent */
		$display_depth = ( $depth ); /* because it counts the first submenu as 0 */
		$classes       = array( 'sub-menu', 'level-' . $display_depth );
		$class_names   = implode( ' ', $classes );

		/* build html */
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";

	}

	/**
	 * Start EL
	 *
	 * @param object  $output Out Put.
	 * @param object  $item Item.
	 * @param integer $depth Depth.
	 * @param array   $args Array.
	 * @param integer $id ID.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join(
			' ',
			apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item )
		);

		if ( $args->has_children && 0 === $depth ) {
			if ( ! empty( $class_names ) ) {
				$class_names = ' class="' . esc_attr( $class_names ) . ' has_children"';
			}
		} else {
			if ( ! empty( $class_names ) ) {
				$class_names = ' class="' . esc_attr( $class_names ) . '"';
			}
		}

		$output    .= '<li id="menu-item-' . $item->ID . '" ' . $class_names . '>';
		$attributes = '';

		if ( ! empty( $item->attr_title ) ) {
			$attributes .= ' title="' . esc_attr( $item->attr_title ) . '"';
		}
		if ( ! empty( $item->target ) ) {
			$attributes .= ' target="' . esc_attr( $item->target ) . '"';
		}
		if ( ! empty( $item->xfn ) ) {
			$attributes .= ' rel="' . esc_attr( $item->xfn ) . '"';
		}
		if ( ! empty( $item->url ) ) {
			$attributes .= ' href="' . esc_attr( $item->url ) . '"';
		}
		/* insert description for top level elements only */

		/* you may change this */
		$description = ( ! empty( $item->description ) && 0 === $depth ) ? '<span class="desc">' . esc_attr( $item->description ) . '</span>' : '';

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		if ( 0 === $depth ) { /* top level items */

			$item_output = '';

		} else { /* everything else */

			$item_output = $args->before . '<a' . $attributes . '>' . $args->link_before . $title . '</a> ' . $args->link_after . $args->after;

		}
		/* Since $output is called by reference we don't need to return anything. */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}

/* Footer */

/**
 * Copy Rights
 *
 * @return void
 */
function welcart_mode_copyright() {
	global $usces;

	$copyright = $usces->options['copyright'];
	if ( $copyright ) {
		echo '<p class="copyright">' . esc_html( $usces->options['copyright'] ) . '</p>';
	}
}
add_filter( 'usces_copyright', 'welcart_mode_copyright' );

/**
 * Custom Header Slider
 *
 * @return void
 */
function welcart_mode_custom_header_slider() {

	if ( is_admin() ) {
		return;
	}

	$switch_fade_slide = mode_get_options( 'switch_fade_slide' );
	if ( 'value1' === $switch_fade_slide ) {
		$fade = 'fade: false,' . "\n";
	} else {
		$fade         = 'fade: true,' . "\n";
		$slidesToShow = 'slidesToShow: 1,' . "\n";
	}
	$ch_show_slide_number = mode_get_options( 'ch_show_slide_number' );
	if ( 'value1' === $switch_fade_slide ) {
		if ( $ch_show_slide_number > 1 ) {
			$slidesToShow = 'slidesToShow: ' . $ch_show_slide_number . ',' . "\n";
		} else {
			$slidesToShow = 'slidesToShow: 1,' . "\n";
		}
	}
	$switch_auto_play   = mode_get_options( 'switch_auto_play' );
	$ch_slide_speed     = mode_get_options( 'ch_slide_speed' );
	$ch_animation_speed = mode_get_options( 'ch_animation_speed' );
	if ( 'value1' === $switch_auto_play ) {
		$autoplay      = 'autoplay: true,' . "\n";
		$autoplaySpeed = 'autoplaySpeed: ' . $ch_slide_speed . ',' . "\n";
		$speed         = 'speed: ' . $ch_animation_speed . ',' . "\n";
	} else {
		$autoplay      = 'autoplay: false,' . "\n";
		$autoplaySpeed = 'autoplaySpeed: 3000,' . "\n";
		$speed         = 'speed: ' . $ch_animation_speed . ',' . "\n";
	}
	$headers_count = count( get_uploaded_header_images() );
	if ( ( mode_get_options( 'ch_show_slide_number' ) >= $headers_count && 'value1' === mode_get_options( 'switch_fade_slide' ) ) || ( $headers_count <= 1 && 'value2' === mode_get_options( 'switch_fade_slide' ) ) ) {
		$dots = 'dots: false,' . "\n";
	} else {
		$dots = 'dots: true,' . "\n" . 'dotsClass: \'slide-dots\',' . "\n";
	}

	?>
<script type="text/javascript">
	( function( $ ) {

		$( function() {

			$('.home-slide-container .slider').slick({
				<?php echo esc_attr( $slidesToShow ); ?>
				<?php echo esc_attr( $autoplay ); ?>
				<?php echo esc_attr( $autoplaySpeed ); ?>
				<?php echo esc_attr( $speed ); ?>
				<?php echo esc_attr( $fade ); ?>
				centerMode: false,
				arrows: false,
				<?php echo wp_kses_post( $dots ); ?>
				focusOnSelect: false,
				responsive: [{
				breakpoint: 620,
				settings: {
					slidesToShow: 1,
					}
				}]
			});

		});

	})(jQuery);
</script>
	<?php
}
add_action( 'wp_footer', 'welcart_mode_custom_header_slider' );

/* Secondary */

/**
 * Secondary
 *
 * @return bool
 */
function welcart_mode_secondary() {
	global $post, $usces;

	$is_sidebar = mode_get_options( 'display_sidebar' );
	if ( $is_sidebar ) {
		if ( is_home() || is_front_page() ) {
			if ( in_array( 'home', $is_sidebar, true ) ) {
				return true;
			}
		}
		if ( is_search() ) {
			if ( in_array( 'search', $is_sidebar, true ) ) {
				return true;
			}
		}
		if ( is_post_type_archive( 'coordinates' ) ) {
			if ( in_array( 'coordinates', $is_sidebar, true ) ) {
				return true;
			}
		}
		if ( is_post_type_archive( 'features' ) || is_tax( 'features_cat' ) ) {
			if ( in_array( 'features', $is_sidebar, true ) ) {
				return true;
			}
		}
		if ( is_tax( 'brand' ) || is_page_template( 'page-templates/brand.php' ) ) {
			if ( in_array( 'brands', $is_sidebar, true ) ) {
				return true;
			}
		}
		if ( is_category( 'item' ) || is_category( get_child_category( 'item' ) ) ) {
			if ( in_array( 'item-list', $is_sidebar, true ) ) {
				return true;
			}
		} elseif ( is_archive() && ! ( is_post_type_archive( 'features' ) || is_post_type_archive( 'coordinates' ) || is_tax( 'brand' ) || is_tax( 'features_cat' ) ) || is_category() && ! ( is_category( 'item' ) || is_category( get_child_category( 'item' ) ) ) ) {
			if ( in_array( 'posts', $is_sidebar, true ) ) {
				return true;
			}
		}
		if ( is_single() && usces_is_item() ) {
			if ( in_array( 'item-single', $is_sidebar, true ) ) {
				return true;
			}
		}
	} else {
		if ( is_single() && usces_is_item() ) {
			return false;
		}
	}
	if ( ! ( is_single() && usces_is_item() ) && is_singular( 'post' ) && ! is_page_template( 'single-column1.php' ) ) {
		return true;
	}
	if ( is_singular( 'page' ) && is_page_template( 'page-templates/column2.php' ) ) {
		return true;
	}
	if ( is_singular( 'features' ) && is_page_template( 'single-features-column2.php' ) ) {
		return true;
	}

	return false;

}

/* Welcart */

/**
 * Campaign Message
 *
 * @param int $post_id Post ID.
 * @return object
 */
function get_welcart_mode_campaign_message( $post_id = null ) {
	global $post, $usces;
	if ( null === $post_id ) {
		$post_id = $post->ID;
	}

	$html    = '';
	$options = $usces->options;

	if ( 'Promotionsale' === $options['display_mode'] && in_category( (int) $options['campaign_category'], $post_id ) ) {
		if ( 'discount' === $options['campaign_privilege'] && ! empty( $options['privilege_discount'] ) ) {
			$html = '<div class="campaign_message campaign_discount">' . /* translators: */ sprintf( __( 'Save %d&#37;', 'welcart_mode' ), $options['privilege_discount'] ) . '</div>';
		} elseif ( 'point' === $options['campaign_privilege'] && ! empty( $options['privilege_point'] ) ) {
			$html = '<div class="campaign_message campaign_point">' . /* translators: */ sprintf( __( '%d times more points', 'welcart_mode' ), $options['privilege_point'] ) . '</div>';
		}
	}

	return apply_filters( 'welcart_mode_filter_campaign_message', $html, $post_id );

}

/**
 * Campaign Message
 *
 * @param int $post_id Post ID.
 * @return void
 */
function welcart_mode_campaign_message( $post_id = null ) {
	$campaign_message = get_welcart_mode_campaign_message( $post_id );
	if ( ! empty( $campaign_message ) ) {
		echo wp_kses_post( $campaign_message );
	}
}

/**
 * Has Campaign
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function welcart_mode_has_campaign( $post_id = null ) {
	global $post, $usces;
	if ( null === $post_id ) {
		$post_id = $post->ID;
	}

	if ( 'Promotionsale' === $usces->options['display_mode'] && in_category( (int) $usces->options['campaign_category'], $post_id ) ) {
		$res = true;
	} else {
		$res = false;
	}

	return $res;
}

/**
 * Get Product Tag
 *
 * @param int $post_id Post ID.
 * @return void
 */
function mode_get_produt_tag( $post_id = null ) {
	global $post, $usces;

	if ( ! mode_get_options( 'display_produt_tag' ) ) {
		return;
	}

	$flag = array();
	$html = '';

	if ( null === $post_id ) {
		$post_id = $post->ID;
	}

	$cats = get_the_category( $post_id );
	foreach ( $cats as $cat ) {
		switch ( $cat->slug ) {
			case 'itemnew':
				$flag['new'] = 1;
				break;
			case 'itemreco':
				$flag['reco'] = 1;
				break;
		}
	}

	if ( isset( $flag['new'] ) || isset( $flag['reco'] ) || usces_have_fewstock( $post_id ) || welcart_mode_has_campaign( $post_id ) ) {
		$html .= '<ul class="cf opt-tag">' . "\n";
		if ( isset( $flag['new'] ) ) {
			$html .= '<li class="new">' . mode_get_options( 'display_newtag_text' ) . '</li>' . "\n";
		}
		if ( isset( $flag['reco'] ) ) {
			$html .= '<li class="recommend">' . mode_get_options( 'display_hottag_text' ) . '</li>' . "\n";
		}
		if ( usces_have_fewstock( $post_id ) ) {
			$html .= '<li class="stock">' . $usces->zaiko_status[1] . '</li>' . "\n";
		}
		if ( welcart_mode_has_campaign( $post_id ) ) {
			$saletag_text = mode_get_options( 'display_saletag_text' );
			if ( ! empty( $saletag_text ) ) {
				$html .= '<li class="sale">' . $saletag_text . '</li>' . "\n";
			}
		}
		$html .= '</ul>' . "\n";
	}

	return $html;

}

/**
 * Product Tag
 *
 * @param int $post_id Post ID.
 * @return void
 */
function mode_produt_tag( $post_id = null ) {
	$produt_tag = mode_get_produt_tag( $post_id );
	if ( ! empty( $produt_tag ) ) {
		echo wp_kses_post( $produt_tag );
	}
}

/**
 * Brand Label
 *
 * @param array $post Post.
 * @return void
 */
function mode_brand_label( $post ) {
	$terms = get_the_terms( $post->ID, 'brand' );
	if ( $terms ) {
		echo '<p class="cf product-brand-tag">';
		foreach ( $terms as $term ) {
			echo '<span>' . esc_html( $term->name ) . '</span>';
		}
		echo '</p>';
	}
}

/**
 * Available Point
 *
 * @return bool
 */
function welcart_mode_is_available_point() {
	$res = true;
	if ( function_exists( 'usces_is_available_point' ) ) {
		$res = usces_is_available_point();
	} else {
		if ( defined( 'WCEX_DLSELLER_VERSION' ) && function_exists( 'dlseller_have_continue_charge' ) ) {
			if ( dlseller_have_continue_charge() ) {
				$res = false;
			}
		}
	}
	return $res;
}

/**
 * Get Cart URL
 *
 * @return string
 */
function welcart_mode_get_cart_url() {
	global $usces;
	$cart_url = USCES_CART_URL . $usces->delim;
	return $cart_url;
}

/**
 * Cart Page
 *
 * @return bool
 */
function welcart_mode_is_cart_page() {
	global $usces;
	if ( $usces->is_cart_page( $_SERVER['REQUEST_URI'] ) ) {
		if ( 'search_item' === $usces->page ) {
			return false;
		}
		return true;
	}
	return false;
}

/**
 * Member Page
 *
 * @return bool
 */
function welcart_mode_is_member_page() {
	global $usces;
	if ( $usces->is_member_page( $_SERVER['REQUEST_URI'] ) ) {
		if ( 'search_item' === $usces->page ) {
			return false;
		}
		return true;
	}
	return false;
}

/**
 * Poplink Page
 *
 * @return bool
 */
function welcart_mode_is_poplink_page() {
	$wcpl = get_option( 'wcpl' );
	if ( empty( $wcpl ) || is_admin() ) {
		return false;
	}

	global $wp_query;
	$flag = false;
	foreach ( $wcpl['setup']['enabled_page'] as $enabled_page ) {
		if ( $wp_query->$enabled_page ) {
			$flag = true;
		}
	}
	return $flag;
}

/**
 * Get Item Charging Type
 *
 * @param int $post_id Post ID.
 * @return object
 */
function welcart_mode_get_item_chargingtype( $post_id ) {
	global $usces;
	$charging = $usces->getItemChargingType( $post_id );
	return $charging;
}

/**
 * Get Item Division
 *
 * @param int $post_id Post ID.
 * @return string
 */
function welcart_mode_get_item_division( $post_id ) {
	global $usces;
	$division = $usces->getItemDivision( $post_id );
	if ( ! defined( 'WCEX_DLSELLER' ) ) {
		$division = 'shipped';
	}
	return $division;
}

/**
 * Have EX Order
 *
 * @return bool
 */
function welcart_mode_have_ex_order() {
	$ex_order = false;
	if ( defined( 'WCEX_DLSELLER' ) ) {
		$ex_order = ( ! dlseller_have_dlseller_content() && ! dlseller_have_continue_charge() ) ? false : true;
	} elseif ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
		$ex_order = wcad_have_regular_order();
	}
	return $ex_order;
}

/**
 * Have Shipped
 *
 * @return bool
 */
function welcart_mode_have_shipped() {
	$shipped = true;
	if ( defined( 'WCEX_DLSELLER' ) ) {
		$shipped = dlseller_have_shipped();
	}
	return $shipped;
}

/**
 * Have DL Seller Content
 *
 * @return bool
 */
function welcart_mode_have_dlseller_content() {
	if ( function_exists( 'dlseller_has_terms' ) ) {
		$dlseller_content = ( defined( 'WCEX_DLSELLER' ) && dlseller_have_dlseller_content() && dlseller_has_terms() ) ? true : false;
	} else {
		$dlseller_content = ( defined( 'WCEX_DLSELLER' ) && dlseller_have_dlseller_content() ) ? true : false;
	}
	return $dlseller_content;
}

/**
 * Auto Delivery History
 *
 * @return void
 */
function welcart_mode_autodelivery_history() {
	$autodelivery_history = '';
	if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
		$autodelivery_history = wcad_autodelivery_history( 'return' );
		if ( ! empty( $autodelivery_history ) ) {
			echo wp_kses_post( $autodelivery_history );
		}
	}
}

/**
 * Member Updte Settlement Page Sidebar
 *
 * @param object $sidebar Sidebar.
 * @return object
 */
function welcart_mode_member_update_settlement_page_sidebar( $sidebar ) {
	return '';
}
add_filter( 'usces_filter_member_update_settlement_page_sidebar', 'welcart_mode_member_update_settlement_page_sidebar' );


/* Coordinate */

/**
 * The Model Information
 *
 * @return object
 */
function welcart_mode_model_info() {

	if ( is_post_type_archive( 'coordinates' ) || is_tax( 'model' ) || is_home() || is_front_page() ) {
		$model_items_cont = mode_get_options( 'display_model_items' );
	} else {
		$model_items_cont = mode_get_options( 'display_post_model_items' );
	}
	if ( ! is_array( $model_items_cont ) ) {
		$model_items_cont = array();
	}
	global $post;

	$model   = '';
	$post_id = get_the_ID();
	$terms   = get_the_terms( $post_id, 'model' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$model .= '<div class="model-info">';
		foreach ( $terms as $term ) {
			$term_id      = $term->term_id;
			$model_img_id = get_term_meta( $term_id, 'model-img-id', true );
			$model_type   = get_term_meta( $term_id, 'model_type', true );
			$model_height = get_term_meta( $term_id, 'model_height', true );
			if ( ! empty( $model_img_id ) ) {
				$img_att = wp_get_attachment_image( $model_img_id, 'thumbnail' );
				/* $img_url = $img_att[0]; */
				if ( in_array( 'thumbnail', $model_items_cont, true ) ) {
					$model .= '<div class="thumbnail">' . $img_att . '</div>';
				}
			}
			$model .= '<div class="in">';
			if ( in_array( 'name', $model_items_cont, true ) ) {
				$model .= '<div class="name">' . esc_html( $term->name ) . '</div>';
			}
			if ( $model_type || $model_height ) {
				if ( in_array( 'sex', $model_items_cont, true ) || in_array( 'height', $model_items_cont, true ) ) {
					$model .= '(';
				}
				if ( $model_type ) {
					if ( in_array( 'sex', $model_items_cont, true ) ) {
						$model .= '<span class="type">' . esc_html( $model_type ) . '</span>';
					}
				}
				if ( $model_height ) {
					if ( in_array( 'height', $model_items_cont, true ) ) {
						$model .= '<span class="height">' . esc_html( $model_height ) . 'cm</span>';
					}
				}
				if ( in_array( 'sex', $model_items_cont, true ) || in_array( 'height', $model_items_cont, true ) ) {
					$model .= ')';
				}
			}
			$model .= '</div>';
			break;
		}
		$model .= '</div>';
	}

	return $model;

}


/* Brand */

/**
 * The Brand Information
 *
 * @return object
 */
function welcart_mode_brand() {
	global $post;

	$brand     = '';
	$brand_num = mode_get_options( 'brand_num' );
	$args      = array(
		'number'     => $brand_num,
		'hide_empty' => false,
	);
	$terms     = get_terms( 'brand', $args );
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$brand       .= '<div class="brand-logo list">';
			$term_id      = $term->term_id;
			$term_name    = $term->name;
			$brand_img_id = get_term_meta( $term_id, 'brand-img-id', true );
			$name_sub     = get_term_meta( $term_id, 'name_sub', 1 );
			$brand       .= '<a href="' . get_term_link( $term_id ) . '">';
			if ( ! empty( $brand_img_id ) ) {
				$img_att = wp_get_attachment_image( $brand_img_id, 'img300x200' );
				/* $img_url = $img_att[0]; */
				$brand .= $img_att;
			}
			$brand .= '<div class="over">';
			$brand .= '<div class="over-in">';
			$brand .= '<h2>' . $term_name . '</h2>';
			if ( ! empty( $name_sub ) ) {
				$brand .= '<div class="sub">' . $name_sub . '</div>';
			}
			$brand .= '</div>';
			$brand .= '</div>';
			$brand .= '</a>';
			$brand .= '</div>';
		}
	}

	return $brand;

}


/* Other */

/**
 * Check Page Exist
 *
 * @param string $slug Slug.
 * @return bool
 */
function check_page_exist( $slug ) {
	global $post;

	$args  = array(
		'post_type' => 'page',
		'pagename'  => $slug,
	);
	$pages = new WP_Query( $args );
	if ( $pages->have_posts() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Exclude Default Pages
 *
 * @return object
 */
function exclude_default_pages() {
	global $post;

	$cart_page      = get_page_by_path( 'usces-cart' );
	$cart_page_id   = $cart_page->ID;
	$member_page    = get_page_by_path( 'usces-member' );
	$member_page_id = $member_page->ID;

	$exclude_pages = "{$cart_page_id}, {$member_page_id}";
	return $exclude_pages;

}
/**
 * Walker Navigation Menu
 */
class Excerpt_Walker extends Walker_Nav_Menu {

	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	var $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id',
	);

	/**
	 * Display Element
	 *
	 * @param object  $element Element.
	 * @param object  $children_elements Children Elements.
	 * @param string  $max_depth Max Depth.
	 * @param integer $depth Depth.
	 * @param array   $args Array.
	 * @param object  $output Out Put.
	 * @return object
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args = array(), &$output = '' ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Start LVL
	 *
	 * @param object  $output Out Put.
	 * @param integer $depth Depth.
	 * @param integer $id ID.
	 * @return void
	 */
	function start_lvl( &$output, $depth = 0, $id = 0 ) {
		/* depth dependent classes */
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); /* code indent */
		$display_depth = ( $depth ); /* because it counts the first submenu as 0 */
		$classes       = array( 'sub-menu', 'level-' . $display_depth );
		$class_names   = implode( ' ', $classes );

		/* build html */
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	/**
	 * Start EL
	 *
	 * @param object  $output Out Put.
	 * @param object  $item Item.
	 * @param integer $depth Depth.
	 * @param array   $args Array.
	 * @param integer $id ID.
	 * @return void
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join(
			' ',
			apply_filters(
				'nav_menu_css_class',
				array_filter( $classes ),
				$item
			)
		);

		if ( 0 === $args->has_children && $depth ) {
			! empty( $class_names ) && $class_names = ' class="' . esc_attr( $class_names ) . ' has_children"';
		} else {
			! empty( $class_names ) && $class_names = ' class="' . esc_attr( $class_names ) . '"';
		}

		$output    .= "<li id='menu-item-$item->ID' $class_names>";
		$attributes = '';

		! empty( $item->attr_title )
			&& $attributes .= ' title="' . esc_attr( $item->attr_title ) . '"';
		! empty( $item->target )
			&& $attributes .= ' target="' . esc_attr( $item->target ) . '"';
		! empty( $item->xfn )
			&& $attributes .= ' rel="' . esc_attr( $item->xfn ) . '"';
		! empty( $item->url )
			&& $attributes .= ' href="' . esc_attr( $item->url ) . '"';

		/* insert description for top level elements only */

		/* you may change this */
		$description = ( ! empty( $item->description ) && 0 === $depth )
			? '<span class="desc">' . esc_attr( $item->description ) . '</span>' : '';

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		if ( 0 === $depth ) { /* top level items */
			$item_output = '';
		} else { /* everything else */
			$item_output = $args->before
			. "<a $attributes>"
			. $args->link_before
			. $title
			. '</a> '
			. $args->link_after
			. $args->after;
		}
		/* Since $output is called by reference we don't need to return anything. */
		$output .= apply_filters(
			'walker_nav_menu_start_el',
			$item_output,
			$item,
			$depth,
			$args
		);
	}

}

/**
 * Get Child Category
 *
 * @param string $catname Category Name.
 * @return string
 */
function get_child_category( $catname ) {

	$parent_slug    = get_category_by_slug( $catname );
	$parent_id      = $parent_slug->cat_ID;
	$sub_categories = get_categories( array( 'child_of' => $parent_id ) );

	$cat_array = array();
	array_push( $cat_array, $parent_id );
	foreach ( $sub_categories as $sub_category ) {
		array_push( $cat_array, $sub_category->slug );
	}
	return $cat_array;

}

/**
 * Password Policy Message
 *
 * @return void
 */
function welcart_mode_password_policy_message() {
	if ( function_exists( 'usces_password_policy_message' ) ) {
		usces_password_policy_message();
	}
}

/**
 * Soldout label
 *
 * @param int    $post_id Post ID.
 * @param string $out Return value or echo.
 * @return string|void
 */
function welcart_mode_soldout_label( $post_id, $out = '' ) {
	global $usces;

	// $stock_status = __( 'Sold out', 'welcart_mode' );
	$stock_status = 'Soldout';
	$skus         = wel_get_skus( $post_id );
	if ( 1 === count( (array) $skus ) ) {
		$stock = $skus[0]['stock'];
		if ( 2 !== (int) $stock ) {
			$stock_status = $usces->zaiko_status[ $stock ];
		}
	}
	$stock_status = apply_filters( 'welcart_mode_filter_soldout_label', $stock_status, $post_id, $skus );
	if ( 'return' === $out ) {
		return $stock_status;
	} else {
		echo esc_html( $stock_status );
	}
}
