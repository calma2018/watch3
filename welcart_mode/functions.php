<?php
/**
 * Welcart Mode Functions
 *
 * @link https://www.welcart.com/
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Check The Execution of Welcart
 */

if ( ! welcart_mode_is_active( 'usc-e-shop/usc-e-shop.php' ) ) {
	add_action( 'admin_notices', 'welcart_mode_echo_message' );
}

/**
 * Shows Message
 *
 * @return void
 */
function welcart_mode_echo_message() {
	echo '<div class="message error"><p>' . wp_kses_post( __( 'Welcart Mode theme requires <strong>Welcart e-Commerce</strong>. Please <a href="plugins.php">enable Welcart e-Commerce</a>.', 'welcart_mode' ) ) . '</p></div>';
}

/**
 * As Activating The Theme
 *
 * @param bool $plugin Plugin.
 * @return bool
 */
function welcart_mode_is_active( $plugin ) {
	if ( function_exists( 'is_plugin_active' ) ) {
		return is_plugin_active( $plugin );
	} else {
		return in_array(
			$plugin,
			get_option( 'active_plugins' )
		);
	}
}

/**
 * Welcart Setup
 */
if ( ! function_exists( 'welcart_mode_setup' ) ) :

	/**
	 * Setup
	 *
	 * @return void
	 */
	function mode_setup() {

		load_theme_textdomain( 'welcart_mode', get_template_directory() . '/languages' );

		/* タイトルタグ */
		add_theme_support( 'title-tag' );

		/* アイキャッチ画像 */
		add_theme_support( 'post-thumbnails' );

		/* カスタムロゴ */
		add_theme_support(
			'custom-logo',
			array(
				'width'       => 240,
				'height'      => 100,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/* カスタムメニュー */
		register_nav_menus(
			array(
				'global-menu' => __( 'Global Navigation', 'welcart_mode' ),
				'sub-menu'    => __( 'Header Navigation', 'welcart_mode' ),
				'footer-menu' => __( 'Footer Navigation', 'welcart_mode' ),
			)
		);

		add_theme_support(
			'custom-header',
			apply_filters(
				'mode_custom_header_args',
				array(
					'default-image' => get_template_directory_uri() . '/assets/images/image-top.png',
					'width'         => '1120',
					'height'        => '1120',
					'flex-width'    => true,
					'flex-height'   => true,
					'header-text'   => false,
				)
			)
		);
		register_default_headers(
			array(
				'mode-default' => array(
					'url'           => '%s/assets/images/image-top.png',
					'thumbnail_url' => '%s/assets/images/image-top.png',
				),
			)
		);

		/* アイキャッチ画像のサイズ追加 */
		add_image_size( 'img300x200', 300, 200, true );

		/* テーマカスタマイザーにおけるウィジェットの再読み込み */
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'mode_setup' );

if ( ! defined( 'USCES_VERSION' ) ) {
	return;
}

/**
 * Body Open
 */
if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Body Open
	 *
	 * @return void
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include files required
 */
require dirname( __FILE__ ) . '/inc/customizer/custom-controls.php';
require get_template_directory() . '/inc/load.php';

/**
 * Pre Get Posts
 *
 * @param object $query Query.
 * @return void
 */
function mode_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_search && ! isset( $_GET['searchitem'] ) ) {
		$query->set( 'category_name', 'item' );
	}
}
add_filter( 'pre_get_posts', 'mode_query' );

/**
 * Admin Enqueue Scripts
 *
 * @param string $hook Hook.
 * @return void
 */
function mode_admin_enqueue( $hook ) {
	if ( 'welcart-shop_page_usces_itemedit' === $hook || 'widgets.php' === $hook || 'post.php' === $hook || ( 'term.php' === $hook || 'edit-tags.php' === $hook ) && ( 'category' === get_current_screen()->taxonomy || 'model' === get_current_screen()->taxonomy || 'brand' === get_current_screen()->taxonomy || 'features_cat' === get_current_screen()->taxonomy ) ) {
		wp_enqueue_style( 'mode_admin_style', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0' );
	}
	if ( ( 'term.php' === $hook || 'edit-tags.php' === $hook ) && ( 'category' === get_current_screen()->taxonomy || 'model' === get_current_screen()->taxonomy || 'brand' === get_current_screen()->taxonomy ) ) {
		wp_enqueue_media();
	}

}
add_action( 'admin_enqueue_scripts', 'mode_admin_enqueue' );

/**
 * Remove Welcart's CSS
 *
 * @return void
 */
function welcart_mode_remove_usces_cart_css() {
	global $usces;
	$usces->options['system']['no_cart_css'] = 1;
}
add_action( 'wp_enqueue_scripts', 'welcart_mode_remove_usces_cart_css', 8 );


/**
 * Enqueue Scripts
 */
if ( ! function_exists( 'mode_scripts_styles' ) ) {
	/**
	 * Adds Enqueue Scripts
	 *
	 * @return void
	 */
	function mode_scripts_styles() {
		global $usces, $is_IE;

		$template_dir   = get_template_directory_uri();
		$stylesheet_dir = get_stylesheet_uri();

		/* extension class CSS */
		wp_enqueue_style( 'mode-extension-class-css', get_theme_file_uri( '/assets/css/extension-class.css' ), array(), '1.0' );

		/* google fonts */
		wp_enqueue_style( 'google-fonts-sans', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700;900&family=Raleway:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap', array(), '1.0.0' );

		/*  Reset CSS */
		wp_enqueue_style( 'reset-style', get_theme_file_uri( '/assets/css/reset.css' ), array(), '1.0' );

		/*  Icon Font CSS */
		wp_enqueue_style( 'mode-font-css', get_theme_file_uri( '/assets/css/welfont.css' ), array(), '1.0' );

		/*  Style CSS */
		wp_enqueue_style( 'mode-style', $stylesheet_dir, array(), '1.0' );

		/*  Item Image Square CSS */
		if ( true === mode_get_options( 'image_square' ) ) {
			wp_enqueue_style( 'item-img-square-css', $template_dir . '/assets/css/item-img-square.css', array(), '1.0' );
		}

		if ( is_home() || is_front_page() ) {
			wp_enqueue_style( 'home-style', get_theme_file_uri( '/assets/css/front-page.css' ), array(), '1.0' );
		}

		/*  Common */
		wp_enqueue_script( 'mode-common', get_theme_file_uri( '/assets/js/common.js' ), array(), '1.0', true );

		/* Loading WCEX Widget Cart Style on 404 */
		wp_enqueue_style( 'wcex_widgetcart_style', $template_dir . '/wcex_widget_cart.css', array( 'usces_default_css' ), '1.0' );

		/*  Slick */
		wp_enqueue_style( 'slick-style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.0' );
		wp_enqueue_style( 'slick-css', get_theme_file_uri( '/assets/css/slick.css' ), array(), '1.0' );
		wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.0', true );
		wp_enqueue_script( 'action-slick', get_theme_file_uri( '/assets/js/action-slick.js' ), array(), '1.0', true );

		if ( is_home() || is_front_page() ) {
			if ( true === mode_get_options( 'display_widget_slide' ) ) {
				if ( true === mode_get_options( 'item_widget_slide_mobile' ) ) {
					if ( wp_is_mobile() ) {
						wp_enqueue_script( 'action-home-mobile', get_theme_file_uri( '/assets/js/home/action-mobile.js' ), array(), '1.0', true );
					}
				} else {
					wp_enqueue_script( 'action-home', get_theme_file_uri( '/assets/js/home/action-common.js' ), array(), '1.0', true );
				}
			}
		}

		/*  Luminous */
		if ( ! ( wp_is_mobile() && is_single() && usces_is_item() ) ) {
			wp_enqueue_style( 'luminous-basic-css', get_theme_file_uri( '/assets/vendor/luminous/luminous-basic.css' ), array(), '1.0' );
			wp_enqueue_script( 'luminous', get_theme_file_uri( '/assets/vendor/luminous/luminous.min.js' ), array(), '1.0', true );
			wp_enqueue_script( 'action-luminous', get_theme_file_uri( '/assets/js/action-luminous.js' ), array(), '1.0', true );
		}

		/*  Header */
		wp_enqueue_script( 'mode-menu-drawer', get_theme_file_uri( '/assets/js/header/menu-drawer.js' ), array(), '1.0', true );

		if ( 'tab-menu' === mode_get_options( 'menu_display_method' ) ) {

			wp_enqueue_script( 'mode-menu-tabs', get_theme_file_uri( '/assets/js/header/menu-tabs.js' ), array(), '1.0', true );

		} else {

			wp_enqueue_script( 'mode-menu-default', get_theme_file_uri( '/assets/js/header/menu-default.js' ), array(), '1.0', true );

		}

		/*
		 * Item Single Page
		 */
		if ( is_single() && usces_is_item() ) {

			wp_enqueue_script( 'mode-item-single', get_theme_file_uri( '/assets/js/item-single.js' ), array(), '1.0', true );

		}

		/*
		 * Cart Page
		 */
		if ( welcart_mode_is_cart_page() || welcart_mode_is_member_page() ) {

			wp_enqueue_script( 'mode-cart-member', get_theme_file_uri( '/assets/js/cart-member.js' ), array(), '1.0', true );

		}

	}
}
add_action( 'wp_enqueue_scripts', 'mode_scripts_styles' );


/**
 * Inclueds Footer Styles
 */
if ( ! function_exists( 'mode_footer_styles' ) ) {

	/**
	 * Footer Styles
	 *
	 * @return void
	 */
	function mode_footer_styles() {
		global $usces, $is_IE;
		$is_secondary = welcart_mode_secondary();

		/* extension class CSS */
		wp_enqueue_style( 'secondary-style', get_theme_file_uri( '/assets/css/secondary.css' ), array(), '1.0' );

		if ( is_category() ) {
			wp_enqueue_style( 'category-style', get_theme_file_uri( '/assets/css/category.css' ), array(), '1.0' );
		}
		if ( is_post_type_archive( 'features' ) || is_tax( 'features_cat' ) ) {
			wp_enqueue_style( 'features-style', get_theme_file_uri( '/assets/css/features.css' ), array(), '1.0' );
		}
		if ( is_post_type_archive( 'coordinates' ) || is_singular( 'coordinates' ) ) {
			wp_enqueue_style( 'coordinates-style', get_theme_file_uri( '/assets/css/coordinates.css' ), array(), '1.1' );
		}
		if ( ! ( welcart_mode_is_cart_page() || welcart_mode_is_member_page() ) ) {
			if ( is_singular() ) {
				wp_enqueue_style( 'singular-style', get_theme_file_uri( '/assets/css/singular.css' ), array(), '1.0' );
			}
		}
		if ( is_404() ) {
			wp_enqueue_style( '404-style', get_theme_file_uri( '/assets/css/404.css' ), array(), '1.0' );
		}

		if ( is_page_template( 'page-templates/brand.php' ) || is_tax( 'brand' ) ) {
			wp_enqueue_style( 'brand-style', get_theme_file_uri( '/assets/css/brand.css' ), array(), '1.0' );
		}

		if ( is_singular( 'post' ) && usces_is_item() ) {
			wp_enqueue_style( 'item-style', get_theme_file_uri( '/assets/css/item.css' ), array(), '1.0' );
		}

		if ( is_user_logged_in() ) {
			wp_enqueue_style( 'logged-in-style', get_theme_file_uri( '/assets/css/logged-in.css' ), array(), '1.0' );
		}

	}
}
add_action( 'wp_footer', 'mode_footer_styles' );

/**
 * Scripts Loader Tag
 *
 * @param string $tag Tag.
 * @param string $handle Handle.
 * @return string
 */
function mode_defer( $tag, $handle ) {

	if ( 'mode-menu-drawer' === $handle || 'mode-menu-tabs' === $handle ) {

		return str_replace( ' src=', ' defer src=', $tag );

	}

	return $tag;

}
add_filter( 'script_loader_tag', 'mode_defer', 10, 2 );

/**
 * Widgets Init
 *
 * @return void
 */
function mode_widgets_init() {

	/* 商品一覧ウィジェット */
	require get_template_directory() . '/widgets/item-list.php';
	register_widget( 'mode_item_list' );

	register_sidebar(
		array(
			'name'          => __( 'Home Area1', 'welcart_mode' ),
			'id'            => 'home-widgetarea1',
			'description'   => __( 'bottom of key visual image', 'welcart_mode' ),
			'before_widget' => '<section id="%1$s" class="section-home widget %2$s"><div class="column1120">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h1 class="widget_title">',
			'after_title'   => '</h1>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home Area2', 'welcart_mode' ),
			'id'            => 'home-widgetarea2',
			'description'   => __( 'bottom of features list', 'welcart_mode' ),
			'before_widget' => '<section id="%1$s" class="section-home widget %2$s"><div class="column1120">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h1 class="widget_title">',
			'after_title'   => '</h1>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home Area3', 'welcart_mode' ),
			'id'            => 'home-widgetarea3',
			'description'   => __( 'bottom of coordinate list', 'welcart_mode' ),
			'before_widget' => '<section id="%1$s" class="section-home widget %2$s"><div class="column1120">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h1 class="widget_title">',
			'after_title'   => '</h1>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home Area4', 'welcart_mode' ),
			'id'            => 'home-widgetarea4',
			'description'   => __( 'bottom of brand list', 'welcart_mode' ),
			'before_widget' => '<section id="%1$s" class="section-home widget %2$s"><div class="column1120">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h1 class="widget_title">',
			'after_title'   => '</h1>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home Area5', 'welcart_mode' ),
			'id'            => 'home-widgetarea5',
			'description'   => __( 'bottom of post list', 'welcart_mode' ),
			'before_widget' => '<section id="%1$s" class="section-home widget %2$s"><div class="column1120">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h1 class="widget_title">',
			'after_title'   => '</h1>',
		)
	);
	/* ホームサイドバー */
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Widget1', 'welcart_mode' ),
			'id'            => 'secondary-widget-area1',
			'description'   => apply_filters( 'welcart_mode_secondary_widgetarea1_description', __( 'Top page only', 'welcart_mode' ) ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget_title">',
			'after_title'   => '</div>',
		)
	);
	/* 商品・検索結果・ブランド・コーディネート */
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Widget2', 'welcart_mode' ),
			'id'            => 'secondary-widget-area2',
			'description'   => apply_filters( 'welcart_mode_secondary_widgetarea2_description', __( 'Widget area for ​​product page or brand page or coordination page or feature page or search page', 'welcart_mode' ) ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget_title">',
			'after_title'   => '</div>',
		)
	);
	/* その他 */
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Widget3', 'welcart_mode' ),
			'id'            => 'secondary-widget-area3',
			'description'   => apply_filters( 'welcart_mode_secondary_widgetarea3_description', __( 'Widget area for page or post', 'welcart_mode' ) ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget_title">',
			'after_title'   => '</div>',
		)
	);

}
add_action( 'widgets_init', 'mode_widgets_init' );

/**
 * Excerpt & More
 *
 * @param bool $more More.
 * @return string
 */
function mode_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'mode_excerpt_more' );

/**
 * Pre Get Posts
 *
 * @param object $query Query.
 * @return void
 */
function welcart_mode_query( $query ) {
	$item_cat    = get_category_by_slug( 'item' );
	$item_cat_id = $item_cat->cat_ID;
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_search && ! isset( $_GET['searchitem'] ) ) {
		$query->set( 'category_name', 'item' );
	}
}
add_action( 'pre_get_posts', 'welcart_mode_query' );

/**
 * Search Form
 *
 * @param string $form Form.
 * @return string
 */
function welcart_mode_search_form( $form ) {

	$form = '<form role="search" method="get" action="' . home_url( '/' ) . '" >
		<div class="search-box">
			<input type="text" value="' . get_search_query() . '" name="s" id="s-text" class="search-text" />
			<input type="submit" id="s-submit" class="searchsubmit" value="&#xe905" />
		</div>
	</form>';
	return $form;
}
add_filter( 'get_search_form', 'welcart_mode_search_form' );

/**
 * Shows The Coordinate Title
 *
 * @param string $title Title.
 * @return string
 */
function mode_coordinate_title_output( $title ) {
	if ( is_post_type_archive( 'coordinates' ) ) {

		if ( ! empty( mode_get_options( 'coordinates_headline' ) ) ) {
			$headline_text = mode_get_options( 'coordinates_headline' );
		} else {
			$headline_text = __( 'Coordinates', 'welcart_mode' );
		}

		$newtitle       = str_replace( __( 'Coordinates', 'welcart_mode' ), $headline_text, $title['title'] );
		$title['title'] = $newtitle;

		return $title;
	}
	return $title;
}
add_filter( 'document_title_parts', 'mode_coordinate_title_output' );
