<?php

namespace App\Http\DTO\Hero;

use App\Http\DTO\DTO;
use App\Http\Patterns\HeroFactory\HeroFactory;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class HeroCreateDTO extends DTO
{
    private const NAME_SPACE = "App\\Http\\Patterns\\HeroFactory\\";

    public string $name;
    public string $hero_class;

    public string $weapon;

    public int $min_damage;

    public int $max_damage;
    public int $health_points;
    public int $mana_points;

    /**
     * @param Request $request
     * @return static
     * @throws UnknownProperties
     */
    public static function createFromRequest(Request $request): static
    {
        $heroClassName = self::NAME_SPACE . ucfirst($request->get('hero_class')) . "Factory";
        /** @var HeroFactory $hero */
        $hero = new $heroClassName();
        return new static([
            'name' => $request->get('name'),
            'hero_class' => $heroClassName,
            'weapon' => $hero->getWeapon()->getNameSpace(),
            'min_damage' => $hero->min_damage,
            'max_damage' => $hero->max_damage,
            'health_points' => $hero->health_points,
            'mana_points' => $hero->mana_points,
        ]);
    }
}
