<?php

namespace App\Exceptions\ReviewExceptions;

use App\Exceptions\GeneralJsonException;

class RateReviewException extends  GeneralJsonException
{
    protected $message = 'rate not be greatest 5';
}
