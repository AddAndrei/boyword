<?php

namespace App\Exceptions\Auth;

use App\Exceptions\GeneralJsonException;
use Throwable;

class UserExistedException extends GeneralJsonException
{
    public function __construct(string $phone, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = "Пользователь с номером $phone уже существует";
    }
}
