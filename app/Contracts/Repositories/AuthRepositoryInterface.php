<?php 

namespace App\Contracts\Repositories;

use App\Models\User;

interface AuthRepositoryInterface 
{
    public function register(array $payload): User;
}