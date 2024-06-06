<?php

namespace App\Http\Responses\Add;

use App\Http\Responses\Auth\CreatorResponse;
use App\Http\Responses\Auth\UserResponse;
use App\Http\Responses\Category\CategoryResponse;
use App\Http\Responses\City\CityResponse;
use App\Http\Responses\Color\ColorResponse;
use App\Http\Responses\Image\ImageResponse;
use App\Http\Responses\Mark\MarkResponse;
use App\Http\Responses\Model\ModelResponse;
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
            'images' => $this->relationLoaded('images')
                ? ImageResponse::collection($this->images)
                : null,
            'city' => $this->relationLoaded('city')
                ? CityResponse::make($this->city)
                : null,
            'mark' => $this->relationLoaded('mark')
                ? MarkResponse::make($this->mark)
                : null,
            'model' => $this->relationLoaded('model')
                ? ModelResponse::make($this->model)
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
            'category' => $this->relationLoaded('category')
                ? CategoryResponse::make($this->category)
                : null,
            'views' => $this->relationLoaded('views')
                ? $this->views()->count()
                : null,
        ];
    }
}
