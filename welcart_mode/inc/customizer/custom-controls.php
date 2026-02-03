<?php
/**
 * Customizer - Custom Controls Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * 1. Customizer Panels & Sections
 * 2. Custom Option Editing Shortcuts
 * 3. Custom Functions
 * 4. Define Options
 * 5. Custom Styles
 * 6. Custom Scripts
 */

/**
 * 1. customizer panels & sections
 */

$welcart_mode_panels = array( 'title-tagline', 'nav-menus', 'colors', 'theme-option', 'custom-header' );

foreach ( $welcart_mode_panels as $panel ) {
	require get_template_directory() . '/inc/customizer/panels/' . $panel . '.php';
}

/**
 * 2. Custom Option Editing Shortcuts
 */

require get_template_directory() . '/inc/customizer/custom-shortycuts.php';

/**
 * 3. Customizer Custom Functions
 */

require get_template_directory() . '/inc/customizer/custom-functions.php';

/**
 * 4. Customizer Define Option
 */

require get_template_directory() . '/inc/customizer/define-options.php';

/**
 * 5. Customizer Custom Styles
 */

require get_template_directory() . '/inc/customizer/custom-styles.php';

/**
 * 6. Customizer Custom Scripts
 */

require get_template_directory() . '/inc/customizer/custom-scripts.php';
