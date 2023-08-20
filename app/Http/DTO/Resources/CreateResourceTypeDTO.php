<?php

namespace App\Http\DTO\Resources;

use App\Http\DTO\DTO;

class CreateResourceTypeDTO extends DTO
{
    public string $title;
    public string $description;
}
