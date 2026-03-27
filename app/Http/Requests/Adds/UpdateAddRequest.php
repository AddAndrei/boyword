<?php

namespace App\Http\Requests\Adds;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddRequest extends FormRequest
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
                'status',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'string|nullable',
            'description' => 'string|nullable',
            'price' => 'string|nullable',
            'city_id' => 'integer|nullable|exists:cities,id',
            'mark_id' => 'integer|nullable|exists:marks,id',
            'model_id' => 'integer|nullable|exists:models,id',
            'memory_id' => 'integer|nullable|exists:memories,id',
            'color_id' => 'integer|nullable|exists:colors,id',
            'status' => 'string|nullable|in:unconfirmed,confirmed,denied,reviewing'
        ];
    }
}
