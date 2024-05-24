<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateCodeRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'numberPhone',
                'action',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'numberPhone' => 'string|required',
            'action' => 'required|integer|in:1,2',
        ];
    }
}
