<?php

namespace App\Http\Responses\Category;

use App\Http\Responses\Response;
use App\Models\Categories\Category;
use Illuminate\Http\Request;

class CategoryResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Category $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
        ];
    }
}
