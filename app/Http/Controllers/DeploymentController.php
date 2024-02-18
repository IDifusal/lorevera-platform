<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeploymentController extends Controller
{
    public function gitPull(Request $request)
    {
        // Access the token sent in the request body
        $token = $request->input('token');

        if ($token !== env('DEPLOY_TOKEN')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $output = null;
        $resultCode = null;
        exec('cd /public_html/app/ && git pull 2>&1', $output, $resultCode);
        return response()->json(['output' => $output, 'resultCode' => $resultCode]);
    }
}
