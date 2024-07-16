<?php

namespace App\Http\DTO\Review;

use App\Http\DTO\DTO;

class CreateReviewDTO extends DTO
{
    public ?int $rate;
    public string $review;
}
