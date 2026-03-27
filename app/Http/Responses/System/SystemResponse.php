<?php

namespace App\Http\Responses\System;

use App\Http\Responses\Color\ColorResponse;
use App\Http\Responses\Response;
use App\Http\Responses\Volume\VolumeResponse;
use Illuminate\Http\Request;

class SystemResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var  $this */
        return [
            'marks' => $this->resource['marks'],
            'colors' => ColorResponse::collection($this->resource['colors']),
            'memories' => VolumeResponse::collection($this->resource['memories']),
        ];
    }
}
