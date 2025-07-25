<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IngredientRecipe extends Model
{
    use HasFactory;

    protected $table = 'ingredient_recipe';

    protected $fillable = [
        'recipe_id',
        'ingredient_id',
        'quantity',
    ];
}

