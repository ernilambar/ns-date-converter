<form method="POST" action="" class="ns-dc-form">
	<div class="ns-row">
		<?php
		$args = array(
			'name' => 'np_year',
		);
		?>
		<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'np' ) ); ?>
		<?php
		$args = array(
			'name' => 'np_month',
		);
		?>
		<label>Month</label><?php ndc_render_select_dropdown( $args, 'ndc_get_month_options', array( 'np' ) ); ?>

		<?php
		$args = array(
			'name' => 'np_day',
		);
		?>
		<label>Day</label><?php ndc_render_select_dropdown( $args, 'ndc_get_day_options', array( 'np' ) ); ?>

		<input type="submit" name="btn_cte" id="btn_cte" value="Convert to English" class="btn"/>
	</div><!-- .ns-row -->

	<div class="ns-row">
		<?php
		$args = array(
			'name' => 'en_year',
		);
		?>
		<label>Year</label><?php ndc_render_select_dropdown( $args, 'ndc_get_year_options', array( 'en' ) ); ?>
		<?php
		$args = array(
			'name' => 'en_month',
		);
		?>
		<label>Month</label><?php ndc_render_select_dropdown( $args, 'ndc_get_month_options', array( 'en' ) ); ?>

		<?php
		$args = array(
			'name' => 'en_day',
		);
		?>
		<label>Day</label><?php ndc_render_select_dropdown( $args, 'ndc_get_day_options', array( 'en' ) ); ?>

		<input type="submit" name="btn_ctn" id="btn_ctn" value="Convert to Nepali" class="btn"/>
	</div><!-- .ns-row -->
</form>
