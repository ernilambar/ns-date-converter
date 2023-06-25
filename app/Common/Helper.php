<?php
/**
 * Helper
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter\Common;

/**
 * Helper class.
 *
 * @since 1.0.0
 */
class Helper {

	/**
	 * Return year options.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return array Options.
	 */
	public static function get_year_options( $type = 'en' ) {
		$start = ( 'np' === $type ) ? 2000 : 1944;
		$end   = ( 'np' === $type ) ? 2089 : 2033;

		$output = array();

		for ( $year = $start; $year <= $end; $year++ ) {
			$output[ $year ] = $year;
		}

		return $output;
	}

	/**
	 * Return month options.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return array Options.
	 */
	public static function get_month_options( $type = 'en' ) {
		$months_np = array( 'Baishakh', 'Jeth', 'Ashar', 'Shrawan', 'Bhadra', 'Ashoj', 'Kartik', 'Mangshir', 'Poush', 'Magh', 'Falgun', 'Chaitra' );
		$months_en = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );

		$list = ( 'en' === $type ) ? $months_en : $months_np;

		$output = array();

		for ( $i = 1; $i <= 12; $i++ ) {
			$output[ $i ] = $i . ' - ' . $list[ $i - 1 ];
		}

		return $output;
	}

	/**
	 * Return day options.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return array Options.
	 */
	public static function get_day_options( $type = 'en' ) {
		$max = ( 'en' === $type ) ? 31 : 32;

		$output = array();

		for ( $i = 1; $i <= $max; $i++ ) {
			$output[ $i ] = $i;
		}

		return $output;
	}


	/**
	 * Render select dropdown.
	 *
	 * @since 0.1
	 *
	 * @param array  $main_args     Main arguments.
	 * @param string $callback      Callback method.
	 * @param array  $callback_args Callback arguments.
	 * @return string Rendered markup.
	 */
	public static function render_select_dropdown( $main_args, $callback, $callback_args = array() ) {
		$defaults = array(
			'id'       => '',
			'name'     => '',
			'selected' => 0,
			'echo'     => true,
		);

		$r = wp_parse_args( $main_args, $defaults );

		$output = '';

		$choices = array();

		if ( is_callable( $callback ) ) {
			$choices = call_user_func_array( $callback, $callback_args );
		}

		if ( ! empty( $choices ) ) {
			$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";

			if ( ! empty( $choices ) ) {
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>';
				}
			}
			$output .= '</select>';
		}

		if ( $r['echo'] ) {
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $output;
	}
}
