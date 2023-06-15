<?php

namespace App\Http\Interfaces;

use App\Http\DTO\DTO;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Closure;

interface StorableInterface
{
    public function store(BaseModel $model, DTO $dataTransferObject, Closure $closure = null): Model;
}
