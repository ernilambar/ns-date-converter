<?php

add_action( 'rest_api_init', function () {
  register_rest_route( 'nsdc/v1', '/convert/(?P<to>\w+)', array(
	'methods'  => 'GET',
	'callback' => 'ns_date_converter_api_callback',
	'args'     => array(
		'to' => array(
			'required' => true,
			'validate_callback' => function( $param, $request, $key ) {
				return in_array( $param, array( 'en', 'np' ), true );
			}
		),
		'date' => array(
			'required' => true,
			'validate_callback' => function( $param, $request, $key ) {
				return (bool)preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$param);
			}
		),
	),
  ) );
} );


function ns_date_converter_api_callback( WP_REST_Request $request ) {
	$to   = $request->get_param( 'to' );
	$date = $request->get_param( 'date' );

	// if ( ! in_array( $to, array( 'en', 'np' ), true ) ) {
	// 	return new WP_Error( 'invalid_target', esc_html( 'Invalid target' ), array('status' => 404) );
	// }

	$output = array(
		'type' => esc_html( $to ),
	);

	$cal = new Nepali_Calendar();

	list( $year, $month, $day ) = explode( '-', $date );

	var_dump( $year );
	var_dump( $month );
	var_dump( $day );

	switch ( $to ) {
		case 'en':
			if ( crossCheck( $year, $month, $day ) ) {
				$new_date = $cal->nep_to_eng( $year, $month, $day );
			}
			$output['year']       = $new_date['year'];
			$output['month']      = $new_date['month'];
			$output['month_text'] = $new_date['emonth'];
			$output['day']        = $new_date['date'];
			$output['day_text']   = $new_date['day'];
			$output['day_number'] = $new_date['num_day'];
			break;

		default:
			# code...
			break;
	}

				// print_r( $output );


	$response = new WP_REST_Response( $output );

	$response->set_status( 200 );

	return $response;
}
