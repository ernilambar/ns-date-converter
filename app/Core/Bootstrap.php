<?php
/**
 * Bootstrap
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter\Core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bootstrap class.
 *
 * @since 2.0.0
 */
final class Bootstrap {

	/**
	 * Register all plugin services.
	 *
	 * @since 2.0.0
	 */
	public static function register_services(): void {
		add_action( 'plugins_loaded', array( __CLASS__, 'load_textdomain' ) );
		add_shortcode( 'ns_date_converter', array( __CLASS__, 'shortcode_callback' ) );
	}

	/**
	 * Load plugin textdomain.
	 *
	 * @since 2.0.0
	 */
	public static function load_textdomain(): void {
		load_plugin_textdomain( 'ns-date-converter' );
	}

	/**
	 * Shortcode callback.
	 *
	 * @since 1.0.0
	 *
	 * @return string Shortcode output.
	 */
	public static function shortcode_callback(): string {
		ob_start();

		require NS_DATE_CONVERTER_DIR . '/templates/converter.php';

		return ob_get_clean();
	}
}
