<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\saveUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use ApiResponse;
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

            $data = [
                'user' => $user,
                'token' => $token
            ];

            return $this->successResponse($data, 'Register successful');
        } catch (\Throwable $th) {
            Log::error('user creation failed', ['error' => $th->getMessage()]);
            return $this->errorResponse("server error", 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = User::where('email', $validated['email'])
                ->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return $this->errorResponse('Invalid credentials', 401);
            }

            $token = $user->createToken('Plain Token')->plainTextToken;

            $data = [
                'user' => $user,
                'token' => $token
            ];
            return $this->successResponse($data, 'Login successful');
        } catch (\Throwable $th) {
            Log::error('login failed', ['error' => $th->getMessage()]);
            return $this->errorResponse("server error", 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return $this->successResponse(null, 'successfully logged out');
        } catch (\Throwable $th) {
            Log::error('logout failed', ['error' => $th->getMessage()]);
            return $this->errorResponse("server error", 500);
        }
    }
}
