<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\DTO;

class LoginDTO extends DTO
{
    public string $phone;

    public string $password;
}
