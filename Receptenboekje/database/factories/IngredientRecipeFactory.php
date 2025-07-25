<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientRecipeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'recipe_id'     => fake()->numberBetween(1, 5),
            'ingredient_id' =>  fake()->numberBetween(1, 10),
            'quantity'      => fake()->numberBetween(1, 500) . ' gram',
        ];
    }
}

