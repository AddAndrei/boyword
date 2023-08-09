<?php

namespace App\Http\Interfaces\Mediatr;

use App\Http\DTO\DTO;
use App\Models\BaseModel;
use Closure;
use Illuminate\Database\Eloquent\Model;

interface StorableInterface
{
    public function store(BaseModel $model, ?DTO $dataTransferObject = null, ?Closure $closure = null): Model;
}
