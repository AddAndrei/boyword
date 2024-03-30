<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UnbanUserRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                '*',
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*' => 'array|nullable',
            '*.*' => 'int|required',
        ];
    }
}
