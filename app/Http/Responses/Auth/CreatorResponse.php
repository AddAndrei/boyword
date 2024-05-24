<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;
use App\Models\User;
use Illuminate\Http\Request;

class CreatorResponse extends Response
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
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
