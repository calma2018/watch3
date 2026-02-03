<?php
/**
 * Customizer - Custom Styles Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Customizer CSS
 *
 * @return void
 */
function mode_customizer_css() {
	if ( 'customize.php' === basename( $_SERVER['PHP_SELF'] ) ) {
		?>

	<style type="text/css">

		/*------------------------------------------------------

		　サイト基本情報

		------------------------------------------------------*/

		#customize-control-control_fixed_header:before {
			content: "<?php esc_html_e( 'Fixed Header', 'welcart_mode' ); ?>";
		}
		#accordion-section-menu_locations:after {
			content: "<?php esc_html_e( 'Menu display type', 'welcart_mode' ); ?>";
		}
		#accordion-section-global_menu_custom:before {
			content: "<?php esc_html_e( 'Please select a display type.', 'welcart_mode' ); ?>";
		}
		#customize-control-widget_cart_header:before {
			content: "<?php esc_html_e( 'Display The Widget Cart in Header', 'welcart_mode' ); ?>";
		}


		/*------------------------------------------------------

		　メニュー

		------------------------------------------------------*/

		#customize-control-control_menu_display_method .customize-inside-control-row:after {
			content: "<?php esc_html_e( 'List menu for smartphones, accordion menu for PCs / tablet', 'welcart_mode' ); ?>";
		}
		#customize-control-control_menu_display_method .customize-inside-control-row:last-child:after {
			content: "<?php esc_html_e( 'Tab menu for smartphone, mega menu for PC/tablet', 'welcart_mode' ); ?>";
		}



		/*------------------------------------------------------

		　色

		------------------------------------------------------*/

		/* ---- h1 ---- */
		#customize-control-primary_bg_color:before {
			content: "<?php esc_html_e( 'entirety', 'welcart_mode' ); ?>";
		}
		#customize-control-header_bg_color:before {
			content: "<?php esc_html_e( 'Header', 'welcart_mode' ); ?>";
		}
		#customize-control-footer_bg_color:before {
			content: "<?php esc_html_e( 'Footer', 'welcart_mode' ); ?>";
		}
		#customize-control-copyright_text_color:after {
			content: "<?php esc_html_e( 'Items', 'usces' ); ?>";
		}
		#customize-control-tabs_current_text_color:after {
			content: "<?php esc_html_e( 'Other', 'welcart_mode' ); ?>";
		}

		/* ---- h2 ---- */
		#customize-control-primary_border_color:after {
			content: "<?php esc_html_e( 'Table', 'welcart_mode' ); ?>";
		}
		#customize-control-primary_button_bg_color:before {
			content: "<?php esc_html_e( 'Button1', 'welcart_mode' ); ?>";
		}
		#customize-control-primary_sub_button1_bg_color:before {
			content: "<?php esc_html_e( 'Button2', 'welcart_mode' ); ?>";
		}
		#customize-control-primary_sub_button2_bg_color:before {
			content: "<?php esc_html_e( 'Button3', 'welcart_mode' ); ?>";
		}
		#customize-control-header_sub_bg_color:before {
			content: "<?php esc_html_e( 'Sub Color', 'welcart_mode' ); ?>";
		}
		#customize-control-header_button_border_color:before {
			content: "<?php esc_html_e( 'Button', 'welcart_mode' ); ?>";
		}
		#customize-control-cart_quantity_background_color:before {
			content: "<?php esc_html_e( 'Quantity Background Color', 'welcart_mode' ); ?>";
		}
		#customize-control-footer_icon_bg_color:before {
			content: "<?php esc_html_e( 'Icon', 'welcart_mode' ); ?>";
		}
		#customize-control-copyright_bg_color:before {
			content: "<?php esc_html_e( 'Copyright', 'welcart_mode' ); ?>";
		}
		#customize-control-cart_button_bg_color:before {
			content: "<?php esc_html_e( 'The cart button', 'welcart_mode' ); ?>";
		}
		#customize-control-opt_new_color:before {
			content: "<?php esc_html_e( 'item tag', 'welcart_mode' ); ?>";
		}
		#customize-control-opt_sale_color:after {
			content: "<?php esc_html_e( 'Tab Menu', 'welcart_mode' ); ?>";
		}
		#customize-control-tabs_current_bg_color:before {
			content: "<?php esc_html_e( 'Current', 'welcart_mode' ); ?>";
		}
		#customize-control-calendar_holiday_bg_color:before {
			content: "<?php esc_html_e( 'Holiday for Shipping Operations', 'usces' ); ?>";
		}
		#customize-control-entry_bg_color:before {
			content: "<?php esc_html_e( 'Panel', 'welcart_mode' ); ?>";
		}

		/* ---- h3 ---- */
		#customize-control-primary_th_bg_color:before {
			content: "<?php esc_html_e( 'Table Head', 'welcart_mode' ); ?>";
		}

		/*------------------------------------------------------

		　テーマオプション

		------------------------------------------------------*/

		#customize-control-control_display_features:before {
			content: "<?php esc_html_e( 'Features', 'welcart_mode' ); ?>";
		}
		#customize-control-display_widget_slide:before {
			content: "<?php esc_html_e( 'Item Widget', 'welcart_mode' ); ?>";
		}
		#customize-control-control_display_coordinate:before {
			content: "<?php esc_html_e( 'Coordinates', 'welcart_mode' ); ?>";
		}
		#customize-control-coordinate_column:after {
			content: "<?php esc_html_e( 'The contents of the list can be set from the Coordination list.', 'welcart_mode' ); ?>";
		}
		#customize-control-control_display_brand:before {
			content: "<?php esc_html_e( 'Brands', 'welcart_mode' ); ?>";
		}
		#customize-control-control_display_posts:before {
			content: "<?php esc_html_e( 'Post', 'welcart_mode' ); ?>";
		}



	</style>

		<?php
	}
}
add_action( 'admin_print_styles', 'mode_customizer_css' );

/**
 * Chenging RGB
 *
 * @param string $hex Chenging RGB.
 * @return string
 */
function mode_rgb( $hex ) {
	$hex = str_replace( '#', '', $hex );

	if ( 3 === strlen( $hex ) ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb;
}

/**
 * Customizer Footer Styles
 *
 * @return void
 */
function mode_customizer_footer_styles() {

	/* Common ------------------------------------------------------*/

	$primary_bg_color   = get_theme_mod( 'primary_bg_color', '#fff' );
	$primary_text_color = get_theme_mod( 'primary_text_color', '#333' );

	$primary_link_color      = get_theme_mod( 'primary_link_color', '#333' );
	$primary_link_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $primary_link_color ) ) . ', .7 )';

	$primary_border_color = get_theme_mod( 'primary_border_color', '#e8e8e8' );

	$primary_th_bg_color        = get_theme_mod( 'primary_th_bg_color', '#fff' );
	$primary_th_text_color      = get_theme_mod( 'primary_th_text_color', '#333' );
	$primary_table_border_color = get_theme_mod( 'primary_table_border_color', '#e8e8e8' );

	$primary_button_bg_color        = get_theme_mod( 'primary_button_bg_color', '#777777' );
	$primary_button_bg_color_rgba   = 'rgba( ' . implode( ', ', mode_rgb( $primary_button_bg_color ) ) . ', .7 )';
	$primary_button_text_color      = get_theme_mod( 'primary_button_text_color', '#ffffff' );
	$primary_button_text_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $primary_button_text_color ) ) . ', .9 )';

	$primary_sub_button1_bg_color        = get_theme_mod( 'primary_sub_button1_bg_color', '#777777' );
	$primary_sub_button1_bg_color_rgba   = 'rgba( ' . implode( ', ', mode_rgb( $primary_sub_button1_bg_color ) ) . ', .7 )';
	$primary_sub_button1_text_color      = get_theme_mod( 'primary_sub_button1_text_color', '#ffffff' );
	$primary_sub_button1_text_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $primary_sub_button1_text_color ) ) . ', .9 )';

	$primary_sub_button2_bg_color        = get_theme_mod( 'primary_sub_button2_bg_color', '#eeeeee' );
	$primary_sub_button2_bg_color_rgba   = 'rgba( ' . implode( ', ', mode_rgb( $primary_sub_button2_bg_color ) ) . ', .7 )';
	$primary_sub_button2_text_color      = get_theme_mod( 'primary_sub_button2_text_color', '#333333' );
	$primary_sub_button2_text_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $primary_sub_button2_text_color ) ) . ', .9 )';

	/* Header ------------------------------------------------------*/

	$header_bg_color                 = get_theme_mod( 'header_bg_color', '#fff' );
	$header_sub_bg_color             = get_theme_mod( 'header_sub_bg_color', '#f3f3f3' );
	$header_text_color               = get_theme_mod( 'header_text_color', '#333' );
	$header_text_color_rgba          = 'rgba( ' . implode( ', ', mode_rgb( $header_text_color ) ) . ', .7 )';
	$header_sub_text_color           = get_theme_mod( 'header_sub_text_color', '#333' );
	$header_sub_text_color_rgba      = 'rgba( ' . implode( ', ', mode_rgb( $header_sub_text_color ) ) . ', .7 )';
	$header_button_border_color      = get_theme_mod( 'header_button_border_color', '#ddd' );
	$header_button_border_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $header_button_border_color ) ) . ', .7 )';
	$header_border_color             = get_theme_mod( 'header_border_color', '#ddd' );
	$cart_quantity_background_color  = get_theme_mod( 'cart_quantity_background_color', '#9ea640' );

	/* Footer ------------------------------------------------------*/

	$footer_bg_color = get_theme_mod( 'footer_bg_color', '#f4f4f4' );

	$footer_text_color      = get_theme_mod( 'footer_text_color', '#333333' );
	$footer_text_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $footer_text_color ) ) . ', .7 )';

	$footer_border_color = get_theme_mod( 'footer_border_color', '#dddddd' );

	$footer_icon_bg_color   = get_theme_mod( 'footer_icon_bg_color', '#ffffff' );
	$footer_icon_color      = get_theme_mod( 'footer_icon_color', '#333333' );
	$footer_icon_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $footer_icon_color ) ) . ', .7 )';

	$copyright_bg_color   = get_theme_mod( 'copyright_bg_color', '#333333' );
	$copyright_text_color = get_theme_mod( 'copyright_text_color', '#ffffff' );

	/* Item ------------------------------------------------------*/

	$cart_button_bg_color        = get_theme_mod( 'cart_button_bg_color', '#777777' );
	$cart_button_bg_color_rgba   = 'rgba( ' . implode( ', ', mode_rgb( $cart_button_bg_color ) ) . ', .7 )';
	$cart_button_text_color      = get_theme_mod( 'cart_button_text_color', '#ffffff' );
	$cart_button_text_color_rgba = 'rgba( ' . implode( ', ', mode_rgb( $cart_button_text_color ) ) . ', .7 )';

	$favorite_button_bg = 'rgba( ' . implode( ', ', mode_rgb( $cart_button_bg_color ) ) . ', .1 )';

	$price_color   = get_theme_mod( 'price_color', '#333333' );
	$soldout_color = get_theme_mod( 'soldout_color', '#dd0000' );

	$opt_new_color   = get_theme_mod( 'opt_new_color', '#b5cc18' );
	$opt_reco_color  = get_theme_mod( 'opt_reco_color', '#21ba45' );
	$opt_stock_color = get_theme_mod( 'opt_stock_color', '#00b5ad' );
	$opt_sale_color  = get_theme_mod( 'opt_sale_color', '#e03997' );

	$tabs_bg_color           = get_theme_mod( 'tabs_bg_color', '#eeeeee' );
	$tabs_text_color         = get_theme_mod( 'tabs_text_color', '#333333' );
	$tabs_current_bg_color   = get_theme_mod( 'tabs_current_bg_color', '#9c9c9c' );
	$tabs_current_text_color = get_theme_mod( 'tabs_current_text_color', '#ffffff' );
	$tabs_border_color       = get_theme_mod( 'tabs_border_color', '#dddddd' );

	/* Other ------------------------------------------------------*/

	$calendar_holiday_bg_color   = get_theme_mod( 'calendar_holiday_bg_color', '#eeeeee' );
	$calendar_holiday_text_color = get_theme_mod( 'calendar_holiday_text_color', '#333333' );
	$entry_bg_color              = get_theme_mod( 'entry_bg_color', '#f2f2f2' );
	$entry_text_color            = get_theme_mod( 'entry_text_color', '#333333' );
	$entry_text_color_rgba       = 'rgba( ' . implode( ', ', mode_rgb( $entry_text_color ) ) . ', .5 )';
	$entry_border_color          = get_theme_mod( 'entry_border_color', '#cccccc' );

	$error_message = get_theme_mod( 'error_message', '#dd0000' );

	/* Brand ------------------------------------------------------*/

	$brand_border_color = get_theme_mod( 'logo_border_color', '#cccccc' );

	?>
<style type="text/css">

	/* Primary ------------------------------------------------------*/

	body {
		background-color: <?php echo esc_attr( $primary_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_text_color ); ?>;
	}
	a {
		color: <?php echo esc_attr( $primary_link_color ); ?>;
	}
	a:hover {
		color: <?php echo esc_attr( $primary_link_color_rgba ); ?>;
	}

	/* --------- primary border -------- */
	/* --------- primary table -------- */
	table th,
	table td,
	#cart-table tbody tr,
	#delivery_flag,
	#time,
	#time tr:nth-last-child(2) th,
	#time tr:nth-last-child(2) td,
	#confirm-table tr.ttl td h3,
	.user-info td,
	.customer_form tr:after,
	#wc_autodelivery_history .inside {
		border-color: <?php echo esc_attr( $primary_table_border_color ); ?>;
	}

	#content .entry-content table th,
	#content .entry-content table td {
		border-color: <?php echo esc_attr( $primary_table_border_color ); ?>;
	}
	#content .entry-content table th {
		background-color: <?php echo esc_attr( $primary_th_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_th_text_color ); ?>;
	}

	/* --------- Button -------- */

	/* ----- primary Button ---- */
	#wc_lostmemberpassword .send input,
	#wc_changepassword .send input,
	#wc_newmemberform .send input,
	#wc_editmemberform .send input.editmember,
	#wc_member .send input.editmember,
	.gotoedit a,
	#wc_member .member_submenu li a,
	#wc_member_mda .member_submenu li a,
	#wc_member_mda .member_submenu div a,
	.send input.to_customerinfo_button,
	.send input.to_memberlogin_button,
	.send input.to_deliveryinfo_button,
	.send input.to_confirm_button,
	.send input.to_reganddeliveryinfo_button,
	.send input.checkout_button,
	.send input.member_login_button,
	.entry-member a,
	.send input.card-register,
	.widget_welcart_login #member_loginw,
	#checkout_review #purchase_button {
		background-color: <?php echo esc_attr( $primary_button_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_button_text_color ); ?>;
	}
	#wc_lostmemberpassword .send input:hover,
	#wc_changepassword .send input:hover,
	#wc_newmemberform .send input:hover,
	#wc_member .send input.editmember:hover,
	.gotoedit a:hover,
	#wc_member .member_submenu li a:hover,
	#wc_member_mda .member_submenu li a:hover,
	#wc_member_mda .member_submenu div a:hover,
	.send input.to_customerinfo_button:hover,
	.send input.to_memberlogin_button:hover,
	.send input.to_deliveryinfo_button:hover,
	.send input.to_confirm_button:hover,
	.send input.to_reganddeliveryinfo_button:hover,
	.send input.checkout_button:hover,
	.send input.member_login_button:hover,
	.entry-member a:hover,
	.send input.card-register:hover,
	.widget_welcart_login #member_loginw:hover,
	#checkout_review #purchase_button:hover {
		background-color: <?php echo esc_attr( $primary_button_bg_color_rgba ); ?>;
		color: <?php echo esc_attr( $primary_button_text_color_rgba ); ?>;
	}

	/* ----- primary Sub Button1 ---- */

	#toTop a,
	#point_table .use_point_button,
	.customer_form #zipcode_row input#search_zipcode,
	.upbutton input,
	.section-home .slick-arrow {
		background-color: <?php echo esc_attr( $primary_sub_button1_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_sub_button1_text_color ); ?>;
	}
	.slick-arrow:before {
		border-color: <?php echo esc_attr( $primary_sub_button1_text_color ); ?>;
	}
	#toTop a span:before {
		color: <?php echo esc_attr( $primary_sub_button1_text_color ); ?>;
	}
	#point_table .use_point_button:hover,
	.customer_form #zipcode_row input#search_zipcode:hover,
	.upbutton input:hover,
	.section-home .slick-arrow:hover,
	#toTop a:hover {
		background-color: <?php echo esc_attr( $primary_sub_button1_bg_color_rgba ); ?>;
		color: <?php echo esc_attr( $primary_sub_button1_text_color_rgba ); ?>;
	}
	#toTop a span:hover:before {
		color: <?php echo esc_attr( $primary_sub_button1_text_color_rgba ); ?>;
	}

	/* ----- primary Sub Button2 ---- */

	#wc_member .member_submenu li a.usces_logout_a,
	#wc_member_mda .member_submenu li a.usces_logout_a,
	#wc_member_mda .member_submenu div a.usces_logout_a,
	#cart_completion .send a,
	#member_completion .send a,
	.send input,
	.member_submenu li a,
	input[type="button"],
	input[type="submit"],
	input[type="reset"],
	#checkout_review .back_to_delivery_button,
	#checkout_review .login-backbtn,
	#wc_member_favorite_page .send a,
	#tofavorite-content a {
		background-color: <?php echo esc_attr( $primary_sub_button2_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_sub_button2_text_color ); ?>;
	}
	.amzlogin.customer_form .ui.button {
		background: <?php echo esc_attr( $primary_sub_button2_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_sub_button2_text_color ); ?>;
	}
	#wc_member .member_submenu li a.usces_logout_a:hover,
	#wc_member_mda .member_submenu li a.usces_logout_a:hover,
	#wc_member_mda .member_submenu div a.usces_logout_a:hover,
	#cart_completion .send a:hover,
	#member_completion .send a:hover,
	.send input:hover,
	.member_submenu li a:hover,
	input[type="button"]:hover,
	input[type="submit"]:hover,
	input[type="reset"]:hover,
	#checkout_review .back_to_delivery_button:hover,
	#checkout_review .login-backbtn:hover,
	#wc_member_favorite_page .send a:hover,
	#tofavorite-content a:hover {
		background-color: <?php echo esc_attr( $primary_sub_button2_bg_color_rgba ); ?>;
		color: <?php echo esc_attr( $primary_sub_button2_text_color_rgba ); ?>;
	}
	.amzlogin.customer_form .ui.button:hover {
		background-color: <?php echo esc_attr( $primary_sub_button2_bg_color_rgba ); ?>;
		color: <?php echo esc_attr( $primary_sub_button2_text_color_rgba ); ?>;
	}


	/* Header ------------------------------------------------------*/

	.header-group,
	.type-mega.global-navigation ul.default-menu > li:hover > .sub-menu {
		background-color: <?php echo esc_attr( $header_bg_color ); ?>;
		color: <?php echo esc_attr( $header_text_color ); ?>
	}
	.drawer-menu-sp,
	.search-box .search-text {
		background-color: <?php echo esc_attr( $header_bg_color ); ?>;
	}
	.incart .welicon-shopping-cart:before,
	.membership li:first-child:before,
	.header-group a,
	.search-box .searchsubmit,
	.search-box .search-text,
	.global-navigation li a ~ span:before {
		color: <?php echo esc_attr( $header_text_color ); ?>
	}
	.header-group a:hover {
		color: <?php echo esc_attr( $header_text_color_rgba ); ?>
	}
	.trigger-menu .bar-top,
	.trigger-menu .bar-middle:before,
	.trigger-menu .bar-middle:after,
	.trigger-menu .bar-bottom {
		background-color: <?php echo esc_attr( $header_text_color ); ?>
	}
	.sub-navigation li a {
		color: <?php echo esc_attr( $header_sub_text_color ); ?>;
	}
	.sub-navigation li a:hover {
		color: <?php echo esc_attr( $header_sub_text_color_rgba ); ?>;
	}
	.shopping-navigation form,
	.sub-navigation {
		background-color: <?php echo esc_attr( $header_sub_bg_color ); ?>;
	}
	.shopping-navigation,
	.global-navigation li,
	.global-navigation .menu > li:last-child,
	.sub-navigation li {
		border-color: <?php echo esc_attr( $header_border_color ); ?>;
	}
	.drawer-tabs li.current:after {
		background-color: <?php echo esc_attr( $header_border_color ); ?>;
	}
	.membership li a {
		border-color: <?php echo esc_attr( $header_button_border_color ); ?>;
	}
	.membership li a:hover {
		border-color: <?php echo esc_attr( $header_button_border_color_rgba ); ?>;
	}
	.header-group .incart .total-quantity {
		background-color: <?php echo esc_attr( $cart_quantity_background_color ); ?>;
	}


	/* Footer ------------------------------------------------------*/

	.footer-group,
	.footer-group a {
		color: <?php echo esc_attr( $footer_text_color ); ?>;
	}
	.footer-group a:hover {
		color: <?php echo esc_attr( $footer_text_color_rgba ); ?>;
	}
	.footer-group .in {
		background-color: <?php echo esc_attr( $footer_bg_color ); ?>;
	}
	.footer-navigation li a:after {
		background-color: <?php echo esc_attr( $footer_border_color ); ?>;
	}
	.shop-sns a {
		background-color: <?php echo esc_attr( $footer_icon_bg_color ); ?>;
	}
	.shop-sns span:before {
		color: <?php echo esc_attr( $footer_icon_color ); ?>;
	}
	.shop-sns a:hover span:before {
		color: <?php echo esc_attr( $footer_icon_color_rgba ); ?>;
	}
	.copyright {
		background-color: <?php echo esc_attr( $copyright_bg_color ); ?>;
		color: <?php echo esc_attr( $copyright_text_color ); ?>;
	}


	#secondary.secondary:before {
		background-color: <?php echo esc_attr( $primary_border_color ); ?>;
	}


	/* Item ------------------------------------------------------*/

	.is-product .add-to-cart .cart-button .skubutton,
	#tofavorite-content .tofavorite-page-link a,
	#tofavorite-content .tologin-page-link a,
	#tofavorite-content .tologin-newmember-page-link a,
	.favorite-button .add-favorite:hover,
	.favorite-button .add-favorite.added:hover {
		background-color: <?php echo esc_attr( $cart_button_bg_color ); ?>;
		color: <?php echo esc_attr( $cart_button_text_color ); ?>;
	}
	.favorite-button .add-favorite {
		background-color: <?php echo esc_attr( $favorite_button_bg ); ?>;
		border-color: <?php echo esc_attr( $cart_button_bg_color ); ?>;
		color: <?php echo esc_attr( $cart_button_bg_color ); ?>;
	}

	<?php if ( ! wp_is_mobile() ) : ?>
	.is-product .add-to-cart .cart-button .skubutton:hover,
	#tofavorite-content .tofavorite-page-link a:hover,
	#tofavorite-content .tologin-page-link a:hover,
	#tofavorite-content .tologin-newmember-page-link a:hover {
		background-color: <?php echo esc_attr( $cart_button_bg_color_rgba ); ?>;
		color: <?php echo esc_attr( $cart_button_text_color_rgba ); ?>;
	}
	<?php endif; ?>

	.column-grid .list .price,
	.is-product .add-to-cart .field_price {
		color: <?php echo esc_attr( $price_color ); ?>;
	}
	.is-product .add-to-cart .field_price .field_cprice,
	.tax,
	#wcexaap-button-wrapper .info-message {
		color: <?php echo esc_attr( $primary_text_color ); ?>;
	}
	#cart_checkout_box .cart-next .text h4,
	#cart_checkout_box .amazon-next .text h4 {
		color: <?php echo esc_attr( $primary_text_color ); ?> !important;
	}
	.is-product .add-to-cart .itemsoldout {
		background-color: <?php echo esc_attr( $primary_sub_button2_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_sub_button2_text_color ); ?>
	}
	.itemsoldout {
		color: <?php echo esc_attr( $soldout_color ); ?>;
	}

	/* ---- opt-tag ---- */

	.opt-tag .new {
		background-color: <?php echo esc_attr( $opt_new_color ); ?>;
	}
	.opt-tag .recommend {
		background-color: <?php echo esc_attr( $opt_reco_color ); ?>;
	}
	.opt-tag .stock {
		background-color: <?php echo esc_attr( $opt_stock_color ); ?>;
	}
	.opt-tag .sale,
	.campaign_message.campaign_discount,
	.campaign_message.campaign_point {
		background-color: <?php echo esc_attr( $opt_sale_color ); ?>;
	}

	.is-product .tabs,
	.is-product .tabs li {
		border-color: <?php echo esc_attr( $tabs_border_color ); ?>;
	}
	.is-product .tabs-pc .tabs li {
		background-color: <?php echo esc_attr( $tabs_bg_color ); ?>;
		color: <?php echo esc_attr( $tabs_text_color ); ?>;
	}
	.is-product .tabs-pc .tabs li.active {
		background-color: <?php echo esc_attr( $tabs_current_bg_color ); ?>;
		color: <?php echo esc_attr( $tabs_current_text_color ); ?>;
	}
	.is-product .tabs li .icon .in:before,
	.is-product .tabs li .icon .in:after {
		background-color: <?php echo esc_attr( $primary_text_color ); ?>;
	}

	.item-content:after {
		background-color: <?php echo esc_attr( $primary_border_color ); ?>;
	}


	/* Other ------------------------------------------------------*/

	#secondary.secondary .widget_welcart_calendar td.businessday:before,
	#secondary.secondary .widget_welcart_calendar span.businessday {
		background-color: <?php echo esc_attr( $calendar_holiday_bg_color ); ?>;
	}
	#secondary.secondary .widget_welcart_calendar td.businessday {
		color:<?php echo esc_attr( $calendar_holiday_text_color ); ?>;
	}
	#point_table,
	.is-product .entry-review,
	.member-login .entry-member {
		background-color: <?php echo esc_attr( $entry_bg_color ); ?>;
		color: <?php echo esc_attr( $entry_text_color ); ?>;
	}
	.cart-navi ul {
		background-color: <?php echo esc_attr( $entry_bg_color ); ?>;
		color: <?php echo esc_attr( $entry_text_color_rgba ); ?>;
	}
	.cart-navi li.current {
		color: <?php echo esc_attr( $entry_text_color ); ?>;
	}
	.cart-navi li:after {
		color: <?php echo esc_attr( $entry_text_color_rgba ); ?>;
	}
	.user-history {
		background-color: <?php echo esc_attr( $entry_bg_color ); ?>;
		color: <?php echo esc_attr( $entry_text_color ); ?>;
	}
	.user-history a,
	.user-history .tax {
		color: <?php echo esc_attr( $entry_text_color ); ?>;
	}
	table.retail {
		border-color: <?php echo esc_attr( $entry_border_color ); ?>;
	}

	.error_message {
		color: <?php echo esc_attr( $error_message ); ?>;
	}

	/* Brand ------------------------------------------------------*/

	<?php if ( true === mode_get_options( 'logo_border' ) ) : ?>
		.brand-logo a {
			padding: 1px;
			border: 1px solid <?php echo esc_attr( $brand_border_color ); ?>;
		}
	<?php endif; ?>


	/**
	* 16.3 Tablet Large 880px
	*/
	@media screen and (min-width: 55em) {

		/* Header ------------------------------------------------------*/

		.drawer-menu-pc {
			background-color: <?php echo esc_attr( $header_bg_color ); ?>;
		}
		.drawer-tabs + .global-navigation.type-mega {
			background-color: <?php echo esc_attr( $header_bg_color ); ?>;
		}
		.type-mega .level-0 > li {
			border-color: <?php echo esc_attr( $header_border_color ); ?>;
		}

		/* ---- .fixed ---- */
		.header-group .header_inner {
			background-color: <?php echo esc_attr( $header_bg_color ); ?>;
		}

		/* Home ------------------------------------------------------*/

		.section-home .entryfoot .more a {
			border-color: <?php echo esc_attr( $primary_link_color ); ?>;
		}


	}


	/* Button ------------------------------------------------------*/

	/* ---- primary button ---- */
	#wc_member_update_settlement .send input.card-update,
	#wc_member_msa .member_submenu li:not(.edit_member) a,
	#new_destination,
	#add_destination,
	#edit_destination,
	.open_allocation_bt,
	.ui-widget-content .go_destination a,
	.return_navi a,
	#determine, #new_alloc_button,
	input[type=button].allocation_edit_button,
	table#delivery_table tr td.delivery-address-book a.new-delivery-address-button {
		background-color: <?php echo esc_attr( $primary_button_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_button_text_color ); ?>;
	}
	#wc_member_update_settlement .send input.card-update:hover,
	#wc_member_msa .member_submenu li:not(.edit_member) a:hover,
	#new_destination:hover,
	#add_destination:hover,
	#edit_destination:hover,
	.open_allocation_bt:hover,
	.ui-widget-content .go_destination a:hover,
	.return_navi a:hover,
	#determine, #new_alloc_button:hover,
	input[type=button].allocation_edit_button:hover,
	table#delivery_table tr td.delivery-address-book a.new-delivery-address-button:hover {
		background-color: <?php echo esc_attr( $primary_button_bg_color_rgba ); ?>;
		color: <?php echo esc_attr( $primary_button_text_color_rgba ); ?>;
	}
	.open_allocation_bt,
	.msa_field .search-zipcode {
		background-color: <?php echo esc_attr( $primary_sub_button1_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_sub_button1_text_color ); ?>;
	}
	.open_allocation_bt:hover,
	.msa_field .search-zipcode:hover {
		background-color: <?php echo esc_attr( $primary_sub_button1_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_sub_button1_text_color ); ?>;
	}
	/* ---- primary sub button2 ---- */
	#wc_member_msa .member_submenu a,
	#AllAllocationPDF,
	#del_destination,
	#cancel_destination,
	.allocation_delete_button,
	.ui-button-text-only .ui-button-text,
	input[type=button].allocation_delete_button {
		background-color: <?php echo esc_attr( $primary_sub_button2_bg_color ); ?>;
		color: <?php echo esc_attr( $primary_sub_button2_text_color ); ?>;
	}
	#wc_member_msa .member_submenu a:hover,
	#AllAllocationPDF:hover,
	#del_destination:hover,
	#cancel_destination:hover,
	.allocation_delete_button:hover,
	.ui-button-text-only .ui-button-text:hover,
	input[type=button].allocation_delete_button:hover {
		background-color: <?php echo esc_attr( $primary_sub_button2_bg_color_rgba ); ?>;
		color: <?php echo esc_attr( $primary_sub_button2_text_color_rgba ); ?>;
	}

	.allocation_dialog_exp {
		color: <?php echo esc_attr( $primary_text_color ); ?>;
	}
	#wc_member_msa table td,
	#wc_confirm #cart-table td.msa-destination,
	#wc_confirm #cart-table td.msa-postage-title,
	#wc_confirm #cart-table td.msa-postage-detail,
	#wc_confirm #cart-table tbody tr:last-child {
		border-color: <?php echo esc_attr( $primary_table_border_color ); ?>;
	}
	.msa_field_block .msa_title:after,
	.msa_field_block .msa_field:after {
		background-color: <?php echo esc_attr( $primary_border_color ); ?>;
	}


	<?php if ( defined( 'WCEX_WIDGET_CART' ) ) : ?>

		#wgct_total_price dt,
		#wgct_total_price dd .tax {
			color: <?php echo esc_attr( $header_text_color ); ?>;
		}
		#widget_cart_open ~ .view-cart {
			background-color: <?php echo esc_attr( $header_bg_color ); ?>;
			border-color: <?php echo esc_attr( $header_border_color ); ?>;
		}
		#wgct_row .widgetcart_rows .head th {
			background-color: <?php echo esc_attr( $header_text_color ); ?>;
			color: <?php echo esc_attr( $header_bg_color ); ?>;
		}
		#wgct_row .widgetcart_rows td {
			border-bottom-color: <?php echo esc_attr( $header_border_color ); ?>;
		}
		#wdgctToCheckout a {
			background-color: <?php echo esc_attr( $cart_button_bg_color ); ?>;
			color: <?php echo esc_attr( $cart_button_text_color ); ?>;
		}
		#wdgctToCheckout a:hover {
			background-color: <?php echo esc_attr( $cart_button_bg_color_rgba ); ?>;
			color: <?php echo esc_attr( $cart_button_text_color ); ?>;
		}
		#wdgctToCart a {
			border-color: <?php echo esc_attr( $header_button_border_color ); ?>;
		}
		#wdgctToCart a:hover {
			border-color: <?php echo esc_attr( $header_button_border_color_rgba ); ?>;
		}
		#wgct_total_price dd {
			color: <?php echo esc_attr( $price_color ); ?>;
		}
		.widgetcart-close-btn {
			border-color: <?php echo esc_attr( $header_text_color ); ?>;
		}
		#widget_cart_open ~ .view-cart .widgetcart-close-btn .bar {
			background-color: <?php echo esc_attr( $header_text_color ); ?>;
		}


	<?php endif; ?>

	<?php if ( defined( 'WCEX_AUTO_DELIVERY' ) ) : ?>

		#wc_regular {
			background-color: <?php echo esc_attr( $entry_bg_color ); ?>;
			color: <?php echo esc_attr( $entry_text_color ); ?>;
		}
		#wc_regular .skuform .skubutton {
			background-color: <?php echo esc_attr( $cart_button_bg_color ); ?>;
			color: <?php echo esc_attr( $cart_button_text_color ); ?>;
		}
		#wc_regular .skuform .skubutton:hover {
			background-color: <?php echo esc_attr( $cart_button_bg_color_rgba ); ?>;
			color: <?php echo esc_attr( $cart_button_text_color_rgba ); ?>;
		}

	<?php endif; ?>

	<?php if ( defined( 'WCEX_SKU_SELECT' ) ) : ?>

		dl.item-sku dd label {
			border-color: <?php echo esc_attr( $primary_border_color ); ?>;
			color: <?php echo esc_attr( $primary_text_color ); ?>;
		}
		dl.item-sku dd input[type="radio"]:checked + span + label,
		dl.item-sku dd label:hover {
			border-color: <?php echo esc_attr( $primary_text_color ); ?>;
		}
		#wc_regular dl.item-sku dd label {
			border-color: <?php echo esc_attr( $entry_border_color ); ?>;
			color: <?php echo esc_attr( $entry_text_color ); ?>;
		}
		#wc_regular dl.item-sku dd input[type="radio"]:checked + span + label,
		#wc_regular dl.item-sku dd label:hover {
			border-color: <?php echo esc_attr( $entry_text_color ); ?>;
		}

	<?php endif; ?>

	<?php if ( defined( 'WCEX_ORDER_LIST_WIDGET' ) ) : ?>

		.olwidget_orderdata_table tr:first-child:before,
		.olwidget_orderdata_table tr:after {
			border-color: <?php echo esc_attr( $primary_text_color ); ?>;
		}

	<?php endif; ?>

	<?php if ( defined( 'WCEX_DLSELLER' ) ) : ?>

		.dlseller th,
		.dlseller td {
			border-color: <?php echo esc_attr( $primary_table_border_color ); ?>;
		}
		.dlseller.charging th {
			background-color: <?php echo esc_attr( $primary_th_bg_color ); ?>;
			color: <?php echo esc_attr( $primary_th_text_color ); ?>;
		}

	<?php endif; ?>



</style>
	<?php
}
add_action( 'wp_footer', 'mode_customizer_footer_styles' );
