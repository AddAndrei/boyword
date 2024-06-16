<?php

namespace App\Http\Requests\Messages;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'receiver_id',
                'message',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'receiver_id' => 'integer|required',
            'message' => 'string|required',
        ];
    }
}
