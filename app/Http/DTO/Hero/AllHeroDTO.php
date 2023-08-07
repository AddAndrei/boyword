<?php

namespace App\Http\DTO\Hero;

use App\Http\DTO\DTO;

class AllHeroDTO extends DTO
{
    public int|string|null $id;

    public static function createFromUser(int|string|null $id): static
    {
        return new static([
            'id' => $id
        ]);
    }
}
