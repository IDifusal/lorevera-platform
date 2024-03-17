<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DaysController extends Controller
{
    public function list()
    {
        $items = Day::get();
        return response()->json(
            $items
        );
    }
    public function details($id)
    {
        $item = Day::with('equipment')->find($id);
    
        if ($item) {
            $exercises = $item->exercises()->get(); 
            $item->warmups = $exercises->where('type', 'warmup')->values();
            $item->workouts = $exercises->where('type', 'workout')->values();
            unset($item->exercises);
        }
    
        return response()->json($item);
    }
    public function store(Request $request)
    {
        // Start a transaction to ensure atomicity
        DB::beginTransaction();
    
        try {
            $request->validate([
                'title' => 'required|string',
            ]);
    
            $item = new Day;
            $item->title = $request->title;
            $item->description = $request->content;
            $item->save();
    
            if (!empty($request->equipment)) {
                $equipmentIds = json_decode($request->input('equipment', '[]'), true);
                $item->equipment()->attach($equipmentIds);
            }
    
            if (!empty($request->warmUp)) {     
                $warmupIds = json_decode($request->input('warmUp', '[]'), true);
                $item->exercises()->attach($warmupIds);
            }
            if (!empty($request->workout)) {
                $workoutIds = json_decode($request->input('workout', '[]'), true);
                $item->exercises()->attach($workoutIds);
            }
    
            DB::commit(); // Commit the transaction
    
            $item->load('equipment', 'exercises'); // Reload to include relationships
            return response()->json($item);
        } catch (Exception $e) {
            DB::rollBack(); // Roll back the transaction on error
            return response()->json(['message' => 'Failed to create the day: ' . $e->getMessage()], 500);
        }
    }
    public function delete($id)
    {
        $item = Day::find($id);
        if ($item) {
            $item->equipment()->detach();
            $item->exercises()->detach();
            $item->delete();
            return response()->json(['message' => 'Day deleted']);
        } else {
            return response()->json(['message' => 'Day not found!'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        // Start a transaction to ensure atomicity
        DB::beginTransaction();
    
        try {
            $request->validate([
                'title' => 'required|string',
            ]);
    
            $item = Day::find($id);
            if ($item) {
                $item->title = $request->title;
                $item->description = $request->content;
                $item->save();
    
                if (!empty($request->equipment)) {
                    $equipmentIds = json_decode($request->input('equipment', '[]'), true);
                    $item->equipment()->sync($equipmentIds);
                }
    
                if (!empty($request->warmUp)) {
                    $warmupIds = json_decode($request->input('warmUp', '[]'), true);
                    $item->exercises()->sync($warmupIds);
                }
                if (!empty($request->workout)) {
                    $workoutIds = json_decode($request->input('workout', '[]'), true);
                    $item->exercises()->sync($workoutIds);
                }
    
                DB::commit();
    
                $item->load('equipment', 'exercises'); 
                return response()->json($item);
            } else {
                return response()->json(['message' => 'Day not found!'], 404);
            }
        } catch (Exception $e) {
            DB::rollBack(); // Roll back the transaction on error
            return response()->json(['message' => 'Failed to update the day: ' . $e->getMessage()], 500);
        }
    }
}