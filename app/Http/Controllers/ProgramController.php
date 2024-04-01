<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function listPackages()
    {
        $packages = Program::all();
        return response()->json($packages, 200);
    }
    public function storePackage(Request $request)
    {
        info($request->daysWeek1);
        $package = new Program;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->featured_image = $request->featured_image;
        $package->is_public = $request->is_public;
        $package->has_access = $request->has_access;
        $package->focus_image_url = $request->focus_image_url;
        $package->based_image_url = $request->based_image_url;
        $package->duration_per_workout = $request->duration_per_workout;
        $package->duration_per_week = $request->duration_per_week;
        $package->focus = $request->focus;
        $package->based = $request->based;
        $package->overview = $request->overview;

        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('program', $fileName, 'public');
            $imagePath = str_replace('public/', '/storage/', $imagePath); // Ajuste para obtener el path correcto
        }
        $package->is_public = false;
        $package->has_access = false;
        $package->featured_image = $imagePath;

        $package->save();
        $weekKeys = json_decode($request->input('weekKeys'), true);

        foreach ($weekKeys as $weekData) {
            foreach ($weekData as $weekKey => $dayIds) {
                // Extract the week number from the key (e.g., 'daysWeek1' -> 1)
                $weekNumber = intval(substr($weekKey, 8)); // Adjust based on your key format
                
                // Create a week associated with this program/package
                $week = $package->weeks()->create([
                    'week_number' => $weekNumber
                ]);
                
                // Attach days to the week
                foreach ($dayIds as $dayId) {
                    $week->days()->attach($dayId); // Attach dayId to the week
                }
            }
        }
        
        $package->load('weeks.days');



        return response()->json($package, 201);
    }

    public function detailsPackage($id)
    {
        // Retrieve the program with ordered weeks and days
        $program = Program::with([
            'weeks' => function ($query) {
                // $query->orderBy('week_number', 'asc');
            },
            'weeks.days' => function ($query) {
                // $query->orderBy('id'); 
            }
        ])->find($id);

        if (!$program) {
            return response()->json(['error' => 'Program not found'], 404);
        }

        return response()->json($program);
    }
}
