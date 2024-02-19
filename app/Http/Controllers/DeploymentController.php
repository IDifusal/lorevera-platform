<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DeploymentController extends Controller
{
    public function gitPull(Request $request)
    {
        // Access the token sent in the request body
        $token = $request->input('token');

        if ($token !== env('REQUEST_TOKEN')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $output = null;
        $resultCode = null;
        exec("git pull https://github.com/IDifusal/lorevera-platform", $output, $resultCode);
        return response()->json(['output' => $output, 'resultCode' => $resultCode]);
    }
    public function clearCache(Request $request)
    {
        $token = $request->input('token');
        if ($token !== env('REQUEST_TOKEN')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Clear the application cache
        Artisan::call('cache:clear');

        return response()->json(['message' => 'Cache cleared successfully']);
    }

    public function runMigrate(Request $request)
    {
        $token = $request->input('token');
        if ($token !== env('REQUEST_TOKEN')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Run the migrations
        Artisan::call('migrate', ['--force' => true]);

        return response()->json(['message' => 'Migrations run successfully']);
    }    
}
