<?php

namespace App\Traits;

trait TransactionTrait
{
    protected function getYearMonth()
    {
        $date = request('date');
        $year = request('year', date('Y'));
        $month = request('month', date('m'));
        $yearMonth = $year . '-' . $month;

        $explodedYearMonth = explode('-', $yearMonth);

        if (count($explodedYearMonth) == 2 && checkdate($explodedYearMonth[1], '01', $explodedYearMonth[0])) {
            if (checkdate($explodedYearMonth[1], $date, $explodedYearMonth[0])) {
                return $explodedYearMonth[0] . '-' . $explodedYearMonth[1] . '-' . $date;
            }

            return $explodedYearMonth[0] . '-' . $explodedYearMonth[1];
        }

        return date('Y-m');
    }
}
