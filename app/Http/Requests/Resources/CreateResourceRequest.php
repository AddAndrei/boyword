<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class CreateResourceRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'type_id',
                'title',
                'description',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'type_id' => 'integer|nullable|min:1|not_in:0|exists:resources_types,id',
            'title' => 'string|required',
            'description' => 'string|required',
        ];
    }
}
