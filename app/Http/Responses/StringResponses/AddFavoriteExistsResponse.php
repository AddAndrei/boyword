<?php

namespace App\Http\Responses\StringResponses;

use App\Http\Responses\Response;
use Illuminate\Http\Request;

class AddFavoriteExistsResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'message' => 'Уже в избранных'
        ];
    }
}
