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

    protected function redirectWithFilterParams(string $date, $route)
    {
        $date = strtotime($date);
        $month = date("m", $date);
        $year = date("Y", $date);
        $redirect = route($route, ['month' => $month, 'year' => $year]);

        return $redirect;
    }

    protected function startConditions()
    {
        return clone $this->model;
    }

    protected function getMessage($result, $route, $type, $status)
    {
        if ($type = 'create') {
            $message = 'Успешно сохранено';
        } else if ($type = 'edit') {
            $message = 'Успешно обновлено';
        } elseif ($type = 'delete') {
            $message = 'Успешно удалено';
        }
        if ($result) {
            flash($message, $status);
            return redirect($route);
        } else {
            flash("Ошибка, Свяжитесь со администратором", 'error');
            return back()
                ->withInput();
        }
    }

    public function addRecord(array $data, string $route)
    {
        $redirect = $route;

        if (isset($data['date'])) {
            $redirect = $this->redirectWithFilterParams($data['date'], $route);
        }
        $result = $this
            ->startConditions()
            ->create($data);
        return $this->getMessage($result, $redirect, 'create', 'success');
    }

    public function editRecord(array $data, int $id, string $route)
    {
        $redirect = $route;

        if (isset($data['date'])) {
            $redirect = $this->redirectWithFilterParams($data['date'], $route);
        }
        $result = $this
            ->startConditions()
            ->findOrFail($id)
            ->update($data);

        return $this->getMessage($result, $redirect, 'edit', 'info');
    }

    public function deleteRecord(int $id, string $route)
    {
        $redirect = $route;

        if (isset($data['date'])) {
            $transactionDate = $this->getTransaction($id)->date;
            $redirect = $this->redirectWithFilterParams($transactionDate, $route);
        }

        $result = $this
            ->startConditions()
            ->destroy($id);

        return $this->getMessage($result, $redirect, 'delete', 'error');
    }

}
