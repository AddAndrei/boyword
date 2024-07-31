<?php

namespace App\Exceptions\ReviewExceptions;

use App\Exceptions\GeneralJsonException;

class ReviewExistedException extends GeneralJsonException
{
    protected $message = 'Review existed from your!';
}
