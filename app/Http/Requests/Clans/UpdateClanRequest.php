<?php

namespace App\Http\Requests\Clans;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClanRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only([
            'title',
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'string|nullable|min:8|max:255|unique:clans,title',
        ];
    }
}
