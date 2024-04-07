<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'title' => 'string|nullable|max:150',
            'description' => 'string|nullable|min:8',
            'resource_type_id' => 'integer|nullable|exists:resources_types,id',
        ];
    }
}
