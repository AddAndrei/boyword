<?php

namespace App\Http\Interfaces\Mediatr;

use App\Http\DTO\DTO;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Mediatr
{
    public function store(DTO $dataTransferObject, ?Closure $closure): Model;

    public function all(DTO $dataTransferObject, ?Closure $closure): Collection;
}
