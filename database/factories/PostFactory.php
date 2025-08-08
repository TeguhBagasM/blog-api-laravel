<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6, true),
            'content' => fake()->paragraphs(3, true),
            'author' => fake()->name(),
            'is_published' => fake()->boolean(70), // 70% kemungkinan true
        ];
    }
}