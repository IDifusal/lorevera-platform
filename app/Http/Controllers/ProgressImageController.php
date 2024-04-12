<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressImage;
use Illuminate\Support\Facades\DB;
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
        $progressImages = ProgressImage::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json(
            [
                'data'=> $progressImages
            ]
        );
    }
    public function removeImage(Request $request, $id)
    {
        $user = auth()->user(); // Get the authenticated user
    
        // Wrap operations in a transaction for atomicity
        DB::beginTransaction();
        
        try {
            // Retrieve the progress image for the authenticated user
            $progressImage = ProgressImage::where('user_id', $user->id)->where('id', $id)->first();
    
            if (!$progressImage) {
                return response()->json(['message' => 'Progress image not found'], 404);
            }
    
            // $path = str_replace('storage/', 'public/', $progressImage->image_url);
            // if (Storage::exists($path)) {
            //     Storage::delete($path); // Ensure the file exists before attempting to delete
            // } else {
            //     throw new \Exception("File not found.");
            // }
    
            $progressImage->delete(); // Delete the progress image record
    
            DB::commit(); // Commit the transaction
    
            return response()->json(['message' => 'Progress image deleted'], 200);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction on error
            return response()->json(['message' => 'Failed to delete progress image: ' . $e->getMessage()], 500);
        }
    }
    
}
