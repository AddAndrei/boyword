<?php

namespace App\Http\Responses\Resources;

use App\Http\Responses\Response;
use App\Models\Resources\ResourceType;
use Illuminate\Http\Request;

class ResourceTypeResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var ResourceType $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
