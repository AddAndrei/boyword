<?php

namespace App\Http\Requests\CityMarkModelColorVolumeRequest;

use Illuminate\Foundation\Http\FormRequest;

class AggregateUpdateRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'title',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'string|nullable',
        ];
    }
}
