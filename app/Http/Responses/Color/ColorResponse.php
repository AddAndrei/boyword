<?php

namespace App\Http\Responses\Color;

use App\Http\Responses\Response;
use App\Models\Color\Color;
use Illuminate\Http\Request;

class ColorResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Color $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
        ];
    }
}
