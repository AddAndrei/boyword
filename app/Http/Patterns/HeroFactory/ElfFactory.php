<?php

namespace App\Http\Patterns\HeroFactory;

use App\Http\Patterns\HeroFactory\Weapons\Bow;

class ElfFactory extends HeroFactory
{
    public function __construct()
    {
        $this->weapon = $this->createWeapon();
        $this->min_damage = 3;
        $this->max_damage = 4;
        $this->health_points = 30;
        $this->mana_points = 18;
    }

    public function createWeapon(): Weapon
    {
        return new Bow();
    }

    public function hit(): int
    {
        return $this->weapon->hit();
    }
}
