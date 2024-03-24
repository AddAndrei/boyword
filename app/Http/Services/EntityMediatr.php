<?php

namespace App\Http\Services;

use App\Http\DTO\DTO;
use App\Http\Interfaces\Mediatr\Mediatr;
use App\Models\BaseModel;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EntityMediatr implements Mediatr
{
    public function __construct(private BaseModel $model, private Service $service)
    {
    }

    public function store(DTO $dataTransferObject = null, ?Closure $closure = null): Model
    {
        return $this->service->store($this->model, $dataTransferObject, $closure);
    }

    public function all(?DTO $dataTransferObject = null, ?Closure $closure = null): Collection|LengthAwarePaginator
    {
        return $this->service->all($this->model, $dataTransferObject, $closure);
    }

    public function update(int $id, DTO $dataTransferObject, ?Closure $closure = null): Model
    {
        return $this->service->update($id, $this->model, $dataTransferObject, $closure);
    }

    public function get(string $field, mixed $value, ?Closure $closure = null): Model
    {
        return $this->service->get($field, $value, $this->model, $closure);
    }

    public function destroy(array $ids): void
    {
        $this->service->destroy($this->model, $ids);
    }
}
