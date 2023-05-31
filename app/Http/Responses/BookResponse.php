<?php

namespace App\Http\Responses;

use App\Models\Books\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Book $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'year' => $this->year,

        ];
    }
}
