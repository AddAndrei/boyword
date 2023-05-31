<?php

namespace App\Http\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class BookDTO extends DTO
{
    public ?string $name;

    public ?string $year;
}
