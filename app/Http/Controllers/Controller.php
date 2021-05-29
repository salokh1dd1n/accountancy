<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getYearMonth()
    {
        $day = request('day');
        $year = request('year', date('Y'));
        $month = request('month');

        $yearMonth = $year . '-' . $month;

        if ($month == 'all') {
            return $yearMonth = Carbon::parse($year);
        } elseif (checkdate($month, '01', $year)) {
            if (checkdate($month, $day, $year)) {
                return $yearMonth = $year . '-' . $month . '-' . $day;
            }
            return $yearMonth = $year . '-' . $month;
        }
        return $yearMonth = date('Y-m');

    }

    protected function getYear()
    {
        return in_array(request('year'), get_years()) ? request('year') : date('Y');
    }

}
