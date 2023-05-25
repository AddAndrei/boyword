<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\DTO;

/**
 * Class RegisterDTO
 * @package App\Http\DTO\Auth
 *
 * @author Shcerbakov Andrei
 */
class RegisterDTO extends DTO
{
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;
}
