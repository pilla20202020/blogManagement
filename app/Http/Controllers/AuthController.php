<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->errorResponse('Invalid credentials', 401);
        }
        $user = auth('api')->user();
        $userData = [
            'id'       => $user->id,
            'name'     => $user->name,
            'email'    => $user->email,
            'is_admin' => $user->is_admin,
        ];
        return $this->successResponse([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'user'         => $userData,
        ], 'Login successful');
    }

    public function me()
    {
        return $this->successResponse(auth('api')->user(), 'User details');
    }

    public function logout()
    {
        auth('api')->logout();
        return $this->successResponse(null, 'Logged out successfully');
    }
}
