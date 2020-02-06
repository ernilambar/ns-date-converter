<style>
	.ns-dc-form {
		margin: 10px auto;
		font-size: 22px;
	}
	.ns-dc-form .ns-row{
		margin-bottom: 20px;
	}
	.ns-dc-form .ns-row label{
		margin-right: 10px;
		font-size: 14px;
	}
	.ns-dc-form .ns-row select{
		margin-right: 15px;
	}
	.ns-dc-form .ns-row input[type="submit"] {
		margin-top: 10px;
	}
	.ns-date-converter-date-output {
		background-color: #eeeeee;
		border-radius: 10px;
		color: #000000;
		font-size: 20px;
		padding: 5px 0;
		text-align: center;
	}
	.ns-dc-form select {
		min-width: 50px;
		width: auto;
		display: inline-block;
		padding: 2px;
	}
	.ns-dc-form input[type="submit"] {
		display: inline-block;
	}
</style>
<?php
date_default_timezone_set('Asia/Katmandu');
$cal = new Nepali_Calendar();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (isset($_POST['nep_submit']))
    {
        $nepdate = $cal->nep_to_eng($_POST['nepyear'], $_POST['nepmon'], $_POST['nepday']);
        if (!crossCheck($_POST['nepyear'], $_POST['nepmon'], $_POST['nepday']))
        {
            $msg = '<p style="color:#FF0000; font-weight:bold">Invalid date input</p>';
        }
        $year = $nepdate['year'];
        $month = $nepdate['month'];
        $month_name = $nepdate['emonth'];
        $day = $nepdate['date'];
        $day_name = $nepdate['day'];
        //
        $year_n = $_POST['nepyear'];
        $month_n = $_POST['nepmon'];
        $day_n = $_POST['nepday'];
        $day_name_n = $nepdate['day'];
        $month_name_n = getMonthName($month_n);
    }
    if (isset($_POST['eng_submit']))
    {

        $nepdate = $cal->eng_to_nep($_POST['engyear'], $_POST['engmon'], $_POST['engday']);

        $year_n = $nepdate['year'];
        $month_n = $nepdate['month'];
        $month_name_n = $nepdate['nmonth'];
        $day_n = $nepdate['date'];
        $day_name_n = $nepdate['day'];
        //
        $year = $_POST['engyear'];
        $month = $_POST['engmon'];
        $day = $_POST['engday'];
        $month_name = date('F', strtotime("$year-$month-$day"));
        $day_name = date('l', strtotime("$year-$month-$day"));
    }
}
else
{
    //if not submitted
    list($year, $month, $day) = explode('-', date('Y-m-d'));
    $month_name = date('F');
    $day_name = date('l');
    //
    $nepdate = $cal->eng_to_nep($year, $month, $day);
    $year_n = $nepdate['year'];
    $month_n = $nepdate['month'];
    $month_name_n = $nepdate['nmonth'];
    $day_n = $nepdate['date'];
    $day_name_n = $nepdate['day'];
}
?>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                ?>
                <div class="row ns-date-converter-date-output">
                    <div>
                        <p>Nepali (BS) : <br/>
<?php echo $day_n . ' ' . ucfirst($month_name_n) . ' ' . $year_n . ', ' . $day_name_n; ?>
                        </p>
                    </div>
                    <div>
                        <p>English (AD) : <br/>
<?php echo $day . ' ' . $month_name . ' ' . $year . ', ' . $day_name; ?>
                        </p>
                    </div>
                </div>
                <?php
            } //end if
            ?>

<form method="POST" action="" class="ns-dc-form">
  <div class="ns-row">
    <label>Year</label><?php getYearList('NP', 'nepyear', $year_n) ?>
    <label>Month</label><?php getMonthList('nepmon', $month_n, 'NP') ?>
    <label>Day</label><?php getDayList(32, 'nepday', $day_n); ?>
    <input type="submit" name="nep_submit" id="nep_submit" value="Convert to English"  class="btn btn-primary"/>
  </div><!-- .ns-row -->
  <div class="ns-row">
    <label>Year</label><?php getYearList('EN', 'engyear', $year) ?>
    <label>Month</label><?php getMonthList('engmon', $month, 'EN') ?>
    <label>Day</label><?php getDayList(31, 'engday', $day) ?>
    <input type="submit" name="eng_submit" id="eng_submit" value="Convert to Nepali"  class="btn btn-primary"/>
  </div><!-- .ns-row -->
</form>
