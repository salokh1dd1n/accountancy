<?php

namespace App\Traits;

trait ForAccountacyTrait
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

    protected function getIncomeTotal($transactions)
    {
        return $transactions->sum(function ($transaction) {
            return $transaction->is_income ?
                $transaction->amount :
                0;
        });
    }

    protected function getSpendingTotal($transactions)
    {
        return $transactions->sum(function ($transaction) {
            return $transaction->is_income ? 0 : $transaction->amount;
        });
    }

    protected function getFormatedTotal($amount)
    {
        return number_format($amount, 0, '', ' ');
    }
}
