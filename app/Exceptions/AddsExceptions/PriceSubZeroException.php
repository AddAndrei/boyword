<?php

namespace App\Exceptions\AddsExceptions;

use App\Exceptions\GeneralJsonException;

class PriceSubZeroException extends GeneralJsonException
{
    protected $message = 'The price cannot be lower than zero';
}
