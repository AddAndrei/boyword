<?php

namespace App\Http\Responses\Rows;

use App\Http\Responses\Response;
use App\Models\Upload\Row;
use Illuminate\Http\Request;

class RowResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Row $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'date' => $this->date ? $this->date->toIso8601String() : null,
        ];
    }
}
