<?php

namespace App\Http\DTO\Resources;

use App\Http\DTO\DTO;

class UpdateResourceTypeDTO extends DTO
{
    public ?string $title;
    public ?string $description;
}
