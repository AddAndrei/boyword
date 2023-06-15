<?php

namespace App\Http\Patterns\HeroFactory;

abstract class Weapon
{
    abstract public function hit(): int;
    public function getNameSpace(): string
    {
        return (string)get_called_class();
    }
}
