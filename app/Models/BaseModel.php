<?php

namespace App\Models;

use App\Http\DTO\DTO;
use App\Http\DTO\FilterDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\FilterAndSortingDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class BaseModel
 * @package App\Models
 * @method paginateWithFilters(PaginateWithFiltersDTO $paginateWithFiltersDTO)
 * @author Shcerbakov Andrei
 */
class BaseModel extends Model
{
    /** @var string */
    private const PREFIX_METHOD_NAME = 'by';

    /**
     * Заполнение аттрибутов
     *
     * @param DTO $data
     * @return $this
     */
    public function propagateFromDTO(DTO $data): self
    {
        foreach ($data->toArray() as $field => $value) {
            $this->$field = $value;
        }
        return $this;
    }

    /**
     * @param Builder $builder
     * @param FilterDTO $DTO
     * @return Builder
     */
    public function scopeFiltrate(Builder $builder, FilterDTO $DTO): Builder
    {
        if ($DTO->filter) {
            $filter = explode(':', $DTO->filter);
            return $builder->where("{$filter[0]}", $filter[1]);
        }
        return $builder;
    }

    /**
     * @param DTO $DTO
     * @param array $relations
     * @return void
     */
    public function updateRelations(DTO $DTO, array $relations): void
    {
        foreach ($relations as $key => $relation) {
            if ($DTO->{$key}) {
                if (is_null($DTO->{$key})) {
                    $this->{$relation['method']}()->dissociate();
                } else {
                    $relationEntity = $relation['entity']::find($DTO->{$key});
                    $this->{$relation['method']}()->associate($relationEntity);
                }
            }
        }
    }

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
                $functionName = self::PREFIX_METHOD_NAME . ucfirst($filter->field);
                if (!method_exists($this, $functionName)) {
                    $className = $this->getNameOfClass();
                    throw new \Exception("Method $functionName in $className is not exists!");
                }
                return call_user_func_array([$this, $functionName], [$builder, $filter->value])->get();
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
