<?php

namespace App\Http\Responses\Image;

use App\Http\Responses\Response;
use App\Models\Image\Image;
use Illuminate\Http\Request;

class ImageResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Image $this */
        return [
            'id' => $this->getKey(),
            'url' => $this->url,
        ];
    }
}
