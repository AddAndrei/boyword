<?php

namespace App\Http\Patterns\HeroFactory\Weapons;

use App\Http\Patterns\HeroFactory\Weapon;

class Sword extends Weapon
{

    public function hit(): int
    {
        return rand(15,18);
    }
}
