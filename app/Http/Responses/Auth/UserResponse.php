<?php

namespace App\Http\Responses\Auth;
use App\Http\Responses\Response;
use App\Models\User;
use Illuminate\Http\Request;


class UserResponse extends Response
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
            'token' => $this->token,
            'profile' => $this->relationLoaded('profile')
                ? ProfileResponse::make($this->profile)
                : null,
        ];
    }
}
