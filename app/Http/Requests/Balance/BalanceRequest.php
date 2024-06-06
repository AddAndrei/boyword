<?php

namespace App\Http\Requests\Balance;

use Illuminate\Foundation\Http\FormRequest;

class BalanceRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'rate',
                'operator',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'rate' => 'string|required',
            'operator' => 'string|required',
        ];
    }
}
