<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;
use App\Models\Auth\Rating;
use Illuminate\Http\Request;

class RatingResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Rating $this */
        return [
            'id' => $this->getKey(),
            'rate' => $this->rate,
        ];
    }
}
