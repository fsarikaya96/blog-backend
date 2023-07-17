<?php

namespace App\Repositories\Backend\Interfaces;

use App\Http\Requests\User\LoginRequest;
use Illuminate\Contracts\Auth\Authenticatable;

interface IUserRepository
{
    public function generateToken(Authenticatable $auth): string;
}
