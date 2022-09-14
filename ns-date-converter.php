<?php
/**
 * Plugin Name: NS Date Converter
 * Plugin URI: https://github.com/ernilambar/ns-date-converter/
 * Description: Provides shortcode for Nepali to English date converter. Shortcode: [ns_date_converter].
 * Version: 1.0.5
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * License: GPL-2.0-or-later
 * Text Domain: ns-date-converter
 *
 * @package NS_Date_Converter
 */

// Define.
define( 'NS_DATE_CONVERTER_VERSION', '1.0.5' );
define( 'NS_DATE_CONVERTER_DIR', plugin_dir_path( __FILE__ ) );
define( 'NS_DATE_CONVERTER_URI', plugin_dir_url( __FILE__ ) );

require_once NS_DATE_CONVERTER_DIR . '/vendor/autoload.php';
require_once NS_DATE_CONVERTER_DIR . '/inc/helpers.php';

/**
 * Register shortcode.
 *
 * @since 1.0.0
 *
 * @return string Shortcode output.
 */
function ns_date_converter_shortcode_callback() {
	ob_start();

	include NS_DATE_CONVERTER_DIR . '/inc/shortcode.php';

	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

add_shortcode( 'ns_date_converter', 'ns_date_converter_shortcode_callback' );
