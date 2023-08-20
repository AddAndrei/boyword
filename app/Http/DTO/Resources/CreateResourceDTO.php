<?php

namespace App\Http\DTO\Resources;

use App\Http\DTO\DTO;

class CreateResourceDTO extends DTO
{
    public ?int $type_id;
    public string $title;
    public string $description;
}
