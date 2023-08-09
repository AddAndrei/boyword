<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
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
            '*.*' => 'integer'
        ];
    }
}
