<?php

use ErNilambar\NepaliDate\NepaliDate;

date_default_timezone_set('Asia/Katmandu');



$value = array(
	'np_year'  => 0,
	'np_month' => 0,
	'np_day'   => 0,
	'en_year'  => 0,
	'en_month' => 0,
	'en_day'   => 0,
);

$today = explode('-', date('Y-m-d'));

$nd_object = new NepaliDate();

try {
	$new_date = $nd_object->ad_to_bs( $today[0], $today[1], $today[2] );

	if ( ! empty( $new_date ) ) {
		$value['np_year']  = absint( $new_date['year'] );
		$value['np_month'] = absint( $new_date['month'] );
		$value['np_day']   = absint( $new_date['day'] );
		$value['en_year']  = absint( $today[0] );
		$value['en_month'] = absint( $today[1] );
		$value['en_day']   = absint( $today[2] );
	}
}
catch( Exception $e) {
}
?>

<form method="POST" action="" class="ns-dc-form">
	<?php wp_nonce_field( 'ns_date_converter', 'ndc_nonce' ); ?>
	<div class="ns-row">
		<?php
		$args = array(
			'name' => 'np_year',
			'selected' => $value['np_year'],
		);
		?>
		<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'np' ) ); ?>
		<?php
		$args = array(
			'name' => 'np_month',
			'selected' => $value['np_month'],
		);
		?>
		<label>Month</label><?php ndc_render_select_dropdown( $args, 'ndc_get_month_options', array( 'np' ) ); ?>

		<?php
		$args = array(
			'name' => 'np_day',
			'selected' => $value['np_day'],
		);
		?>
		<label>Day</label><?php ndc_render_select_dropdown( $args, 'ndc_get_day_options', array( 'np' ) ); ?>

		<input type="submit" name="btn_cte" id="btn_cte" value="Convert to English" class="btn"/>
	</div><!-- .ns-row -->

	<div class="ns-row">
		<?php
		$args = array(
			'name' => 'en_year',
			'selected' => $value['en_year'],
		);
		?>
		<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'en' ) ); ?>
		<?php
		$args = array(
			'name' => 'en_month',
			'selected' => $value['en_month'],
		);
		?>
		<label>Month</label><?php ndc_render_select_dropdown( $args, 'ndc_get_month_options', array( 'en' ) ); ?>

		<?php
		$args = array(
			'name' => 'en_day',
			'selected' => $value['en_day'],
		);
		?>
		<label>Day</label><?php ndc_render_select_dropdown( $args, 'ndc_get_day_options', array( 'en' ) ); ?>

		<input type="submit" name="btn_ctn" id="btn_ctn" value="Convert to Nepali" class="btn"/>
	</div><!-- .ns-row -->
</form>
