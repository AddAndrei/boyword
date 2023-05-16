<?php

namespace App\Http\Requests\Rows;

use Illuminate\Foundation\Http\FormRequest;

class RowRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'sort'
            ]
        );
    }

    public function rules(): array
    {
        return [
            'sort' => 'string|required',
        ];
    }
}
