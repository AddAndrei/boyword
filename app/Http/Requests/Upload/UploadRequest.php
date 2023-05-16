<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
               'file',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'file' => 'required|mimes:xlsx,xls',
        ];
    }

}
