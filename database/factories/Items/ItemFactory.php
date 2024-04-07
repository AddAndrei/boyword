<?php

namespace Database\Factories\Items;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->realText(),
            'resource_type_id' => rand(3, 6),
        ];
    }
}
