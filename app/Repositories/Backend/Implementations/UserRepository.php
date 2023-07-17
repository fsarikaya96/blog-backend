<?php

namespace App\Repositories\Backend\Implementations;

use App\Http\Requests\User\LoginRequest;
use App\Repositories\Backend\Interfaces\IUserRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class UserRepository implements IUserRepository
{
    public function generateToken(Authenticatable $auth): string
    {
        return $auth->createToken('token')->plainTextToken;
    }
}
