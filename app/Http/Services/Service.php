<?php

namespace App\Http\Services;

use App\Http\DTO\DTO;
use App\Http\Interfaces\StorableInterface;
use App\Models\BaseModel;


class Service implements StorableInterface
{

    public function store(BaseModel $model, DTO $dto): BaseModel
    {
        $model = new $model();
        $model->propagateFromDTO($dto)->save();
        return $model;
    }
}
