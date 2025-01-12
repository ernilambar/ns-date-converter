<?php
/**
 * Shortcode
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter\Core;

/**
 * Shortcode class.
 *
 * @since 1.0.0
 */
class Shortcode {

	/**
	 * Register.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_shortcode( 'ns_date_converter', array( $this, 'shortcode_callback' ) );
	}

	/**
	 * Shortcode callback.
	 *
	 * @since 1.0.0
	 *
	 * @return string Shortcode output.
	 */
	public function shortcode_callback() {
		ob_start();

		require NS_DATE_CONVERTER_DIR . '/templates/converter.php';

		return ob_get_clean();
	}
}
