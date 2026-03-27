<?php

namespace App\Exceptions\ReviewExceptions;

use App\Exceptions\GeneralJsonException;

class ReviewExistedException extends GeneralJsonException
{
    protected $message = 'Вы уже оставляли отзыв об этой пользователе!';
}
