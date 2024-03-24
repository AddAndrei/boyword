<?php

namespace App\Http\Interfaces\Mediatr;

use App\Http\DTO\DTO;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface Mediatr
{
    public function store(?DTO $dataTransferObject, ?Closure $closure): Model;

    public function all(?DTO $dataTransferObject, ?Closure $closure): Collection|LengthAwarePaginator;

    public function update(int $id, DTO $dataTransferObject, ?Closure $closure): Model;

    public function get(string $field, mixed $value, ?Closure $closure): Model;

    public function destroy(array $ids): void;
}
