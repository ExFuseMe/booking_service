<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

/**
 * @OA\Components(
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer"
 *     )
 * )
 * )
 *
 */
class AuthController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Авторизация",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                @OA\Schema(ref="#/components/schemas/AuthRequestSchema",),
     *           ),
     *      ),
     *     @OA\Response(response="200", description="Login successful", @OA\JsonContent(
     *         ref="#/components/schemas/AuthResponseSchema"
     *     )),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
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
