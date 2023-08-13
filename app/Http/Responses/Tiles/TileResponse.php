<?php

namespace App\Http\Responses\Tiles;

use App\Http\Responses\Response;
use App\Models\Tiles\Tile;
use Illuminate\Http\Request;

class TileResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Tile $this */
        return [
            'id' => $this->getKey(),
            'image' => $this->image,
            'title' => $this->title,
            'width' => $this->width,
            'height' => $this->height,
            'collision' => (boolean)$this->collision,
            'event' => $this->event,
        ];
    }
}
