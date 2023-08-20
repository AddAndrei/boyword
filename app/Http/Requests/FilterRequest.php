<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'filter',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'filter' => 'string|nullable',
        ];
    }
}
