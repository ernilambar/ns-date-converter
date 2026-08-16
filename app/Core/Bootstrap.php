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
	 * Initializes the plugin.
	 *
	 * @since 2.0.0
	 */
	public function init(): void {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_shortcode( 'ns_date_converter', array( $this, 'shortcode_callback' ) );
	}

	/**
	 * Load plugin textdomain.
	 *
	 * @since 2.0.0
	 */
	public function load_textdomain(): void {
		load_plugin_textdomain( 'ns-date-converter', false, dirname( NS_DATE_CONVERTER_BASE_FILENAME ) . '/languages' );
	}

	/**
	 * Shortcode callback.
	 *
	 * @since 2.0.0
	 *
	 * @return string Shortcode output.
	 */
	public function shortcode_callback(): string {
		ob_start();

		require NS_DATE_CONVERTER_DIR . 'templates/converter.php';

		return ob_get_clean();
	}
}
