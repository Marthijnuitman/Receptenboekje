<?php

namespace Database\Seeders;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\IngredientRecipe;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(10)->create();
        Ingredient::factory(10)->create();
        Recipe::factory(10)->create();
        IngredientRecipe::factory(10)->create();
    }
}
