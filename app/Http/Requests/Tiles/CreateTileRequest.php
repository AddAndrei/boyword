<?php

namespace App\Http\Requests\Tiles;

use Illuminate\Foundation\Http\FormRequest;

class CreateTileRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'image',
                'title',
                'width',
                'height',
                'collision',
                'event',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'image' => 'string|required',
            'title' => 'string|required',
            'width' => 'integer|required',
            'height' => 'integer|required',
            'collision' => 'boolean',
            'event' => 'string|nullable',
        ];
    }
}
