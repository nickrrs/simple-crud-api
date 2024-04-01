<?php

namespace App\Services\Auth;

use App\Contracts\Services\AuthServiceInterface;
use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class AuthService implements AuthServiceInterface
{
    public function __construct(private AuthRepository $authRepository)
    {
    }

    public function register(array $payload): User
    {
        return $this->authRepository->register($payload);
    }

    public function login(array $payload): JsonResponse
    {
        if (! $token = Auth::guard('api')->attempt($payload)) {
            throw new AuthorizationException('Wrong credentials', 401);
        }
        
        return $this->createNewToken($token);
    }

    public function logout(): JsonResponse
    {
        Auth::guard('api')->logout();
        return response()->json([
            'message' => 'User successfully signed out'
        ]);
    }

    public function refresh(): JsonResponse
    {
        return $this->createNewToken(Auth::guard('api')->refresh());
    }

    protected function createNewToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => Auth::guard('api')->user()
        ]);
    }
}
