<?php

namespace App\Http\Responses\Clans;

use App\Http\Responses\Hero\HeroResponse;
use App\Http\Responses\Response;
use App\Models\Clans\HeroesInClan;
use Illuminate\Http\Request;

class HeroesInClanResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var HeroesInClan $this */
        return [
            'hero' => $this->relationLoaded('hero')
                ? HeroResponse::make($this->hero)
                : null,
        ];
    }
}
