<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;

class LogoutResponse extends Response
{
    /**
     * @param Request $request
     * @return string[]
     */
    public function toArray($request): array
    {
        return [
            'message' => 'Logged out',
        ];
    }
}
