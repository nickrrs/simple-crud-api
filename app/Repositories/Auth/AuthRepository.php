<?php

namespace App\Repositories\Auth;

use App\Contracts\Repositories\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $payload): User
    {
        $user = User::create(array_merge(
            $payload,
            ['password' => Hash::make($payload['password'])]
        ));
        return $user;
    }
}
