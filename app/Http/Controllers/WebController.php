<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class WebController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return response()->json(
            ['users' => $users]
        );
    }

}
