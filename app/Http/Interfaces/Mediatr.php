<?php

namespace App\Http\Interfaces;

use App\Http\DTO\DTO;
use Illuminate\Database\Eloquent\Model;

interface Mediatr
{
    public function store(DTO $dataTransferObject): Model;
}
