<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function listRecipesMobile()
    {
        $activeRecipes = Recipe::get();

        return response()->json(
            $activeRecipes,
        );
    }
    public function listRecipesMeat()
    {

        $recipes = Recipe::where('plan', 'meat_plan')->get();

        return response()->json(
            $recipes
        );
    }
    public function listRecipesVegetarian()
    {

        $recipes = Recipe::where('plan', 'vegetarian_plan')->get();

        return response()->json(
            $recipes
        );
    }
    public function storeRecipe(Request $request)
    {
        $recipe = new Recipe;
        $recipe->calories = $request->calories;
        $recipe->fat = $request->fat;
        $recipe->carbs = $request->carbs;
        $recipe->protein = $request->protein;
        $recipe->plan = $request->plan;
        $recipe->goal = $request->goal;
        $recipe->ingredients = $request->ingredients;
        
        $recipe->save();
        
        return response()->json($recipe, 201);
    }
    public function updateRecipe(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $recipe->calories = $request->calories;
        $recipe->fat = $request->fat;
        $recipe->carbs = $request->carbs;
        $recipe->protein = $request->protein;
        $recipe->plan = $request->plan;
        $recipe->goal = $request->goal;
        $recipe->ingredients = $request->ingredients;
        
        $recipe->save();

        return response()->json($recipe, 200);
    }
    public function deleteRecipe($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();

        return response()->json("Deleted", 200);
    }
    public function detailsRecipe($id)
    {
        $recipe = Recipe::find($id);

        return response()->json($recipe);
    }
}
