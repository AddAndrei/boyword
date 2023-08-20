<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceTypeRequest extends FormRequest
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
            'title' => 'string|nullable',
            'description' => 'string|nullable',
        ];
    }
}
