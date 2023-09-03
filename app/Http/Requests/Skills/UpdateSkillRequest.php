<?php

namespace App\Http\Requests\Skills;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only([
            'level',
            'experience',
            'attack_speed',
            'damage',
            'skill_type',
            'parent_id',
        ]);
    }

    public function rules(): array
    {
        return [
            'level' => 'integer|nullable|min:1|not_in:0',
            'experience' => 'integer|nullable|min:1|not_in:0',
            'attack_speed' => 'float|nullable|not_in:0',
            'damage' => 'integer|nullable|min:1|not_in:0',
            'skill_type' => 'string|nullable',
            'parent_id' => 'integer|nullable|min:1|not_in:0|exists:skills,id',
        ];
    }
}
