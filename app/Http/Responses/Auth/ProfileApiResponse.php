<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;
use App\Models\Auth\Profile;
use Illuminate\Http\Request;

class ProfileApiResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Profile $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'last_name' => $this->last_name,
            'birth_day' => $this->birth_day ? $this->birth_day->toIso8601String() : null,
            'image' => ($this->relationLoaded('image') && !is_null($this->image))
                ? $this->image->url
                : null,
            'rating' => $this->relationLoaded('rating')
                ? (($this->rating->count() > 0)
                    ? (double)($this->rating->sum('rate') / $this->rating->count())
                    : 0.00)
                : 0.00,
            'reviews' => $this->relationLoaded('reviews')
                ? $this->reviews->count()
                : 0,
            'balance' => ($this->relationLoaded('balance') && !is_null($this->balance))
                ? $this->balance->balance
                : 0.00,

        ];
    }
}
