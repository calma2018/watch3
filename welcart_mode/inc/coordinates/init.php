<?php
/**
 * Coordinates Init
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

use Welcart\Themes\Mode\Coordinates\Master;

define( 'MODE_COORDINATES_URL', get_template_directory_uri() . '/inc/coordinates' );

$theme = wp_get_theme();
define( 'MODE_VERSION', $theme->get( 'Version' ) );

/* project files */
require_once __DIR__ . '/src/Master.php';

( new Master() )->init();
