<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

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
