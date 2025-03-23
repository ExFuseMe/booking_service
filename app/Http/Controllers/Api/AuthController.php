<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $validated = $request->validated();
        if (auth()->attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ])) {
            $user = auth()->user();
            return response()->json(['token' => $user->createToken('auth-token')->plainTextToken]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
