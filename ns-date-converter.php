<?php
/**
 * Plugin Name: NS Date Converter
 * Plugin URI: https://github.com/ernilambar/ns-date-converter/
 * Description: Provides shortcode for Nepali to English date converter.
 * Version: 2.0.0
 * Requires at least: 7.0
 * Requires PHP: 8.2
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * License: GPL-2.0-or-later
 * Text Domain: ns-date-converter
 * Domain Path: /languages
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter;

use Nilambar\Gitvise\Updater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NS_DATE_CONVERTER_VERSION', '2.0.0' );
define( 'NS_DATE_CONVERTER_SLUG', 'ns-date-converter' );
define( 'NS_DATE_CONVERTER_BASE_FILEPATH', __FILE__ );
define( 'NS_DATE_CONVERTER_BASE_FILENAME', plugin_basename( __FILE__ ) );
define( 'NS_DATE_CONVERTER_DIR', plugin_dir_path( __FILE__ ) );
define( 'NS_DATE_CONVERTER_URL', plugin_dir_url( __FILE__ ) );

// Include autoload.
if ( file_exists( NS_DATE_CONVERTER_DIR . 'vendor/autoload.php' ) ) {
	require_once NS_DATE_CONVERTER_DIR . 'vendor/autoload.php';
	require_once NS_DATE_CONVERTER_DIR . 'vendor/ernilambar/gitvise/init.php';
}

if ( class_exists( 'NSDateConverter\Core\Bootstrap' ) ) {
	( new Core\Bootstrap() )->init();
}

// Initialize updater.
( new Updater( 'ernilambar/ns-date-converter', NS_DATE_CONVERTER_BASE_FILEPATH ) )->init();
