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
                // dd($warmupIds);
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
}