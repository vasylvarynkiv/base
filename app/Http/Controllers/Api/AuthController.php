<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     summary="Login user",
     *     description="This can only be done by the logged in user.",
     *     operationId="login",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="The user email for login",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth($this->guard)->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/me",
     *     tags={"Auth"},
     *     summary="Get user",
     *     description="Get the authenticated User",
     *     operationId="me",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     },
     * )
     */
    public function me()
    {
        return new UserResource(auth($this->guard)->user());
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     summary="Logout user",
     *     description="Log the user out (Invalidate the token).",
     *     operationId="logout",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     },
     * )
     */
    public function logout()
    {
        auth($this->guard)->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/refresh",
     *     tags={"Auth"},
     *     summary="Refresh user auth token",
     *     description="Refresh a token.",
     *     operationId="refresh",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     },
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }
}
