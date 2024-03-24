<?php

namespace App\Http\Requests\NPC;

use Illuminate\Foundation\Http\FormRequest;

class CreateNpcRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only([
            'name',
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
