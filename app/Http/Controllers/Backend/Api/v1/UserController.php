<?php

namespace App\Http\Controllers\Backend\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Services\Backend\Interfaces\IUserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $IUserService)
    {
        $this->userService = $IUserService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->userService->generateToken($request);
    }
}
