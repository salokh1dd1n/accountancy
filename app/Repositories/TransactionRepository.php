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
                ['date', 'like', $yearMonth . '%']
            ])
            ->filterCategory()
            ->filterDescription()
            ->orderBy('date', 'ASC')
            ->with([
                'category:id,title,color',
            ])
            ->paginate(10);
        return $result;

    }

    public function getStartBalance($yearMonth)
    {
        $result = $this
            ->startConditions()
            ->where([
                ['user_id', auth()->user()->id],
                ['is_income', 1],
                ['date', '<=', $yearMonth],
            ])
            ->filterDescription()
            ->filterCategory()
            ->sum('amount');

        return $result;
    }

    public function getIncome($yearMonth)
    {
        $result = $this
            ->startConditions()
            ->where([
                ['user_id', auth()->user()->id],
                ['is_income', 1],
                ['date', 'like', $yearMonth . '%']
            ])
            ->filterCategory()
            ->filterDescription()
            ->sum('amount');

        return $result;
    }

    public function getSpending($yearMonth)
    {
        $result = $this
            ->startConditions()
            ->where([
                ['user_id', auth()->user()->id],
                ['is_income', 0],
                ['date', 'like', $yearMonth . '%']
            ])
            ->filterCategory()
            ->filterDescription()
            ->sum('amount');

        return $result;
    }

}
