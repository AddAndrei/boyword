<?php

namespace App\Http\Interfaces\Mediatr;

use App\Http\DTO\DTO;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Mediatr
{
    public function store(?DTO $dataTransferObject, ?Closure $closure): Model;

    public function all(?DTO $dataTransferObject, ?Closure $closure): Collection;

    public function update(int $id, DTO $dataTransferObject, ?Closure $closure): Model;

    public function get(string $field, mixed $value): Model;

    public function destroy(array $ids): void;
}
