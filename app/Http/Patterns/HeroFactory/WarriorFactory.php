<?php

namespace App\Http\Patterns\HeroFactory;

use App\Http\Patterns\HeroFactory\Weapons\Sword;

class WarriorFactory extends HeroFactory
{
    public function __construct()
    {
        $this->weapon = $this->createWeapon();
        $this->min_damage = 5;
        $this->max_damage = 9;
        $this->health_points = 40;
        $this->mana_points = 8;
    }

    public function createWeapon(): Weapon
    {
        return new Sword();
    }

    public function hit(): int
    {
        return $this->weapon->hit();
    }

}
