<?php

namespace App\Exceptions\AnotherExceptions;

use App\Exceptions\GeneralJsonException;

class NotSupportedResourceTypeException extends GeneralJsonException
{
    public function __construct(string $class, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->message = "this Class $class not supported current resource type";
    }


}
