<?php

namespace App\Http\Requests\Hero;

use Illuminate\Foundation\Http\FormRequest;

class HeroCreateRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'name',
                'hero_class',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'hero_class' => 'in:warrior,elf,wizard|required',
        ];
    }
}
