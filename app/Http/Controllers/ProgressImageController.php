<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProgressImageController extends Controller
{

    public function storeImage(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'image' => 'required|image', // Validate the image upload
        ]);

        $user = auth()->user(); // Get the authenticated user

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('/progress_images');
            $path = str_replace('public/', '', $path);
            $path = Storage::url($path);

            $progressImage = ProgressImage::create([
                'user_id' => $user->id, // Use the authenticated user's ID
                'type' => $request->type,
                'image_url' => $path, // Generate a URL to the stored image
            ]);

            return response()->json($progressImage, 201);
        }

        return response()->json(['message' => 'Invalid image upload'], 400);
    }
    public function listImages(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user

        // Retrieve the progress images for the authenticated user
        $progressImages = ProgressImage::where('user_id', $user->id)->get();

        return response()->json(
            [
                'data'=> $progressImages
            ]
        );
    }
}
