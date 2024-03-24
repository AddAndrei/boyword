<?php

namespace App\Http\Responses;

use http\Client\Request;

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
