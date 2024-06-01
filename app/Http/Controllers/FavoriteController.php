<?php

namespace App\Http\Controllers;

use App\Models\UserFavorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request)
    {
        // Define a mapping from simple type strings to full model class names
        $typeMap = [
            'program' => 'App\Models\Program',
            'day' => 'App\Models\Day'
        ];
    
        $request->validate([
            'favoritable_id' => 'required',
            'favoritable_type' => 'required|in:program,day' // Accept simpler type names
        ]);
    
        // Convert the simple type name to a fully qualified class name
        $favoritableType = $typeMap[$request->favoritable_type] ?? null;
        
        if (!$favoritableType) {
            return response()->json(['message' => 'Invalid favoritable type provided'], 422);
        }
    
        $favorite = UserFavorite::create([
            'user_id' => auth()->id(),
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $favoritableType
        ]);
    
        return response()->json(['message' => 'Favorite added successfully', 'favorite' => $favorite]);
    }
    public function removeFavorite($id)
    {
        $favorite = UserFavorite::where('id', $id)
                                ->where('user_id', auth()->id()) 
                                ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorite removed successfully']);
    }    
}
