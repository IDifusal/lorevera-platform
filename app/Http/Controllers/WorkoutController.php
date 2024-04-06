<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkoutController extends Controller
{
    public function list()
    {
        $equipment = Exercise::where('type', 'warmup')->get();
        return response()->json(
            $equipment
        );
    }
    public function listWorkout()
    {
        $equipment = Exercise::where('type', 'workout')->get();
        return response()->json(
            $equipment
        );
    }    
    public function details($id)
    {
        $equipment = Exercise::find($id);
        if ($equipment) {
            return response()->json($equipment);
        } else {
            return response()->json(['message' => 'Equipment not found!'], 404);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'reps' => 'required|integer',
            'sets' => 'required|integer',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Asegura validación para imagen
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('exercises', $fileName, 'public');

             $imagePath = str_replace('public/', '/storage/', $imagePath); // Ajuste para obtener el path correcto
             $imagePath = Storage::url($imagePath);
        }
    
        $videoPath = null;
        
        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            $file = $request->file('video');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $videoPath = $request->file('video')->storeAs('exercises', $fileName, 'public');
            $videoPath = str_replace('public/', '/storage/', $videoPath);
            $videoPath = Storage::url($videoPath);
        }
    
        $equipment = new Exercise;
        $equipment->name = $request->name;
        $equipment->reps = $request->reps;
        $equipment->sets = $request->sets;
        $equipment->type = $request->type ?? 'workout';
        $equipment->image_url = $imagePath; // No necesitas el operador null coalescing aquí
        $equipment->video_url = $videoPath; 
        $equipment->description = $request->content;
        $equipment->save();
    
        return response()->json(['message' => 'Equipment created successfully!', 'equipment' => $equipment]);
    }

    public function delete($id)
    {
        $equipment = Exercise::find($id);
        if ($equipment) {
            if ($equipment->image_url) {
                Storage::disk('public')->delete($equipment->image_url);
            }
            $equipment->delete();
            return response()->json(['message' => 'Exercise deleted successfully!']);
        } else {
            return response()->json(['message' => 'Exercise not found!'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $equipment = Exercise::find($id);
        if ($equipment) {
            $equipment->name = $request->name;
            if($request->remove_image == true){
                $equipment->featured_image_url = null;
            }
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($equipment->featured_image_url) {
                    Storage::disk('public')->delete($equipment->featured_image_url);
                }
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $request->file('image')->storeAs('equipment', $fileName, 'public');
                $path = str_replace('public/', '', $path);
                $equipment->featured_image_url = $path;
            }

            $equipment->save();
            return response()->json(['message' => 'Equipment updated successfully!', 'equipment' => $equipment]);
        } else {
            return response()->json(['message' => 'Equipment not found!'], 404);
        }
    }
}
