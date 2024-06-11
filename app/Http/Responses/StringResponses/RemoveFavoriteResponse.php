<?php

namespace App\Http\Responses\StringResponses;

use App\Http\Responses\Response;
use Illuminate\Http\Request;

class RemoveFavoriteResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'message' => 'Убрано из избранных'
        ];
    }
}
