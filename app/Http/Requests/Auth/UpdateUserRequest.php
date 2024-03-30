<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Auth
 * @property string|null $name
 * @property mixed|null $ban
 * @author Shcerbakov Andrei
 */
class UpdateUserRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'name',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'name' => 'string|nullable',
        ];
    }
}
