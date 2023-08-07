<?php

namespace App\Http\DTO\Hero;


use App\Http\DTO\DTO;


class UpdateHeroDTO extends DTO
{
    public ?string $name;
    public ?int $min_damage;
    public ?int $max_damage;
    public ?int $health_points;
    public ?int $mana_points;
    public ?string $weapon;
}
