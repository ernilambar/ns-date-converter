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
require_once NS_DATE_CONVERTER_INC_DIR . 'api.php';

function ns_date_converter_shortcode_callback( $atts ) {
	?>
	<div id="ns-date-converter-app"></div>
	<?php
}
add_shortcode( 'ns_date_converter', 'ns_date_converter_shortcode_callback' );

function weather_info_enqueue() {
	wp_enqueue_script(
		'ns-date-converter-main',
		NS_DATE_CONVERTER_PLUGIN_URI . '/build/index.js',
		['wp-element'],
		time(),
		true
	);

	wp_localize_script(
		'ns-date-converter-main',
		'nsDateConverter',
		array (
			'url'     => home_url( '/' ),
			'api_url' => home_url( '/wp-json/nsdc/v1/' ),
			'nonce'   => wp_create_nonce( 'wp_rest' ),
		)
	);

}

add_action( 'wp_enqueue_scripts', 'weather_info_enqueue' );
