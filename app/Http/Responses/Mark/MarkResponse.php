<?php

namespace App\Http\Responses\Mark;

use App\Http\Responses\Response;
use App\Models\Mark\Mark;
use Illuminate\Http\Request;

class MarkResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Mark $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
        ];
    }
}
