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
 * GitHub Plugin URI: ernilambar/ns-date-converter
 * Primary Branch: main
 * Release Asset: true
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NS_DATE_CONVERTER_VERSION', '1.0.5' );
define( 'NS_DATE_CONVERTER_DIR', plugin_dir_path( __FILE__ ) );
define( 'NS_DATE_CONVERTER_URI', plugin_dir_url( __FILE__ ) );

// Include autoload.
if ( file_exists( NS_DATE_CONVERTER_DIR . '/vendor/autoload.php' ) ) {
	require_once NS_DATE_CONVERTER_DIR . '/vendor/autoload.php';
}

if ( class_exists( 'NSDateConverter\Init' ) ) {
	\NSDateConverter\Init::register_services();
}
