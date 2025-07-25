<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'        => fake()->sentence(3),
            'description'  => fake()->paragraph(),
            'instructions' => fake()->paragraphs(3, true),
            'prep_time'    => fake()->numberBetween(5, 30),
            'cook_time'    => fake()->numberBetween(10, 60),
            'servings'     => fake()->numberBetween(1, 6),
            'user_id'      => fake()->numberBetween(1, 10),
            'category_id'  => fake()->numberBetween(1, 5),
        ];
    }
}

