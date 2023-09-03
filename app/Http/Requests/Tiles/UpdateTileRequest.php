<?php

namespace App\Http\Requests\Tiles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTileRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
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
            'title' => 'string|nullable',
            'width' => 'integer|nullable',
            'height' => 'integer|nullable',
            'collision' => 'boolean|nullable',
            'event' => 'string|nullable',
        ];
    }
}
