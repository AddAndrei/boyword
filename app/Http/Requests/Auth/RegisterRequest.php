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
                'phone',
                'password',
                'name',
                'last_name',

            ]
        );
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'phone' => 'string|required',
            'password' => 'string|required',
            'last_name' => 'string|required',
        ];
    }
}
