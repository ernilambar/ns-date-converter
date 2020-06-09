<?php

use ErNilambar\NepaliDate\NepaliDate;

date_default_timezone_set( 'Asia/Katmandu' );

$nd_object = new NepaliDate();

$value = array(
	'np_year'  => 0,
	'np_month' => 0,
	'np_day'   => 0,
	'en_year'  => 0,
	'en_month' => 0,
	'en_day'   => 0,
);

if ( isset( $_POST['frm_submitted'] ) && 1 === absint( $_POST['frm_submitted'] ) ) {
	// Form is submitted.
	if ( wp_verify_nonce( $_POST['ndc_nonce'], 'ns_date_converter' ) ) {

		if ( isset( $_POST['btn_cte'] ) ) {
			// BS to AD.
			$ad_date = $nd_object->convertBsToAd( absint( $_POST['np_year'] ), absint( $_POST['np_month'] ), absint( $_POST['np_day'] ) );
			if ( is_array( $ad_date ) && ! empty( $ad_date ) ) {
				$value['np_year']  = absint( $_POST['np_year'] );
				$value['np_month'] = absint( $_POST['np_month'] );
				$value['np_day']   = absint( $_POST['np_day'] );
				$value['en_year']  = absint( $ad_date['year'] );
				$value['en_month'] = absint( $ad_date['month'] );
				$value['en_day']   = absint( $ad_date['day'] );
			}
		} else {
			// AD to BS.
			$bs_date = $nd_object->convertAdToBs( absint( $_POST['en_year'] ), absint( $_POST['en_month'] ), absint( $_POST['en_day'] ) );
			if ( is_array( $bs_date ) && ! empty( $bs_date ) ) {
				$value['np_year']  = absint( $bs_date['year'] );
				$value['np_month'] = absint( $bs_date['month'] );
				$value['np_day']   = absint( $bs_date['day'] );
				$value['en_year']  = absint( $_POST['en_year'] );
				$value['en_month'] = absint( $_POST['en_month'] );
				$value['en_day']   = absint( $_POST['en_day'] );
			}
		}
	}
} else {
	// Show today date.
	$today = explode( '-', date( 'Y-m-d' ) );

	$new_date = $nd_object->convertAdToBs( $today[0], $today[1], $today[2] );

	if ( is_array( $new_date ) && ! empty( $new_date ) ) {
		$value['np_year']  = absint( $new_date['year'] );
		$value['np_month'] = absint( $new_date['month'] );
		$value['np_day']   = absint( $new_date['day'] );
		$value['en_year']  = absint( $today[0] );
		$value['en_month'] = absint( $today[1] );
		$value['en_day']   = absint( $today[2] );
	}
}
?>

<div class="nsdc-wrap">
	<form method="POST" action="" class="nsdc-form">
		<?php wp_nonce_field( 'ns_date_converter', 'ndc_nonce' ); ?>
		<div class="nsdc-row">
			<?php
			$args = array(
				'name'     => 'np_year',
				'selected' => $value['np_year'],
			);
			?>
			<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'np' ) ); ?>
			<?php
			$args = array(
				'name'     => 'np_month',
				'selected' => $value['np_month'],
			);
			?>
			<label>Month</label><?php ndc_render_select_dropdown( $args, 'ndc_get_month_options', array( 'np' ) ); ?>

			<?php
			$args = array(
				'name'     => 'np_day',
				'selected' => $value['np_day'],
			);
			?>
			<label>Day</label><?php ndc_render_select_dropdown( $args, 'ndc_get_day_options', array( 'np' ) ); ?>

			<input type="submit" name="btn_cte" id="btn_cte" value="Convert to English" class="btn"/>
		</div><!-- .nsdc-row -->

		<div class="nsdc-row">
			<?php
			$args = array(
				'name'     => 'en_year',
				'selected' => $value['en_year'],
			);
			?>
			<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'en' ) ); ?>
			<?php
			$args = array(
				'name'     => 'en_month',
				'selected' => $value['en_month'],
			);
			?>
			<label>Month</label><?php ndc_render_select_dropdown( $args, 'ndc_get_month_options', array( 'en' ) ); ?>

			<?php
			$args = array(
				'name'     => 'en_day',
				'selected' => $value['en_day'],
			);
			?>
			<label>Day</label><?php ndc_render_select_dropdown( $args, 'ndc_get_day_options', array( 'en' ) ); ?>

			<input type="hidden" name="frm_submitted" value="1" />
			<input type="submit" name="btn_ctn" id="btn_ctn" value="Convert to Nepali" class="btn"/>
		</div><!-- .nsdc-row -->
	</form><!-- .nsdc-form -->

	<?php if ( isset( $_POST['frm_submitted'] ) && 1 === absint( $_POST['frm_submitted'] ) ) : ?>

		<div class="nsdc-billboard">
			<div class="nsdc-billboard-inner">
				<?php
				$details_np   = $nd_object->getDetails( $value['np_year'], $value['np_month'], $value['np_day'], 'bs' );
				$np_formatted = $nd_object->getFormattedDate( $details_np, 'Y F j, l' );
				?>

				<?php if ( ! empty( $np_formatted ) ) : ?>
					<div class="nsdc-board">
						<h4 class="nsdc-board-heading">Nepali (BS)</h4>
						<div class="nsdc-board-content">
							<p><?php echo esc_html( $np_formatted ); ?></p>
						</div><!-- .nsdc-board-content -->
					</div>
				<?php endif; ?>

				<div class="date-area en-date">
					<div class="nsdc-board">
						<h4 class="nsdc-board-heading">English (AD)</h4>
						<div class="nsdc-board-content">
							<p><?php echo esc_html( date( 'Y F j, l', strtotime( $value['en_year'] . '-' . $value['en_month'] . '-' . $value['en_day'] ) ) ); ?></p>
						</div><!-- .nsdc-board-content -->
					</div>
				</div>
			</div><!-- .nsdc-billboard-inner -->
		</div><!-- .nsdc-billboard -->
	<?php endif; ?>

</div><!-- .nsdc-wrap -->
