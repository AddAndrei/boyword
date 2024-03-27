<?php

namespace App\Http\Responses\Clans;

use App\Http\Responses\Auth\UserResponse;
use App\Http\Responses\Hero\HeroResponse;
use App\Http\Responses\Response;
use App\Models\Clans\Clan;
use App\Models\Clans\HeroesInClan;
use Illuminate\Http\Request;

class ClanResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Clan $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'creator' => $this->relationLoaded('creator')
                ? UserResponse::make($this->creator)
                : null,
            'heroes' => $this->relationLoaded('heroes')
                ? HeroesInClanResponse::collection($this->heroes)
                : null,
        ];
    }
}
