<?php

namespace App\Http\DTO\Tasks;

use App\Http\DTO\DTO;

class CreateDTO extends DTO
{
    public string $title;
    public string $content;
    public string $start_date;
    public string $end_date;
}
