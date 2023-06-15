<?php

namespace App\Http\Patterns\HeroFactory;

/**
 * Class HeroFactory
 * @package App\Http\Patterns\HeroFactory
 *
 * @property Weapon $weapon
 * @property int $min_damage
 * @property int $max_damage
 * @property int $health_points
 * @property int $mana_points
 * @author Shcerbakov Andrei
 */
abstract class HeroFactory
{
    protected Weapon $weapon;

    public int $min_damage;
    public int $max_damage;
    public int $health_points;
    public int $mana_points;

    abstract public function createWeapon(): Weapon;
    abstract public function hit(): int;

    public function getWeapon(): Weapon
    {
        return $this->weapon;
    }
}
