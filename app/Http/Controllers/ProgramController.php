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
    public function deletePackage($id)
    {
        $package = Program::find($id);
        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }
        $package->delete();
        //unlink 

        return response()->json(['message' => 'Package deleted'], 200);
    }
    public function storePackage(Request $request)
    {

        $package = new Program;
        $package->name = $request->name;
        $package->subtitle = $request->subtitle;
        $package->tag = $request->tag;
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
        $package->introduction = $request->introduction;

        $imagePathFeatured = null;
        $imagePathFocus = null;
        $imagePathBased = null;

    
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePathFeatured = $request->file('image')->storeAs('program', $fileName, 'public');
            $imagePathFeatured = str_replace('public/', '/storage/', $imagePathFeatured);
        }
        if ($request->hasFile('focus_image_url') && $request->file('focus_image_url')->isValid()) {
            $file = $request->file('focus_image_url');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePathFocus = $request->file('focus_image_url')->storeAs('program', $fileName, 'public');
            $imagePathFocus = str_replace('public/', '/storage/', $imagePathFocus); // Ajuste para obtener el path correcto
        }
        if ($request->hasFile('based_image_url') && $request->file('image')->isValid()) {
            $file = $request->file('based_image_url');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePathBased = $request->file('based_image_url')->storeAs('program', $fileName, 'public');
            $imagePathBased = str_replace('public/', '/storage/', $imagePathBased); // Ajuste para obtener el path correcto
        }                

        $package->is_public = false;
        $package->has_access = false;
        $package->featured_image = $imagePathFeatured;
        $package->focus_image_url = $imagePathFocus;
        $package->based_image_url = $imagePathBased;

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
    public function detailsPackageMobile($id)
    {
        // Retrieve the program with ordered weeks and days
        $program = Program::with([
            'weeks',
            'weeks.days',
            'weeks.days.workouts',
            'weeks.days.warmups',
        ])->find($id);

        if (!$program) {
            return response()->json(['error' => 'Program not found'], 404);
        }
        $features = [
            [
                'title'=>'duration_workout',
                'value'=> '30 min',
                'icon'=> '/images/duration_workout.svg'
            ],
            [
                'title'=>'duration_week',
                'value'=> '4 weeks',
                'icon'=> '/images/duration_week.svg'
            ],
            [
                'title'=>'focus',
                'value'=> $program->focus,
                'icon'=> $program->focus_image_url ?? "/images/focus_fullbody.svg"
            ],
            [
                'title'=>'based',
                'value'=> $program->based,
                'icon'=> $program->based_image_url ?? "/images/home_based.svg"
            ],

        ];
        $program->features = $features;
        $program->featured_image_url = $program->featured_image;
        $program->weeks[0]->group_title = '1-4';
        unset($program->featured_image);
        unset($program->focus);
        unset($program->based);
        unset($program->delete);
        unset($program->focus_image_url);
        unset($program->based_image_url);
        unset($program->duration_per_workout);
        unset($program->duration_per_week);
        return response()->json($program);
    }
}
