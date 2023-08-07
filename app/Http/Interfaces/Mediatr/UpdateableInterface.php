<?php

namespace App\Http\Interfaces\Mediatr;

use App\Http\DTO\DTO;
use App\Models\BaseModel;
use Closure;

interface UpdateableInterface
{
    public function update(int $id, BaseModel $model, DTO $dto, Closure $closure = null): BaseModel;
}
