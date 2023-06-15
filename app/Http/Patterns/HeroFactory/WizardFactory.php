<?php

namespace App\Http\Patterns\HeroFactory;

use App\Http\Patterns\HeroFactory\Weapons\Stuff;

class WizardFactory extends HeroFactory
{

    public function __construct()
    {
        $this->weapon = $this->createWeapon();
        $this->min_damage = 2;
        $this->max_damage = 5;
        $this->health_points = 15;
        $this->mana_points = 30;
    }

    public function createWeapon(): Weapon
    {
        return new Stuff();
    }

    public function hit(): int
    {
        return $this->weapon->hit();
    }
}
