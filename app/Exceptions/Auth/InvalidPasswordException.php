<?php

namespace App\Exceptions\Auth;

use App\Exceptions\GeneralJsonException;

class InvalidPasswordException extends GeneralJsonException
{
    protected $message = 'Не верный логин или пароль';
}
