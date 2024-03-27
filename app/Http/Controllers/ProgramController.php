<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function listPackages ()
    {
        $packages = Program::all();
        return response()->json($packages, 200);
    }
    public function storePackage (Request $request)
    {

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

        return response()->json($package, 201);
    }
}
