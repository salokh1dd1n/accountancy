<?php

namespace App\Repositories;

use App\Models\Transaction as Model;

class TransactionRepository extends CoreRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getAllTransactions($yearMonth)
    {
        $categoryId = request('category_id');

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
                ['date', 'like', $yearMonth.'%']
            ])
//            ->when($categoryId, function ($queryBuilder, $categoryId) {
//                if ($categoryId == 'null') {
//                    $queryBuilder->whereNull('category_id');
//                } else {
//                    $queryBuilder->where('category_id', $categoryId);
//                }
//            })
            ->orderBy('date', 'ASC')
            ->with([
                'category:id,title,color',
            ])
            ->paginate(7);
        return $result;

    }
}
