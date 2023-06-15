<?php

namespace App\Http\Services;

use App\Http\DTO\DTO;
use App\Http\Interfaces\StorableInterface;
use App\Models\BaseModel;
use Closure;

class Service implements StorableInterface
{

    public function store(BaseModel $model, DTO $dto, Closure $closure = null): BaseModel
    {
        $model = new $model();
        if ($closure) {
            $model = $closure($model);
        }
        $model->propagateFromDTO($dto)->save();
        return $model;
    }

    public function get()
    {

    }
}
