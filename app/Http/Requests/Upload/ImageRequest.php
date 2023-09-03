<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'image',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'image' => 'required|mimes:png,jpeg',
        ];
    }
}
