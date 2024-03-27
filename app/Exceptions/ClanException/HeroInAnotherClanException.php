<?php

namespace App\Exceptions\ClanException;

use App\Exceptions\GeneralJsonException;

class HeroInAnotherClanException extends GeneralJsonException
{
    protected $message = "Герой уже состоит в другом клане!";
}
