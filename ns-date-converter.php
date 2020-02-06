<?php
/**
 * Plugin Name: NS Date Converter
 * Plugin URI:
 * Description: Provides shortcode for Nepali-English date converter. Shortcode: [ns_date_converter].
 * Version: 1.0
 * Author: Nilambar Sharma
 * Author URI: http://nilambar.net
 * Requires at least: 4.3
 * Tested up to: 4.5
 * License: GPLv3
 * Text Domain: ns-date-converter
 */

// Define Constants.
define( 'NS_DATE_CONVERTER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NS_DATE_CONVERTER_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

// Define Other Dirs & Uris.
define( 'NS_DATE_CONVERTER_VIEWS_DIR', NS_DATE_CONVERTER_PLUGIN_DIR . 'views/' );
define( 'NS_DATE_CONVERTER_ASSETS_URI', NS_DATE_CONVERTER_PLUGIN_URI . 'assets/' );
define( 'NS_DATE_CONVERTER_ASSET_JS_URI', NS_DATE_CONVERTER_ASSETS_URI . 'js/' );
define( 'NS_DATE_CONVERTER_ASSET_CSS_URI', NS_DATE_CONVERTER_ASSETS_URI . 'css/' );
define( 'NS_DATE_CONVERTER_INC_DIR', NS_DATE_CONVERTER_PLUGIN_DIR . 'inc/' );
define( 'NS_DATE_CONVERTER_LIB_DIR', NS_DATE_CONVERTER_PLUGIN_DIR . 'lib/' );

require_once NS_DATE_CONVERTER_LIB_DIR . 'nepali_calendar.php';
require_once NS_DATE_CONVERTER_INC_DIR . 'helper-functions.php';

function ns_date_converter_shortcode_callback( $atts ) {

	ob_start();
	include NS_DATE_CONVERTER_VIEWS_DIR . 'date-converter-shortcode.php';
	$output = ob_get_contents();
	ob_end_clean();
	return $output;

}
add_shortcode( 'ns_date_converter', 'ns_date_converter_shortcode_callback' );
