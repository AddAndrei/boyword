<?php

namespace App\Http\DTO\Clans;

use App\Http\DTO\DTO;

class CreateClanDTO extends DTO
{
    public string $title;
    public int $hero_id;
}
