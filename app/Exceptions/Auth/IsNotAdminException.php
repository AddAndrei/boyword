<?php

namespace App\Exceptions\Auth;

use App\Exceptions\GeneralJsonException;

class IsNotAdminException extends GeneralJsonException
{
    protected $message = 'У вас недостаточно прав';
}
