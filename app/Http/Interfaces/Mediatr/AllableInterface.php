<?php

namespace App\Http\Interfaces\Mediatr;

use App\Http\DTO\DTO;
use App\Models\BaseModel;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AllableInterface
{
    public function all(BaseModel $model, ?DTO $dataTransferObject = null, ?Closure $closure = null): Collection|LengthAwarePaginator;
}
