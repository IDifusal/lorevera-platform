<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LimitationController extends Controller
{
    public function listGoal()
    {
        try {
            $user = Auth::user();
            $goals = Goal::where('user_id', $user->id)->where('type','limitation')->get();
            return response()->json($goals, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to list the goals: ' . $e->getMessage()], 500);
        }
    }
    public function storeGoal(Request $request)
    {
        try {
            $request->validate([
                'limitation_name' => 'required|string|max:255',
            ]);
    
            $user = Auth::user();
            $goal = new Goal;
            $goal->name = $request->limitation_name;
            $goal->user_id = $user->id; 
            $goal->type = 'limitation';
            $goal->save();
    
            return response()->json($goal, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create the goal: ' . $e->getMessage()], 500);
        }
    }
    public function removeGoal($id)
    {
        try {
            $user = Auth::user();
            $goal = Goal::where('id', $id)->where('user_id', $user->id)->first();
    
            if (!$goal) {
                return response()->json(['error' => 'Goal not found or you do not have permission to delete this goal.'], 404);
            }
    
            $goal->delete();
            return response()->json(['message' => 'Goal removed successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to remove the goal: ' . $e->getMessage()], 500);
        }
    }   
    public function defaultValues()
    {
        return response()->json([
            'limitations' => [
                [
                    'name' => 'No cold drink',
                    'type' => 'limitation'
                ],
                [
                    'name' => 'No sugar',
                    'type' => 'limitation'
                ],
                [
                    'name' => 'Sleep less than 8 hours',
                    'type' => 'limitation'
                ],
                [
                    'name' => 'Recude Processed food',
                    'type' => 'limitation'
                ]                
            ],
            'goals'=>[
                [
                    'name' => 'Gain muscle',
                    'type' => 'goal'
                ],
                [
                    'name' => 'Learn how to meal properly',
                    'type' => 'goal'
                ],
                [
                    'name' => 'Do my workout',
                    'type' => 'goal'
                ],                                

            ]
        ]);
    } 
}
