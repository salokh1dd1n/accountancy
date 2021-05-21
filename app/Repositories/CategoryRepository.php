<?php

namespace App\Repositories;

use App\Models\Category as Model;

cl
CategoryRepository extends CoreRepository
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
            'color',
            'description',
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

    public function getCategory(int $id)
    {
        $columns = [
            'id',
            'title',
            'color',
            'description',
            'user_id',
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where([
                ['user_id', auth()->user()->id],
                ['id', $id]
            ])
            ->first();

        return $result;
    }

}
