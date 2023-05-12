<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Spatie\DataTransferObject\DataTransferObject;

interface StorableInterface
{
    public function store(DataTransferObject $dataTransferObject): Model;
}
