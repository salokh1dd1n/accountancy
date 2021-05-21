<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


//    protected function getYearMonth()
//    {
//        $date = request('date');
//        $year = request('year', date('Y'));
//        $month = request('month', date('m'));
//        $yearMonth = $year . '-' . $month;
//
//        $explodedYearMonth = explode('-', $yearMonth);
//
//        if (count($explodedYearMonth) == 2 && checkdate($explodedYearMonth[1], '01', $explodedYearMonth[0])) {
//            if (checkdate($explodedYearMonth[1], $date, $explodedYearMonth[0])) {
//                return $explodedYearMonth[0] . '-' . $explodedYearMonth[1] . '-' . $date;
//            }
//
//            return $explodedYearMonth[0] . '-' . $explodedYearMonth[1];
//        }
//
//        return date('Y-m');
//    }

    protected function getYearMonth()
    {
        $day = request('day');
        $year = request('year', date('Y'));
        $month = request('month');

        $yearMonth = $year . '-' . $month;

        if ($month == 'all') {
            return $year;
        } elseif (checkdate($month, '01', $year)) {
            if (checkdate($month, $day, $year)) {
                return $year . '-' . $month . '-' . $day;
            }
            return $year . '-' . $month;
        }
        return date('Y-m');

    }

    protected function getYear()
    {
        return in_array(request('year'), get_years()) ? request('year') : date('Y');
    }

}
