<?php

namespace App\Http\Patterns\HeroFactory\Weapons;

use App\Http\Patterns\HeroFactory\Weapon;

class Bow extends Weapon
{

    public function hit(): int
    {
        return rand(10, 15);
    }
}
