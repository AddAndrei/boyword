<?php

namespace App\Http\Responses\Volume;

use App\Http\Responses\Response;
use App\Models\Volume\VolumeMemory;
use Illuminate\Http\Request;

class VolumeResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var VolumeMemory $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
        ];
    }
}
