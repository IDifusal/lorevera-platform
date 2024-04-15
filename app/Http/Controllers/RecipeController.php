<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function listRecipesMobile()
    {
        $recipesMeat1 = Recipe::where(['plan'=>'meat_plan','goal'=>'loss_weight'])->get();
        
        $totalCalories1 = $recipesMeat1->sum('calories');
        $totalFat1 = $recipesMeat1->sum('fat');
        $totalCarbs1 = $recipesMeat1->sum('carbs');
        $totalProtein1 = $recipesMeat1->sum('protein');

        $recipesMeat2 = Recipe::where(['plan' => 'meat_plan'],['goal'=>'loss_weight'])->get();

        $totalCaloriesMeat2 = $recipesMeat2->sum('calories');
        $totalFatMeat2 = $recipesMeat2->sum('fat');
        $totalCarbsMeat2 = $recipesMeat2->sum('carbs');
        $totalProteinMeat2 = $recipesMeat2->sum('protein');


        
        $recipesVegetarian = Recipe::where(['plan'=> 'vegetarian_plan'],['goal'=>'loss_weight'])->get();

        $totalCaloriesVegetarian = $recipesVegetarian->sum('calories');
        $totalFatVegetarian = $recipesVegetarian->sum('fat');
        $totalCarbsVegetarian = $recipesVegetarian->sum('carbs');
        $totalProteinVegetarian = $recipesVegetarian->sum('protein');


        $recipesVegetarian2 = Recipe::where(['plan'=> 'vegetarian_plan'],['goal'=>'loss_weight'])->get();
        $totalCaloriesVegetarian2 = $recipesVegetarian2->sum('calories');
        $totalFatVegetarian2 = $recipesVegetarian2->sum('fat');
        $totalCarbsVegetarian2 = $recipesVegetarian2->sum('carbs');
        $totalProteinVegetarian2 = $recipesVegetarian2->sum('protein');





        return response()->json(
            [
                'meat_plan' => [
                    "loss_weight" => [
                        'recipes' => $recipesMeat1,
                        'total_macros' => [
                            'calories' => $totalCalories1,
                            'fat' => $totalFat1,
                            'carbs' => $totalCarbs1,
                            'protein' => $totalProtein1
                        ]
                    
                    ],
                    "gain_muscle" => [
                        'recipes' => $recipesMeat2,
                        'total_macros' => [
                            'calories' => $totalCaloriesMeat2,
                            'fat' => $totalFatMeat2,
                            'carbs' => $totalCarbsMeat2,
                            'protein' => $totalProteinMeat2
                        ]
                    ]
                ],
                'vegetarian_plan' => [
                    "loss_weight" => [
                        'recipes' => $recipesVegetarian,
                        'total_macros' => [
                            'calories' => $totalCaloriesVegetarian,
                            'fat' => $totalFatVegetarian,
                            'carbs' => $totalCarbsVegetarian,
                            'protein' => $totalProteinVegetarian
                        ]
                    ],
                    "gain_muscle" => [
                        'recipes' => $recipesVegetarian,
                        'total_macros' => [
                            'calories' => $totalCaloriesVegetarian2,
                            'fat' => $totalFatVegetarian2,
                            'carbs' => $totalCarbsVegetarian2,
                            'protein' => $totalProteinVegetarian2
                        ]
                    ]
                ]
            ]
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
