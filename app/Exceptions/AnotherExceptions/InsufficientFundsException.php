<?php

namespace App\Exceptions\AnotherExceptions;

use App\Exceptions\GeneralJsonException;

class InsufficientFundsException extends GeneralJsonException
{
    protected $message = 'Не достаточно средств на аккаунте';
}
