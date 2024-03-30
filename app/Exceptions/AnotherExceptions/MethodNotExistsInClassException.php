<?php

namespace App\Exceptions\AnotherExceptions;

use App\Exceptions\GeneralJsonException;

class MethodNotExistsInClassException extends GeneralJsonException
{
    public function __construct(string $className, string $methodName, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->message = "Method $methodName not exists in $className";
    }
}
