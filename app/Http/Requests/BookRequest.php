<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'name',
                'year',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'name' => 'string|nullable',
            'year' => 'date|nullable',
        ];
    }
}
