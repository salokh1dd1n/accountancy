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

    public function getFilterTransactionsPaginate($yearMonth)
    {
        $result = $this
            ->getTransactions()
            ->where('date', 'like', $yearMonth . '%')
            ->filterDescription()
            ->paginate(10);
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
            ]);
        return $result;

    }

    public function getStartBalance($yearMonth)
    {
        $result = $this
            ->getTransactions()
            ->where([
                ['is_income', 1],
                ['date', '<=', $yearMonth],
            ])
            ->filterDescription()
            ->sum('amount');

        return $result;
    }

    public function getIncome($yearMonth)
    {
        $result = $this
            ->getTransactions()
            ->where([
                ['is_income', 1],
                ['date', 'like', $yearMonth . '%']
            ])
            ->filterDescription()
            ->sum('amount');

        return $result;
    }

    public function getSpending($yearMonth)
    {
        $result = $this
            ->getTransactions()
            ->where([
                ['is_income', 0],
                ['date', 'like', $yearMonth . '%']
            ])
            ->filterDescription()
            ->sum('amount');

        return $result;
    }


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

    public function addTransaction(array $data)
    {
        $result = $this
            ->startConditions()
            ->create($data);
        return $this->getAddMessage($result);
    }

    public function editTransaction(array $data, int $id)
    {
        $result = $this
            ->startConditions()
            ->findOrFail($id)
            ->update($data);

        return $this->getEditMessage($result);
    }
}
