<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\DTO;

class VerifyCodeDTO extends DTO
{
    public string $numberPhone;
    public int $code;
}
