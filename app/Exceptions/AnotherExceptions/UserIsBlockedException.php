<?php

namespace App\Exceptions\AnotherExceptions;

use App\Exceptions\GeneralJsonException;

class UserIsBlockedException extends GeneralJsonException
{
    protected $message = "User is banned!";
}
