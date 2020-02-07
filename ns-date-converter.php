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

	// Months English.
	$months_en = array(
		'1'  => esc_html__( 'January' ),
		'2'  => esc_html__( 'February' ),
		'3'  => esc_html__( 'March' ),
		'4'  => esc_html__( 'April' ),
		'5'  => esc_html__( 'May' ),
		'6'  => esc_html__( 'June' ),
		'7'  => esc_html__( 'July' ),
		'8'  => esc_html__( 'August' ),
		'9'  => esc_html__( 'September' ),
		'10' => esc_html__( 'October' ),
		'11' => esc_html__( 'November' ),
		'12' => esc_html__( 'December' ),
	);

	// Months Nepali.
	$months_np = array(
		'1'  => esc_html__( 'Baisakh' ),
		'2'  => esc_html__( 'Jeth' ),
		'3'  => esc_html__( 'Ashar' ),
		'4'  => esc_html__( 'Shrawan' ),
		'5'  => esc_html__( 'Bhadra' ),
		'6'  => esc_html__( 'Asoj' ),
		'7'  => esc_html__( 'Kartik' ),
		'8'  => esc_html__( 'Mangsir' ),
		'9'  => esc_html__( 'Poush' ),
		'10' => esc_html__( 'Magh' ),
		'11' => esc_html__( 'Falgun' ),
		'12' => esc_html__( 'Chaitra' ),
	);

	// Days Nepali.
	$days_np    = array();
	$day_max_np = 32;

	for ($i = 1; $i <= $day_max_np; $i++) {
		$days_np[ $i ] = $i;
	}

	// Days English.
	$days_en    = array();
	$day_max_en = 31;

	for ($i = 1; $i <= $day_max_en; $i++) {
		$days_en[ $i ] = $i;
	}

	// Years Nepali.
	$years_np       = array();
	$years_np_start = 2000;
	$years_np_npd   = 2089;

	for ($i = $years_np_start; $i <= $years_np_npd; $i++) {
		$years_np[ $i ] = $i;
	}


	// Years English.
	$years_en       = array();
	$years_en_start = 1944;
	$years_en_end   = 2033;

	for ($i = $years_en_start; $i <= $years_en_end; $i++) {
		$years_en[ $i ] = $i;
	}

	wp_localize_script(
		'ns-date-converter-main',
		'nsDateConverter',
		array (
			'url'         => home_url( '/' ),
			'api_url'     => home_url( '/wp-json/nsdc/v1/' ),
			'nonce'       => wp_create_nonce( 'wp_rest' ),
			'months_np'   => $months_np,
			'months_en'   => $months_en,
			'days_np'     => $days_np,
			'days_en'     => $days_en,
			'years_np'    => $years_np,
			'years_en'    => $years_en,
			'today_year'  => date('Y'),
			'today_month' => date('m'),
			'today_day'   => date('d'),
		)
	);

}

add_action( 'wp_enqueue_scripts', 'weather_info_enqueue' );
