<?php

namespace App\Http\DTO\Maps;

use App\Http\DTO\DTO;

class CreateMapDTO extends DTO
{
    public ?string $title;
    public ?string $tiles;
}
