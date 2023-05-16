<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Auth
 * @property string $email
 * @property string $password
 * @author Shcerbakov Andrei
 */
class LoginRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'email',
                'password',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'email' => 'string|required',
            'password' => 'string|required',
        ];
    }
}
