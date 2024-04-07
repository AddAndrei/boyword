<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only([
            'title',
            'description',
            'resource_type_id',
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'string|required|max:150',
            'description' => 'string|required|min:8',
            'resource_type_id' => 'integer|required|exists:resources_types,id',
        ];
    }
}
