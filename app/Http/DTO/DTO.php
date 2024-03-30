<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Support\Collection;

class DTO extends DataTransferObject
{
    /**
     * @param Request $request
     * @return static
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public static function createFromRequest(Request $request): static
    {
        $dto = new static(
            $request->all()
        );
        if ($request->keys()) {
            return $dto->only(...$request->keys());
        }
        return $dto->except(...array_keys($dto->all()));
    }

    /**
     * @param array $array
     * @return Collection
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public static function collection(array $array): Collection
    {
        $collection = new Collection();
        foreach ($array as $key => $value) {
            $static = new static([
                ...$value
            ]);
            $collection->push($static);
        }
        return $collection;
    }

    public static function createFromArray(array $array): static
    {
        return new static([...$array]);
    }
}
