<?php

namespace App\Http\Requests\Tiles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTileRequest extends FormRequest
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
            'image' => 'string|nullable',
            'title' => 'string|nullable',
            'width' => 'integer|nullable',
            'height' => 'integer|nullable',
            'collision' => 'boolean|nullable',
            'event' => 'string|nullable',
        ];
    }
}
