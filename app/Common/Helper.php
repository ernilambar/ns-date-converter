<?php
/**
 * Helper
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter\Common;

use Nilambar\NepaliDate\NepaliDate;

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

	public static function get_today_dates() {
		$output = array();

		$today = explode( '-', gmdate( 'Y-m-d' ) );

		$nd_object = new NepaliDate();

		$new_date = $nd_object->convertAdToBs( $today[0], $today[1], $today[2] );

		if ( is_array( $new_date ) && ! empty( $new_date ) ) {
			$output['np'] = array(
				'year'  => absint( $new_date['year'] ),
				'month' => absint( $new_date['month'] ),
				'day'   => absint( $new_date['day'] ),
			);

			$output['en'] = array(
				'year'  => absint( $today[0] ),
				'month' => absint( $today[1] ),
				'day'   => absint( $today[2] ),
			);
		}

		return $output;
	}

	public static function get_converted_data( $to, $date ) {
		$output = array();

		$dt = explode( '-', $date );

		$nd_object = new NepaliDate();

		if ( 'np' === $to ) {
			$new_date = $nd_object->convertAdToBs( $dt[0], $dt[1], $dt[2] );

			if ( is_array( $new_date ) && ! empty( $new_date ) ) {
				$details_np = $nd_object->getDetails( $new_date['year'], $new_date['month'], $new_date['day'], 'bs' );

				$output['np'] = array(
					'year'      => absint( $new_date['year'] ),
					'month'     => absint( $new_date['month'] ),
					'day'       => absint( $new_date['day'] ),
					'formatted' => $nd_object->getFormattedDate( $details_np, 'Y F j, l' ),
				);

				$output['en'] = array(
					'year'      => absint( $dt[0] ),
					'month'     => absint( $dt[1] ),
					'day'       => absint( $dt[2] ),
					'formatted' => gmdate( 'Y F j, l', strtotime( $dt[0] . '-' . $dt[1] . '-' . $dt[2] ) ),
				);
			}
		} elseif ( 'en' === $to ) {
			$new_date = $nd_object->convertBsToAd( $dt[0], $dt[1], $dt[2] );

			if ( is_array( $new_date ) && ! empty( $new_date ) ) {
				$details_np = $nd_object->getDetails( $dt[0], $dt[1], $dt[2], 'bs' );

				$output['en'] = array(
					'year'      => absint( $new_date['year'] ),
					'month'     => absint( $new_date['month'] ),
					'day'       => absint( $new_date['day'] ),
					'formatted' => gmdate( 'Y F j, l', strtotime( $new_date['year'] . '-' . $new_date['month'] . '-' . $new_date['day'] ) ),
				);

				$output['np'] = array(
					'year'      => absint( $dt[0] ),
					'month'     => absint( $dt[1] ),
					'day'       => absint( $dt[2] ),
					'formatted' => $nd_object->getFormattedDate( $details_np, 'Y F j, l' ),
				);
			}
		}

		return $output;
	}
}
