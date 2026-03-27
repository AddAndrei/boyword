<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var User $this */
        return [
            'id' => $this->getKey(),
            'profile' => $this->relationLoaded('profile')
                ? ProfileApiResponse::make($this->profile)
                : null,
            'adds' => $this->relationLoaded('adds')
                ? $this->adds->count()
                : null,
        ];
    }
}
