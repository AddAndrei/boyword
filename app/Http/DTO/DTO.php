<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class DTO extends DataTransferObject
{
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



}
