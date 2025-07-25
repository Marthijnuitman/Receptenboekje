<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('index', compact('recipes'));
    }

    public function showAll() {
        $recipes = Recipe::all();
        return view('recipes.showAll', compact('recipes'));
    }

    public function create() {
        $categories = Category::all(); // Haal alle categorieën op
        return view('recipes.create', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'required|integer|min:0',
            'cook_time' => 'required|integer|min:0',
            'servings' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $recipe = Recipe::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructions' => $validated['instructions'],
            'prep_time' => $validated['prep_time'],
            'cook_time' => $validated['cook_time'],
            'servings' => $validated['servings'],
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('recipes', 'public'); // opslag in storage/app/public/recipes
                Image::create([
                    'url' => $path,
                    'recipe_id' => $recipe->id,
                ]);
            }
        }

        return redirect()->route('home')->with('success', 'Recept aangemaakt!');
    }

    public function show(string $id){
        
        $recipe = Recipe::with('images')->findOrFail($id);

        return view('recipes.show', compact('recipe'));
    }

    public function showOwnRecipes() {
        $recipes = Recipe::with('images')->where('user_id', Auth::id())->get(); // haalt het ID direct op van de ingelogde user

        return view('recipes.eigen', compact('recipes'));
    }

    public function edit(string $id) {
        $recipe = Recipe::with('images')->findOrFail($id);
        $categories = Category::all(); // Haal alle categorieën op
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, string $id, Recipe $recipe ) {
        // 1. Validatie
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'required|integer|min:0',
            'cook_time' => 'required|integer|min:0',
            'servings' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 2. Recept bijwerken
        $recipe->update($validated);

        // 3. Afbeeldingen uploaden (optioneel)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('recipes', 'public'); // opslag in /storage/app/public/recipes
                Image::create([
                    'url' => $path,
                    'recipe_id' => $id,
                ]);
            }
        }

        return redirect()->route('recipes.edit', $id)
                        ->with('success', 'Recept bijgewerkt.');
    }

    public function destroy(string $id) {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return redirect()->route('recipes.eigen')->with('success', 'Recept verwijderd!');
    }
}
