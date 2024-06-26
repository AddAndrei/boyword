<?php

namespace App\Http\Responses\Add;

use App\Http\Responses\Auth\CreatorResponse;
use App\Http\Responses\Auth\UserResponse;
use App\Http\Responses\City\CityResponse;
use App\Http\Responses\Color\ColorResponse;
use App\Http\Responses\Mark\MarkResponse;
use App\Http\Responses\Response;
use App\Http\Responses\Volume\VolumeResponse;
use App\Models\Adds\Add;
use App\Models\Color\Color;
use Illuminate\Http\Request;

class AddResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Add $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'aggregate'=> $this->aggregate,
            'filtrate' => $this->filtrate,
            'price' => $this->price,
            'city' => $this->relationLoaded('city')
                ? CityResponse::make($this->city)
                : null,
            'mark' => $this->relationLoaded('mark')
                ? MarkResponse::make($this->mark)
                : null,
            'model' => $this->relationLoaded('mark')
                ? MarkResponse::make($this->mark)
                : null,
            'memory' => $this->relationLoaded('memory')
                ? VolumeResponse::make($this->memory)
                : null,
            'color' => $this->relationLoaded('color')
                ? ColorResponse::make($this->color)
                : null,
            'user' => $this->relationLoaded('user')
                ? UserResponse::make($this->user)
                : null,
        ];
    }
}
