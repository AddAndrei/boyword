<?php

namespace App\Exceptions\ClanException;

use App\Exceptions\GeneralJsonException;

class HeroInClanExistException extends GeneralJsonException
{
    protected $message = 'Герой уже находится в этом клане!';
}
