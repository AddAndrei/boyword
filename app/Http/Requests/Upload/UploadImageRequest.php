<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'files',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'files' => 'array',
            'files.*.' => 'required|mimes:jpg,png,jpeg|max:2048'
        ];
    }
}
