<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\DTO;

class ResetPasswordDTO extends DTO
{
    public string $phone;
    public string $password;
}
