<?php

namespace App\Http\Requests\Maps;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'title',
                'tiles',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'string|nullable',
            'tiles' => 'string|nullable',
        ];
    }
}
