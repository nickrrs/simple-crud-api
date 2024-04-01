<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Traits\HandleExceptionResponse;
use Exception;

class AuthController extends Controller
{
    use HandleExceptionResponse;
    
    public function __construct(private AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(AuthRegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->register($request->validated());
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ]);
        } catch(Exception $e) {
            return $this->handleException($e);
        }
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        try {
            return $this->authService->login($request->validated());
        } catch (Exception $e) {
            Log::error("[Error on login route]", [
                'message' => $e->getMessage()
            ]);
            return $this->handleException($e);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            return $this->authService->logout();
        } catch (Exception $e) {
            Log::error("[Error on logout route]", [
                'message' => $e->getMessage()
            ]);
            return $this->handleException($e);
        }
    }
}
