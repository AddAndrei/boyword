<?php

namespace App\Http\DTO\Tiles;

use App\Http\DTO\DTO;

class UpdateTileDTO extends DTO
{
    public ?string $title;
    public ?int $width;
    public ?int $height;
    public ?bool $collision;
    public ?string $event;
}
