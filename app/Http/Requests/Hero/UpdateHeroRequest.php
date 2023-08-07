<?php

namespace App\Http\Requests\Hero;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'name',
                'min_damage',
                'max_damage',
                'health_points',
                'mana_points',
                'weapon',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'name' => 'string|nullable',
            'min_damage' => 'integer|nullable|min:1|not_in:0',
            'max_damage' => 'integer|nullable|min:1|not_in:0',
            'health_points' => 'integer|nullable|min:1|not_in:0',
            'mana_points' => 'integer|nullable|min:1|not_in:0',
            'weapon' => 'string|nullable',
        ];
    }
}
