<?php
/**
 * Core
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter\Core;

use NSDateConverter\Common\Helper;

/**
 * Core class.
 *
 * @since 1.0.0
 */
class Core {

	/**
	 * Register.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
		add_action( 'wp_ajax_nopriv_nsdc_get_date', array( $this, 'get_converted_date_ajax_callback' ) );
		add_action( 'wp_ajax_nsdc_get_date', array( $this, 'get_converted_date_ajax_callback' ) );
	}

	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'ns-date-converter' );
	}

	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	public function load_assets() {
		$deps_file = NS_DATE_CONVERTER_DIR . '/build/index.asset.php';

		$dependency = array();

		if ( file_exists( $deps_file ) ) {
			$deps_file  = require $deps_file;
			$dependency = $deps_file['dependencies'];
			$version    = $deps_file['version'];
		}

		$data = array(
			'ajax_url'    => admin_url( 'admin-ajax.php' ),
			'date_action' => 'nsdc_get_date',
			'today'       => Helper::get_today_dates(),
			'years_np'    => Helper::get_year_options( 'np' ),
			'years_en'    => Helper::get_year_options( 'en' ),
			'months_np'   => Helper::get_month_options( 'np' ),
			'months_en'   => Helper::get_month_options( 'en' ),
			'days_np'     => Helper::get_day_options( 'np' ),
			'days_en'     => Helper::get_day_options( 'en' ),
		);

		wp_enqueue_style( 'ns-date-converter-app', NS_DATE_CONVERTER_URL . '/build/index.css', array(), $version );
		wp_enqueue_script( 'ns-date-converter-app', NS_DATE_CONVERTER_URL . '/build/index.js', $dependency, $version, true );
		wp_localize_script( 'ns-date-converter-app', 'NSDC_APP', $data );
	}

	/**
	 * AJAX callback for converted date.
	 *
	 * @since 1.0.0
	 */
	public function get_converted_date_ajax_callback() {
		$output = array();

		$to    = ( isset( $_POST['to'] ) && 0 !== strlen( $_POST['to'] ) ) ? sanitize_text_field( $_POST['to'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$year  = ( isset( $_POST['year'] ) && 0 !== absint( $_POST['year'] ) ) ? absint( $_POST['year'] ) : '';
		$month = ( isset( $_POST['month'] ) && 0 !== absint( $_POST['month'] ) ) ? absint( $_POST['month'] ) : '';
		$day   = ( isset( $_POST['day'] ) && 0 !== absint( $_POST['day'] ) ) ? absint( $_POST['day'] ) : '';

		$date = array( $year, $month, $day );

		$output = Helper::get_converted_date( $to, implode( '-', $date ) );

		if ( ! empty( $output ) ) {
			wp_send_json_success( $output, 200 );
		} else {
			wp_send_json_error( $output, 500 );
		}
	}
}
