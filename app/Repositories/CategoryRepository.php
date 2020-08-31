<?php

namespace App\Repositories;

use App\Models\Category as Model;

class CategoryRepository extends CoreRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getAllCategories()
    {

        $columns = [
            'id',
            'title',
            'user_id',
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where([
                ['user_id', auth()->user()->id],
            ])
            ->get();
        return $result;

    }
}
