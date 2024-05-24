<?php

namespace App\Http\Responses\Model;

use App\Http\Responses\Response;
use App\Models\Models\Model;
use Illuminate\Http\Request;

class ModelResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Model $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
        ];
    }
}
