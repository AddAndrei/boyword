<?php

namespace App\Http\Interfaces\Mediatr;

use App\Models\BaseModel;

interface GetableInterface
{
    public function get(string $field, mixed $value, BaseModel $model): BaseModel;
}
