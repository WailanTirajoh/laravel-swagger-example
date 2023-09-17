<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication endpoints"
 * )
 */
class LoginController extends Controller
{
    /**
     * Login.
     *
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login",
     *     description="Logs in a user with valid credentials and returns a token.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Success login"),
     *             @OA\Property(property="access_token", type="string", example="your-access-token")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", example={"email": {"Invalid credentials"}}),
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     )
     * )
     */
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'email' => [
                        'Invalid credentials',
                    ]
                ],
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $accessToken = Auth::user()->createToken('access_token')->plainTextToken;

        return response()->json([
            'message' => 'Success login',
            'access_token' => $accessToken,
        ], Response::HTTP_OK);
    }
}
