<?php

namespace App\Http\Requests\Clans;

use Illuminate\Foundation\Http\FormRequest;

class CreateClanRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only([
            'title',
            'hero_id',
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'string|required|min:8|max:255|unique:clans,title',
            'hero_id' => 'integer|required|exists:heroes,id',
        ];
    }
}
