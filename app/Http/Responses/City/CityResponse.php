<?php

namespace App\Http\Responses\City;


use App\Http\Responses\Response;
use App\Models\City\City;
use Illuminate\Http\Request;

class CityResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var City $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
        ];
    }
}
