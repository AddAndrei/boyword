<?php

namespace App\Http\DTO\Resources;

use App\Http\DTO\DTO;

class UpdateResourceDTO extends DTO
{
    public ?int $type_id;
    public ?string $title;
    public ?string $description;
}
