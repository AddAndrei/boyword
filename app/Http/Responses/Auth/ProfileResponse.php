<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;
use App\Models\Auth\Profile;
use Illuminate\Http\Request;

class ProfileResponse extends Response
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
        ];
    }
}
