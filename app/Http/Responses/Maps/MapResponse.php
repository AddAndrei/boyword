<?php

namespace App\Http\Responses\Maps;

use App\Http\Responses\Response;
use App\Models\Map\Map;
use App\Models\Tiles\Tile;
use Illuminate\Http\Request;

class MapResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Map $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'tiles' => $this->tiles,
        ];
    }
}
