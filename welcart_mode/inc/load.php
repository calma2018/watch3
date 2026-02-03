<?php
/**
 * Loader
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

require get_template_directory() . '/inc/create-post-type.php';

require get_template_directory() . '/inc/create-taxonomies.php';

require get_template_directory() . '/inc/term-customized.php';

require get_template_directory() . '/inc/template-functions.php';

if ( is_customize_preview() ) {
	require get_template_directory() . '/inc/customizer/multiple-checkbox-control.php';
}

require get_template_directory() . '/inc/welcart/customized.php';
require get_template_directory() . '/inc/welcart/shortcode.php';

require get_template_directory() . '/inc/welcart/widget-cart.php';

require __DIR__ . '/coordinates/init.php';
