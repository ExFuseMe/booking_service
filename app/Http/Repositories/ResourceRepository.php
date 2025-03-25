<?php

namespace App\Http\Repositories;

use App\Models\Resource as Model;

class ResourceRepository extends CoreRepository
{
    function getModelClass(): string
    {
        return Model::class;
    }

    public function getResourceList()
    {
        $result = $this->startConditions()
            ->all(['id', 'name', 'type', 'description']);

        return $result;
    }
}
