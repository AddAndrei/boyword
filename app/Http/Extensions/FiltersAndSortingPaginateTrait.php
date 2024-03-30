<?php

namespace App\Http\Extensions;

use App\Exceptions\AnotherExceptions\MethodNotExistsInClassException;
use App\Http\DTO\PaginateWithFiltersSorintg\FilterAndSortingDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * @method paginateWithFilters(Builder $builder, PaginateWithFiltersDTO $DTO)
 */
trait FiltersAndSortingPaginateTrait
{
    /** @var string */
    private string $prefixMethodName = 'by';

    /**
     * @param Builder $builder
     * @param PaginateWithFiltersDTO $dto
     * @return Builder|LengthAwarePaginator|Collection
     * @throws \Exception
     */
    public function scopePaginateWithFilters(
        Builder $builder,
        PaginateWithFiltersDTO $dto
    ): Builder|LengthAwarePaginator|Collection {
        if ($dto->filters) {
            foreach ($dto->filters as $filter) {
                /** @var FilterAndSortingDTO $filter */
                $functionName = $this->prefixMethodName . ucfirst($filter->field);
                if (!method_exists($this, $functionName)) {
                    throw new MethodNotExistsInClassException($this->getNameOfClass(), $functionName);
                }
                $builder = call_user_func_array([$this, $functionName], [$builder, $filter->value]);
            }
        }
        if ($dto->sorting) {
            foreach ($dto->sorting as $sorting) {
                /** @var FilterAndSortingDTO $sorting */
                $builder->orderBy($sorting->field, $sorting->value);
            }
        }
        if ($dto->per_page) {
            return $builder->paginate($dto->per_page);
        }
        return $builder->get();
    }

    public function getNameOfClass(): string
    {
        return get_called_class();
    }
}
