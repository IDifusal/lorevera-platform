<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\UserWeight;
use Illuminate\Support\Str;
use App\Mail\ResetCodeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    public function updateName(Request $request)
    {
        //validate name 
        $request->validate([
            'name' => 'required|string'
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        return response()->json(['message' => 'Name updated successfully'], 200);
    }
    public function addChargeWeight(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $currentDate = date('Y-m-d');
        // Validate the incoming request
        $validatedData = $request->validate([
            'weight' => 'required|numeric|min:1'
        ]);
    

    
        try {
            // Attempt to find an existing weight entry on the same date for this user
            $userWeight = UserWeight::where('user_id', $userId)->where('date', $currentDate)->first();
    
            if (!$userWeight) {
                // If no existing entry, create a new instance
                $userWeight = new UserWeight();
                $userWeight->user_id = $userId;
                $userWeight->date = $currentDate;
            }
    
            // Update (or set) the weight
            $userWeight->weight = $validatedData['weight'];
    
            // Save the entry
            if ($userWeight->save()) {
                return response()->json($userWeight, 200); // 200 OK or 201 Created can be used here
            } else {
                // In case saving fails for reasons other than validation
                return response()->json([
                    'message' => 'Failed to update the weight entry.',
                ], 500); // 500 Internal Server Error
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur and return a generic error response
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }
    public function completeProfile(Request $request)
    {
        $user = Auth::user();
    
        // Validate the incoming request
        $request->validate([
            'height.value' => 'required|numeric',
            'height.unit' => 'required|in:cm,ft',
            'weight.value' => 'required|numeric',
            'weight.unit' => 'required|in:kg,pounds',
            'gender' => 'required|string',
            'birthdayDate' => 'required|date',
        ]);
    
        // Store the actual value and the unit preference
        $user->update([
            'height' => $request->input('height.value'),
            'height_unit' => $request->input('height.unit'),
            'weight' => $request->input('weight.value'),
            'weight_unit' => $request->input('weight.unit'),
            'gender' => $request->gender,
            'birthdayDate' => $request->birthdayDate,
            'profile_status' => 'complete'
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
                'profile_status'=>  $user->profile_status,
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
    public function requestReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        try {
            $user = User::where('email', $request->email)->firstOrFail();
            $ip = $request->ip();
            $code = rand(100000, 999999);
            $name = $user->name;    
            DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                ['token' => $code, 'created_at' => now()]
            );
    
            Mail::to($user->email)->send(new ResetCodeEmail($code,$name,$ip));
    
            return response()->json(['message' => 'Reset code sent to your email.']);
    
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Email not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send reset code.'], 500);
        }
    }

    public function validateReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);
    
        $reset = DB::table('password_resets')
                    ->where('email', $request->email)
                    ->where('token', $request->code)
                    ->first();
    
        if (!$reset || now()->subMinutes(60)->gt($reset->created_at)) {
            return response()->json(['message' => 'Invalid or expired code.'], 422);
        }
    
        // Generate a secure token for the password change process
        $passwordChangeToken = Str::random(60);
        DB::table('password_resets')->where('email', $request->email)->update(['change_token' => $passwordChangeToken, 'token_expires_at' => now()->addMinutes(30)]);
    
        return response()->json(['message' => 'Code validated. Proceed to change password.', 'change_token' => $passwordChangeToken]);
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'change_token' => 'required',
            'password' => 'required|min:4',
        ]);
    
        try {
            $reset = DB::table('password_resets')
                        ->where('change_token', $request->change_token)
                        ->where('token_expires_at', '>', now())
                        ->first();
    
            if (!$reset) {
                return response()->json(['message' => 'Invalid or expired token.'], 422);
            }
    
            $user = User::where('email', $reset->email)->first();
            if (!$user) {
                // Handle the case where no user is found for the email
                return response()->json(['message' => 'User not found.'], 404);
            }
    
            $user->password = Hash::make($request->password);
            $user->save();
    
            // Clean up after successful password change
            DB::table('password_resets')->where('email', $reset->email)->delete();

            $token = $user->createToken('authToken')->plainTextToken;            
    
            return response()->json([
                'message' => 'Password has been successfully changed.',
                'token' => $token
            ]);
        } catch (Exception $e) {
            // Log the error for debugging purposes
            Log::error('Password change error: '.$e->getMessage());
    
            // Respond with a generic error message
            // Consider using a more specific status code based on the caught exception type if needed
            return response()->json(['message' => 'An error occurred while processing your request.'], 500);
        }
    }  
}