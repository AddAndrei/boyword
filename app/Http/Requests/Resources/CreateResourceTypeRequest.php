<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class CreateResourceTypeRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'title',
                'description',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'description' => 'string|required',
        ];
    }
}
