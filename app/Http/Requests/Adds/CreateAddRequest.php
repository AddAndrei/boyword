<?php

namespace App\Http\Requests\Adds;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'title',
                'description',
                'price',
                'city_id',
                'mark_id',
                'model_id',
                'memory_id',
                'color_id',
                'category_id',
                'images',
                'city',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'description' => 'string|required',
            'price' => 'string|required',
            'city_id' => 'integer|nullable|exists:cities,id',
            'mark_id' => 'integer|nullable|exists:marks,id',
            'model_id' => 'integer|nullable|exists:models,id',
            'memory_id' => 'integer|nullable|exists:memories,id',
            'color_id' => 'integer|nullable|exists:colors,id',
            'category_id' => 'integer|required|exists:categories,id',
            'city' => 'string|nullable',
        ];
    }
}
