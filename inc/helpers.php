<?php

function getYearList($ytype, $yearname, $sel = '')
{
    $start = ($ytype == 'NP') ? 2000 : 1944;
    $end = ($ytype == 'NP') ? 2089 : 2033;
    echo '<select class="form-control"  name="' . $yearname . '" id="' . $yearname . '">';
    for ($year = $start; $year <= $end; $year++)
    {
        echo '<option';
        if ($sel != '' and $year == $sel)
        {
            echo ' selected="selected" ';
        }
        echo '>';
        echo $year;
        echo '</option>';
    }
    echo '</select>';
}

function getMonthName($mon)
{
    $arr_np = array('Baishakh', 'Jeth', 'Ashar', 'Shrawan', 'Bhadra', 'Ashoj', 'Kartik', 'Mangshir', 'Poush', 'Magh', 'Falgun', 'Chaitra');
    return $arr_np[$mon-1];
}

function getMonthList($monthname, $cur = '', $lng = 'NP')
{
    $arr_np = array('Baishakh', 'Jeth', 'Ashar', 'Shrawan', 'Bhadra', 'Ashoj', 'Kartik', 'Mangshir', 'Poush', 'Magh', 'Falgun', 'Chaitra');
    $arr_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    echo '<select class="form-control" name="' . $monthname . '" id="' . $monthname . '">';
    for ($i = 1; $i <= 12; $i++)
    {
        echo '<option';
        if ($cur != '' and $i == $cur)
        {
            echo ' selected="selected" ';
        }
        echo ' value="' . $i . '"';
        echo '>';
        if ($lng == 'EN')
            echo $arr_en[$i - 1];
        else
            echo $arr_np[$i - 1];
        echo '</option>';
    }
    echo '</select>';
}

function getDayList($max, $monthname, $cur = '')
{
    echo '<select  class="form-control" name="' . $monthname . '" id="' . $monthname . '">';
    for ($i = 1; $i <= $max; $i++)
    {
        echo '<option';
        if ($cur != '' and $i == $cur)
        {
            echo ' selected="selected" ';
        }
        echo '>';
        echo $i;
        echo '</option>';
    }
    echo '</select>';
}

function crossCheck($y, $m, $d)
{
    //takes nepali date
    $objC = new Nepali_Calendar();
    $engdate = $objC->nep_to_eng($y, $m, $d);
    $eyear = $engdate['year'];
    $emonth = $engdate['month'];
    $eday = $engdate['date'];
    //
    $nepdate = $objC->eng_to_nep($eyear, $emonth, $eday);
    $new_year = $nepdate['year'];
    $new_month = $nepdate['month'];
    $new_day = $nepdate['date'];
    if ($y == $new_year && $m == $new_month && $d == $new_day)
        return true;
    return false;
}
