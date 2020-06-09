<?php
/**
 * Plugin Name: NS Date Converter
 * Plugin URI: https://github.com/ernilambar/ns-date-converter
 * Description: Provides shortcode for Nepali to English date converter. Shortcode: [ns_date_converter].
 * Version: 1.0.1
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net
 * GitHub Plugin URI: ernilambar/ns-date-converter
 * License: GPLv3
 * Text Domain: ns-date-converter
 */

// Define.
define( 'NS_DATE_CONVERTER_DIR', plugin_dir_path( __FILE__ ) );
define( 'NS_DATE_CONVERTER_URI', plugin_dir_url( __FILE__ ) );

require_once NS_DATE_CONVERTER_DIR . '/inc/helpers.php';

function ns_date_converter_shortcode_callback( $atts ) {
	ob_start();
	?>
	<div id="ns-date-converter-app">shortcode</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

add_shortcode( 'ns_date_converter', 'ns_date_converter_shortcode_callback' );
