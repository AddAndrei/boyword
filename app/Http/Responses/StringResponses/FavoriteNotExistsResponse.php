<?php

namespace App\Http\Responses\StringResponses;

use App\Http\Responses\Response;
use Illuminate\Http\Request;

class FavoriteNotExistsResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'message' => 'error'
        ];
    }
}
