<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\saveUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(saveUserRequest $request)
    {
        try {
            $data = $request->validated();

            $user =  User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $token = $user->createToken('Plain Token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Register successful',
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (\Throwable $th) {
            Log::error('user creation failed', ['error' => $th->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'server error'
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = User::where('email', $validated['email'])
                ->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials'
                ], 422);
            }

            $token = $user->createToken('Plain Token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (\Throwable $th) {
            Log::error('login failed', ['error' => $th->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'server error'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'successfully logged out'
            ], 200);
        } catch (\Throwable $th) {
            Log::error('logout failed', ['error' => $th->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'server error'
            ], 500);
        }
    }
}
