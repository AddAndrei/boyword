<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
/**
 * Class RegisterRequest
 * @package App\Http\Requests\Auth
 * @property string $email
 * @property string $password
 * @property string $password_confirmation
 * @author Shcerbakov Andrei
 */
class RegisterRequest extends FormRequest
{

    public function validationData(): array
    {
        return $this->only(
            [
                'email',
                'password',
                'name',
                'password_confirmation',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'email' => 'string|required|unique:users,email',
            'password' => 'string|required|confirmed',
            'password_confirmation' => 'string|required',
        ];
    }
}
