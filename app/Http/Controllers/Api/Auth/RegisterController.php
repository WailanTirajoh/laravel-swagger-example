<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication endpoints"
 * )
 */
class RegisterController extends Controller
{
    /**
     * Register a new user.
     *
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register a new user",
     *     description="Registers a new user and returns a success message.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User created successfully"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="access_token",
     *                     type="string",
     *                     example="your-access-token"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={"email": {"Invalid credentials"}}
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unprocessable Entity"
     *             )
     *         )
     *     )
     * )
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create(array_merge(
            $request->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $accessToken = $user->createToken('access_token')->plainTextToken;

        return ApiResponse::success(
            message: 'User created successfully',
            data: ['access_token' => $accessToken],
            statusCode: Response::HTTP_CREATED
        );
    }
}
