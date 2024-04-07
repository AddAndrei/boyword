<?php

namespace App\Http\Responses\Items;

use App\Http\Responses\Image\ImageResponse;
use App\Http\Responses\Resources\ResourceTypeResponse;
use App\Http\Responses\Response;
use App\Models\Items\Item;
use Illuminate\Http\Request;

/**
 * Class ItemResponse
 * @package App\Http\Responses\Items
 * @mixin Item
 * @author Shcerbakov Andrei
 */
class ItemResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'description' => $this->description,
            'resourceType' => $this->relationLoaded('resourceType')
                ? ResourceTypeResponse::make($this->resourceType)
                : null,
            'image' => $this->relationLoaded('image')
                ? ImageResponse::make($this->image)
                : null,
        ];
    }
}
