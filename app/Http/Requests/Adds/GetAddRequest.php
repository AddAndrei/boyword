<?php

namespace App\Http\Requests\Adds;

use Illuminate\Foundation\Http\FormRequest;

class GetAddRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'device_id',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'device_id' => 'string|nullable',
        ];
    }
}
