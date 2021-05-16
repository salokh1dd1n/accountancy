<?php

function get_dates()
{
    $dates = [];
    foreach (range(1, 31) as $date) {
        $date = str_pad($date, 2, 0, STR_PAD_LEFT);
        $dates[$date] = $date;
    }

    return $dates;
}

function get_months()
{
    return [
        '01' => 'Январь',
        '02' => 'Февраль',
        '03' => 'Март',
        '04' => 'Апрель',
        '05' => 'Май',
        '06' => 'Июнь',
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь',
    ];
}

function get_years()
{
    $currentYear = date('Y');
    $minYear = date('Y', strtotime($currentYear . ' -5 years'));
    $yearRange = range($minYear, $currentYear);
    foreach ($yearRange as $year) {
        $years[$year] = $year;
    }

    return $years;
}

