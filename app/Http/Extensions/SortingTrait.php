<?php

namespace App\Http\Extensions;

use App\Http\DTO\SortingDTO;
use Illuminate\Database\Eloquent\Builder;


trait SortingTrait
{
    public function scopeSortingByFields(Builder $query, SortingDTO $sortingDTO): Builder
    {
        if($sortingDTO->sort) {
            $orderBy = explode(':', $sortingDTO->sort);
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        return $query;
    }
}
