<?php

namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'rate',
                'review',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'rate' => 'integer|nullable',
            'review' => 'string|required',
        ];
    }
}
