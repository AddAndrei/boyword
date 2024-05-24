<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\DTO;

class CreateCodeDTO extends DTO
{
    public string $numberPhone;
    public int $action;
}
