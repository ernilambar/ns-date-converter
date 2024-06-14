<?php
/**
 * Plugin Name: NS Date Converter
 * Plugin URI: https://github.com/ernilambar/ns-date-converter/
 * Description: Provides shortcode for Nepali to English date converter. Shortcode: [ns_date_converter].
 * Version: 1.0.9
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * License: GPL-2.0-or-later
 * Text Domain: ns-date-converter
 * Domain Path: /languages
 * Requires PHP: 5.6
 * Requires at least: 4.9
 * Tested up to: 6.2
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NS_DATE_CONVERTER_VERSION', '1.0.9' );
define( 'NS_DATE_CONVERTER_SLUG', 'ns-date-converter' );
define( 'NS_DATE_CONVERTER_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'NS_DATE_CONVERTER_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

// Include autoload.
if ( file_exists( NS_DATE_CONVERTER_DIR . '/vendor/autoload.php' ) ) {
	require_once NS_DATE_CONVERTER_DIR . '/vendor/autoload.php';
	require_once NS_DATE_CONVERTER_DIR . '/vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';
}

if ( class_exists( 'NSDateConverter\Init' ) ) {
	\NSDateConverter\Init::register_services();
}

$nsdc_update_checker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker( 'https://github.com/ernilambar/ns-date-converter', __FILE__, NS_DATE_CONVERTER_SLUG );
$nsdc_update_checker->getVcsApi()->enableReleaseAssets();
