<?php

namespace App\Repositories;

use App\Models\Transaction as Model;

class TransactionRepository extends CoreRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTransactionsPaginate($yearMonth)
    {
        $result = $this
            ->getTransactions()
            ->where('date', 'like', $yearMonth . '%')
//            ->filterDescription()
            ->paginate(15)
            ->appends(request()->except('page'));
        return $result;

    }

    public function getExportTransactions($yearMonth)
    {
        $result = $this
            ->getTransactions()
            ->where('date', 'like', $yearMonth . '%')
            ->get();
        return $result;

    }

    public function getTransactions()
    {
        $columns = [
            'id',
            'date',
            'amount',
            'is_income',
            'description',
            'category_id',
            'user_id',
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('user_id', auth()->user()->id)
            ->orderBy('date', 'ASC')
            ->with([
                'category:id,title,color',
            ])
            ->when(request('category_id'), function ($transactions, $id){
               $transactions->where('category_id', $id);
            })
            ->when(request('query'), function ($transactions, $query){
               $transactions->where('description', 'like', '%'.$query.'%');
            });
        return $result;

    }

    public function getNumbers($yearMonth)
    {
        $startBalance = $this
            ->getTransactions()
            ->where([
                ['is_income', 1],
                ['date', '<=', $yearMonth],
            ])
            ->sum('amount');
        $income = $this
            ->getTransactions()
            ->where([
                ['is_income', 1],
                ['date', 'like', $yearMonth . '%']
            ])
            ->sum('amount');
        $spending = $this
            ->getTransactions()
            ->where([
                ['is_income', 0],
                ['date', 'like', $yearMonth . '%']
            ])
            ->sum('amount');
        $difference = $income - $spending;
        $endBalance = $startBalance + $difference;

        $result = [
            'startBalance' => $startBalance,
            'income' => $income,
            'spending' => $spending,
            'difference' => $difference,
            'endBalance' => $endBalance
        ];
        $numbers = (object) $result;

        return $numbers;
    }

//    public function getStartBalance($yearMonth)
//    {
//        $result = $this
//            ->getTransactions()
//            ->where([
//                ['is_income', 1],
//                ['date', '<=', $yearMonth],
//            ])
////            ->filterDescription()
//            ->sum('amount');
//
//        return $result;
//    }
//
//    public function getIncome($yearMonth)
//    {
//        $result = $this
//            ->getTransactions()
//            ->where([
//                ['is_income', 1],
//                ['date', 'like', $yearMonth . '%']
//            ])
////            ->filterDescription()
//            ->sum('amount');
//
//        return $result;
//    }
//
//    public function getSpending($yearMonth)
//    {
//        $result = $this
//            ->getTransactions()
//            ->where([
//                ['is_income', 0],
//                ['date', 'like', $yearMonth . '%']
//            ])
////            ->filterDescription()
//            ->sum('amount');
//
//        return $result;
//    }


    public function getTransaction(int $id)
    {
        $columns = [
            'id',
            'date',
            'amount',
            'is_income',
            'description',
            'category_id',
            'user_id',
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where([
                ['user_id', auth()->user()->id],
                ['id', $id]
            ])
            ->with([
                'category:id,title,color',
            ])
            ->first();
        return $result;
    }

    public function getTransactionStatistics($year)
    {
        $columns = 'DATE_FORMAT(date, \'%m\') as month';
        $columns .= ', YEAR(date) as year';
        $columns .= ', count(`id`) as count';
        $columns .= ', sum(if(is_income = 1, amount, 0)) AS income';
        $columns .= ', sum(if(is_income = 0, amount, 0)) AS spending';

        $statistics = $this->startConditions()
            ->selectRaw($columns)
            ->where('user_id', auth()->user()->id)
            ->whereRaw('YEAR(date) = ?', $year)
            ->when(request('category_id'), function ($transactions, $id){
               $transactions->where('category_id', $id);
            })
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->groupByRaw('YEAR(date)')
            ->groupByRaw('MONTH(date)')
            ->get();

        $result = collect($statistics)->keyBy('month');
        return $result;
    }
}
