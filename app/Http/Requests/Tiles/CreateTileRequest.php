<?php

namespace App\Http\Requests\Tiles;

use Illuminate\Foundation\Http\FormRequest;

class CreateTileRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'title',
                'width',
                'height',
                'collision',
                'eventType',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'width' => 'integer|required',
            'height' => 'integer|required',
            'collision' => 'boolean',
            'event' => 'string|nullable',
        ];
    }
}
