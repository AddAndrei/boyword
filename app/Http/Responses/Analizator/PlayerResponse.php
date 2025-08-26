<?php

namespace App\Http\Responses\Analizator;

use App\Http\Responses\Response;
use App\Models\Analisator\Player;
use Illuminate\Http\Request;

class PlayerResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Player $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->nick,
            'win_rate' => $this->win_rate,
            'position' => $this->position,
        ];
    }
}
