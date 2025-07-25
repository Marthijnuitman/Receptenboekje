<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ImageController;

Route::get('/', [RecipeController::class, 'index']);

Route::get('/home', [RecipeController::class, 'index'])->name('home');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/recipes/eigen', [RecipeController::class, 'showOwnRecipes'])->name('recipes.eigen');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::put('/recipes/{id}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::get('/recipes/edit/{id}', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

    Route::delete('/image/{id}/{receptid}', [ImageController::class, 'destroy'])->name('recipes.photos.destroy');
});

Route::get('/recipes/all', [RecipeController::class, 'showAll'])->name('recipes.all');
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');

