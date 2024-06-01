<?php

namespace App\Http\DTO\Adds;

use App\Http\DTO\DTO;

class CreateAddDTO extends DTO
{
    public string $title;
    public string $description;
    public string $price;
    public ?int $city_id;
    public ?int $mark_id;
    public ?int $model_id;
    public ?int $memory_id;
    public ?int $color_id;
    public int $category_id;
}
