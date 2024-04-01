<?php

namespace App\Contracts\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface AuthServiceInterface
{
    public function register(array $payload): User;
    public function login(array $payload): JsonResponse;
    public function logout(): JsonResponse;
    public function refresh(): JsonResponse;
}
