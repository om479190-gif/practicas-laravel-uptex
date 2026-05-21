<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Genera una palabra única para el nombre y una oración para la descripción
            'name' => fake()->unique()->word(),
            'description' => fake()->sentence(),
        ];
    }
}