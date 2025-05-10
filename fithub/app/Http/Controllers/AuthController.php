<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Response;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,trainer,user'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return a JSON response with the errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);                        //unable to process the request
        }

        // If validation passes, create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        // Generating a token
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }






    //  Login User
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        //  Trainer needs to be approved 1st by the admin. 2 status - pending and approved
        $user = User::where('email', $request->email)->first();
        if ($user->status == 'pending' && $user->role == 'trainer') {
            return response()->json([
                'message' => 'Try again later'
            ], 403);
        }
        // Generating a token
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => 'Invalid credentials']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'role' => $user->role]);
    }
    

    //  Logout User
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
