<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Schema;

abstract class CoreRepository
{
    protected mixed $model;
    protected mixed $columns;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startConditions()
    {
        return clone $this->model;
    }
}
