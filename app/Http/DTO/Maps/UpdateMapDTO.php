<?php

namespace App\Http\DTO\Maps;

use App\Http\DTO\DTO;

class UpdateMapDTO extends DTO
{
    public ?string $title;
    public ?string $tiles;
}
