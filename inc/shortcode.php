<form method="POST" action="" class="ns-dc-form">
	<div class="ns-row">
		<?php
		$args = array(
			'name' => 'nepyear',
		);
		?>
		<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'np' ) ); ?>
		<label>Month</label><?php getMonthList('nepmon', $month_n, 'NP') ?>
		<label>Day</label><?php getDayList(32, 'nepday', $day_n); ?>
		<input type="submit" name="nep_submit" id="nep_submit" value="Convert to English"  class="btn btn-primary"/>
	</div><!-- .ns-row -->
	<div class="ns-row">

		<?php
		$args = array(
			'name' => 'engyear',
		);
		?>
		<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'en' ) ); ?>
		<label>Month</label><?php getMonthList('engmon', $month, 'EN') ?>
		<label>Day</label><?php getDayList(31, 'engday', $day) ?>
		<input type="submit" name="eng_submit" id="eng_submit" value="Convert to Nepali"  class="btn btn-primary"/>
	</div><!-- .ns-row -->
</form>
