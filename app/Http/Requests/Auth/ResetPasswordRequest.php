<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'phone',
                'password',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'phone' => 'string|required',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'password.min' => 'Пароль должен быть 6 или более символов',
        ];
    }
}
