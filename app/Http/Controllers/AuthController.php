<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'height' => $request->height ?? '',
            'weight' => $request->weight ?? '',
            'gender' => $request->gender ?? '',
            'birthdayDate' => $request->dob ?? '',
        ]);

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => ['required', 'email', 'unique:users,email', 'regex:/^.+\.com$/i'],
                    'password' => 'required'
                ],
                [
                    'email.regex' => 'Enter a valid email .com',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validateUser->errors()->first(),
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'EMAIL_PASSWORD_WRONG',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => $user->name,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function loginUserWebsite(Request $request){
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );
    
            if ($validateUser->fails() ) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
    
            // Attempt to authenticate the user using the provided credentials
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'EMAIL_PASSWORD_WRONG',
                ], 401);
            }
    
            // Retrieve the authenticated user
            $user = Auth::user();
    
            // Check if the user has the admin flag set
            if ($user->isadmin != 1) {
                // If the user is not an admin, log them out and return an error response
                Auth::logout();
                return response()->json([
                    'status' => false,
                    'message' => 'ACCESS_DENIED_NOT_ADMIN',
                ], 403);
            }
    
            // If the user is an admin, proceed to return the success response
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => $user->name,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
    
    /**
     * Get the authenticated User.
     */
    public function me(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'errors' => [
                    'email' => [__('auth.not_found')],
                ],
            ], 401);
        }

        return $user;
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}