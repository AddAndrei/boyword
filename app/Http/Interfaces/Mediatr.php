<?php

namespace App\Http\Interfaces;

use App\Http\DTO\DTO;
use Illuminate\Database\Eloquent\Model;
use Closure;
interface Mediatr
{
    public function store(DTO $dataTransferObject, ?Closure $closure): Model;
}
