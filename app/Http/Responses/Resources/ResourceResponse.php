<?php

namespace App\Http\Responses\Resources;

use App\Http\Responses\Image\ImageResponse;
use App\Http\Responses\Response;
use App\Models\Resources\Resource;
use Illuminate\Http\Request;

class ResourceResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Resource $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->relationLoaded('type')
                ? ResourceTypeResponse::make($this->type)
                : null,
            'image' => $this->relationLoaded('image')
                ? ImageResponse::make($this->image)
                : null,
        ];
    }
}
