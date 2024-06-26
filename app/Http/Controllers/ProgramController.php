<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function listPackages()
    {
        $packages = Program::all();
        foreach ($packages as $program) {
            unset($package->exercises_groups);
            $program->featured_image_url = $program->featured_image;
            $program->package_name = $program->name;
            $program->pre_name = $program->subtitle;
            $program->program_introduction = $program->introduction;
            $program->shop_features = $this->convertFeaturesToArray($program->shop_features);            
            foreach ($program->weeks as $week) {
                $week->group_title = '1-4';
            }
            unset($program->subtitle);
            unset($program->name);
            unset($program->featured_image);
            unset($program->focus);
            unset($program->based);
            unset($program->delete);
            unset($program->focus_image_url);
            unset($program->based_image_url);
            unset($program->duration_per_workout);
            unset($program->duration_per_week);            
            unset($program->weeks);            
            $features = [
                [
                    'title'=>'Workout',
                    'value'=> '30 min',
                    'icon'=> 'https://app.lorevera.com/images/duration_workout.svg'
                ],
                [
                    'title'=>'Per Week',
                    'value'=> '4 weeks',
                    'icon'=> 'https://app.lorevera.com/images/duration_week.svg'
                ],
                [
                    'title'=>'Focus',
                    'value'=> $program->focus,
                    'icon'=> $program->focus_image_url ?? "https://app.lorevera.com/images/focus_fullbody.svg"
                ],
                [
                    'title'=>'Based',
                    'value'=> $program->based,
                    'icon'=> $program->based_image_url ?? "https://app.lorevera.com/images/home_based.svg"
                ],
    
            ];
            $program->features = $features;            
        }
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
            $imagePathFeatured = Storage::url($imagePathFeatured);
        }
        if ($request->hasFile('focus_image_url') && $request->file('focus_image_url')->isValid()) {
            $file = $request->file('focus_image_url');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePathFocus = $request->file('focus_image_url')->storeAs('program', $fileName, 'public');
            $imagePathFocus = str_replace('public/', '/storage/', $imagePathFocus);
            $imagePathFocus = Storage::url($imagePathFocus);
        }
        if ($request->hasFile('based_image_url') && $request->file('image')->isValid()) {
            $file = $request->file('based_image_url');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePathBased = $request->file('based_image_url')->storeAs('program', $fileName, 'public');
            $imagePathBased = str_replace('public/', '/storage/', $imagePathBased); 
            $imagePathBased = Storage::url($imagePathBased);
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
            'weeks.days.equipment',
        ])->find($id);
    
        if (!$program) {
            return response()->json(['error' => 'Program not found'], 404);
        }
    
        // Check if the program is a favorite
        $programFavorite = $program->favorites()->where('user_id', auth()->id())->first();
        $program->is_favorite = !!$programFavorite;
        $program->favorite_id = $programFavorite ? $programFavorite->id : null;
    
        // Add other program-specific properties
        $program->features = $this->getFeatures($program);
        $program->featured_image_url = $program->featured_image;
        $program->package_name = $program->name;
        $program->pre_name = $program->subtitle;
        $program->program_introduction = $program->introduction;       
        $program->shop_features = $this->convertFeaturesToArray($program->shop_features);
        foreach ($program->weeks as $week) {
            $week->group_title = '1-4';
            foreach ($week->days as $day) {
                // Check each day for favorite status
                $dayFavorite = $day->favorites()->where('user_id', auth()->id())->first();
                $day->is_favorite = !!$dayFavorite;
                $day->favorite_id = $dayFavorite ? $dayFavorite->id : null;
            }
        }
    
        // Clean up response
        $this->unsetProgramAttributes($program);
    
        return response()->json($program);
    }
    private function convertFeaturesToArray($featuresString)
    {
        // Check if the string is null or empty
        if (empty($featuresString)) {
            return [];
        }
    
        // Ensure the string is of the correct type
        if (!is_string($featuresString)) {
            error_log('Expected a string for features, received: ' . gettype($featuresString));
            return [];
        }
    
        return explode(';', $featuresString);
    }
    private function getFeatures($program)
    {
        return [
            [
                'title'=>'Workout',
                'value'=> '30 min',
                'icon'=> 'https://app.lorevera.com/images/duration_workout.svg'
            ],
            [
                'title'=>'Per Week',
                'value'=> '4 weeks',
                'icon'=> 'https://app.lorevera.com/images/duration_week.svg'
            ],
            [
                'title'=>'Focus',
                'value'=> $program->focus,
                'icon'=> $program->focus_image_url ?? "https://app.lorevera.com/images/focus_fullbody.svg"
            ],
            [
                'title'=>'Based',
                'value'=> $program->based,
                'icon'=> $program->based_image_url ?? "https://app.lorevera.com/images/home_based.svg"
            ],
        ];
    }
    
    private function unsetProgramAttributes($program)
    {
        unset(
            $program->featured_image, 
            $program->focus, 
            $program->based, 
            $program->delete, 
            $program->focus_image_url, 
            $program->based_image_url, 
            $program->duration_per_workout, 
            $program->duration_per_week
        );
    }
    
}
