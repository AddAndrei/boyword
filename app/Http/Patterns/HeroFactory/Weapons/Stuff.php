<?php

namespace App\Http\Patterns\HeroFactory\Weapons;

use App\Http\Patterns\HeroFactory\Weapon;

class Stuff extends Weapon
{

    public function hit(): int
    {
        return rand(12, 25);
    }
}
