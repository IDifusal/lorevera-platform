<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeploymentController extends Controller
{
    public function gitPull(Request $request)
    {
        // Access the token sent in the request body
        $token = $request->input('token');

        if ($token !== "kZn24BEuvovbamyp") {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $output = null;
        $resultCode = null;
        exec("git pull https://github.com/IDifusal/lorevera-platform", $output, $resultCode);
        return response()->json(['output' => $output, 'resultCode' => $resultCode]);
    }
}
