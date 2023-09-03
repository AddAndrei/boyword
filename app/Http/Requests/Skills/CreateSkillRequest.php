<?php

namespace App\Http\Requests\Skills;

use Illuminate\Foundation\Http\FormRequest;

class CreateSkillRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only([
            'skill_type',
            'parent_id',
        ]);
    }

    public function rules(): array
    {
        return [
            'skill_type' => 'required|string',
            'parent_id' => 'integer|nullable|min:1|not_in:0|exists:skills,id',
        ];
    }
}
