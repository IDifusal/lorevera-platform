<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circumference;

class CircumferenceController extends Controller
{
    public function listCircumferences(Request $request){
        $user = auth()->user(); // Get the authenticated user
        $circumferences = Circumference::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return response()->json(
            $circumferences
        );
    }
    public function storeCircumference(Request $request){

        $request->validate([
            'value' => 'required|string',
            'type' => 'required|string',
        ]);
        $user = auth()->user(); // Get the authenticated user

        $circumference = Circumference::create([
            'user_id' => $user->id, // Use the authenticated user's ID
            'value' => $request->value,
            'type' => $request->type,
        ]);
        return response()->json($circumference, 201);
    }
}
