<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;

class DeletedResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [

        ];
    }
}
