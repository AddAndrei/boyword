<?php

namespace App\Http\Services;

use App\Http\DTO\DTO;
use App\Http\Interfaces\Mediatr\AllableInterface;
use App\Http\Interfaces\Mediatr\DestroyableInterface;
use App\Http\Interfaces\Mediatr\GetableInterface;
use App\Http\Interfaces\Mediatr\StorableInterface;
use App\Http\Interfaces\Mediatr\UpdateableInterface;
use App\Models\BaseModel;
use Closure;
use Illuminate\Database\Eloquent\Collection;

class Service implements StorableInterface,
                         AllableInterface,
                         UpdateableInterface,
                         GetableInterface,
                         DestroyableInterface
{

    public function store(BaseModel $model, DTO $dto = null, Closure $closure = null): BaseModel
    {
        $model = new $model();
        if ($closure) {
            $model = $closure($model);
        }

        if ($dto) {
            $model->propagateFromDTO($dto);
        }
        $model->save();
        return $model;
    }

    public function get(string $field, mixed $value, BaseModel $model): BaseModel
    {
        return $model::where($field, $value)->first();
    }

    public function all(BaseModel $model, DTO $dto = null, Closure $closure = null): Collection
    {
        if ($closure) {
            $model = $closure($model);
        }
        return $model;
    }

    public function update(int $id, BaseModel $model, DTO $dto, Closure $closure = null): BaseModel
    {
        $model = $model::find($id);
        if ($closure) {
            $model = $closure($model);
        }

        $model->propagateFromDTO($dto)->save();
        return $model;
    }

    public function destroy(BaseModel $model, array $ids): void
    {
        $model::destroy($ids);
    }
}
