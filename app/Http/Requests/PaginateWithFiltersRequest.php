<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PaginateWithFiltersRequest
 * @package App\Http\Requests
 * @property int|null $per_page
 * @property int|null $page
 * @property array|null $filters
 * @property array|null $sorting
 * @author Shcerbakov Andrei
 */
class PaginateWithFiltersRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'per_page',
                'page',
                'filters',
                'sorting',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'per_page' => 'integer|nullable',
            'page' => 'integer|nullable',
            'filters.*' => 'nullable|array',
            'filter.*.' => 'json|in:field, value',
            'sorting.*' => 'nullable|array',
            'sorting.*.' => 'json|in:field,value',
        ];
    }
}
