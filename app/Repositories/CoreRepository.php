<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    /** @package App\Repositories */

    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract public function getModelClass();


    protected function startConditions()
    {
        return clone $this->model;
    }

    protected function getAddMessage($result)
    {
        if ($result) {
            flash("Успешно сохранено", 'success');
            return redirect()
                ->route('transactions');
        } else {
            flash("Ощибка сохранения", 'error');
            return back()
                ->withInput();
        }
    }

    protected function getEditMessage($result)
    {
        if ($result) {
            flash("Успешно обновлено", 'success');
            return redirect()
                ->route('transactions');
        } else {
            flash("Ощибка обновление", 'error');
            return back()
                ->withInput();
        }
    }

}
