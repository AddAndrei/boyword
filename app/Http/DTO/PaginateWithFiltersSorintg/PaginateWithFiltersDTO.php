<?php

namespace App\Http\DTO\PaginateWithFiltersSorintg;

use App\Http\DTO\DTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PaginateWithFiltersDTO extends DTO
{
    private static int $perPage = 10;
    public ?int $per_page;
    public ?int $page;
    public ?Collection $filters;
    public ?Collection $sorting;

    public static function createFromRequest(Request $request): static
    {
        $filters = (is_string($request->filters)) ? json_decode($request->filters, true) : $request->filters;
        $sorting = (is_string($request->sorting)) ? json_decode($request->sorting, true) : $request->sorting;
        /** @var PaginateWithFiltersRequest $request */
        return new static([
            'per_page' => ($request->per_page) ?? self::$perPage,
            'page' => $request->page,
            'filters' => $request->filters ? FilterAndSortingDTO::collection($filters) : null,
            'sorting' => $request->sorting ? FilterAndSortingDTO::collection($request->sorting) : null,
        ]);
    }
}
