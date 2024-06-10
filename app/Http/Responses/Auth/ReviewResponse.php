<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;
use App\Models\Auth\Rating;
use App\Models\Reviews\Review;
use Illuminate\Http\Request;

class ReviewResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Review $this */
        return [
            'id' => $this->getKey(),
            'text' => $this->review,
            'date' => $this->created_at ? $this->created_at->toIso8601String() : null,
            'user' => $this->relationLoaded('user')
                ? UserProfileResponse::make($this->user)
                : null,
        ];
    }
}
