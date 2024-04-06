<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DeploymentController extends Controller
{
    public $request_token = "kZn24BEuvovbamyp";
    public function gitPull(Request $request)
    {
        // Access the token sent in the request body
        $token = $request->input('token');

        if ($token !== $this->request_token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $output = null;
        $resultCode = null;
        exec("git pull https://github.com/IDifusal/lorevera-platform", $output, $resultCode);
        return response()->json(['output' => $output, 'resultCode' => $resultCode]);
    }
    public function optimizeRouter (Request $request)
    {
        $token = $request->input('token');
        if ($token !== $this->request_token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        Artisan::call('optimize');
        return response()->json(['message' => 'Routes cached successfully']);
    }
    public function clearCache(Request $request)
    {
        $token = $request->input('token');
        if ($token !== $this->request_token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Clear the application cache 
        Artisan::call('cache:clear');

        return response()->json(['message' => 'Cache cleared successfully']);
    }

    public function runMigrate(Request $request)
    {
        $token = $request->input('token');
        if ($token !== $this->request_token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Run the migrations
        Artisan::call('migrate', ['--force' => true]);

        return response()->json(['message' => 'Migrations run successfully']);
    }    
    public function runMigrateFresh(Request $request)
    {
        $token = $request->input('token');
        if ($token !== $this->request_token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);

        return response()->json(['message' => 'Database has been refreshed and seeded successfully']);
    }    
}
