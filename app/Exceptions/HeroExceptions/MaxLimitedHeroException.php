<?php

namespace App\Exceptions\HeroExceptions;

use App\Exceptions\GeneralJsonException;

class MaxLimitedHeroException extends GeneralJsonException
{
    protected $message = 'Max limited heroes in account, max limit 3 heroes!';
}
