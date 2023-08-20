<?php

namespace App\Http\Responses\Hero;

use App\Http\Responses\Response;
use App\Models\Hero\Hero;
use Illuminate\Http\Request;

class HeroResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Hero $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'min_damage' => $this->min_damage,
            'max_damage' => $this->max_damage,
            'health_points' => $this->health_points,
            'mana_points' => $this->mana_points,
            'weapon' => $this->weapon,
            'hero_class' => $this->hero_class,
        ];
    }
}
