<?php

namespace App\Http\DTO\Items;

use App\Http\DTO\DTO;

class CreateItemDTO extends DTO
{
    public string $title;
    public string $description;
    public int $resource_type_id;
}
