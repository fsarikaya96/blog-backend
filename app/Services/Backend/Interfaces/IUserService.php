<?php

namespace App\Services\Backend\Interfaces;

use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\JsonResponse;

interface IUserService
{
    public function generateToken(LoginRequest $request): JsonResponse;
}
