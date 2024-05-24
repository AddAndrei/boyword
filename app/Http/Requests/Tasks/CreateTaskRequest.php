<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property string $content
 * @property string $start_date
 * @property string $end_date
 */
class CreateTaskRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'title',
                'content',
                'start_date',
                'end_date',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'content' => 'string|required',
            'start_date' => 'date|required',
            'end_date' => 'date|required',
        ];
    }
}
