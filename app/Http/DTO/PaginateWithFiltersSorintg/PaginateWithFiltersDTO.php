<?php

namespace App\Http\DTO\PaginateWithFiltersSorintg;

use App\Http\DTO\DTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PaginateWithFiltersDTO extends DTO
{
    public ?int $per_page;
    public ?int $page;
    public ?Collection $filters;
    public ?Collection $sorting;

    public static function createFromRequest(Request $request): static
    {
        /** @var PaginateWithFiltersRequest $request */
        return new static([
            'per_page' => $request->per_page,
            'page' => $request->page,
            'filters' => $request->filters ? FilterAndSortingDTO::collection($request->filters) :  null,
            'sorting' => $request->sorting ? FilterAndSortingDTO::collection($request->sorting) : null,
        ]);
    }
}
