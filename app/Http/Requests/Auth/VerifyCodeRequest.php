<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'numberPhone',
                'code',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'numberPhone' => 'string|required',
            'code' => 'required|integer|min:4',
        ];
    }
}
