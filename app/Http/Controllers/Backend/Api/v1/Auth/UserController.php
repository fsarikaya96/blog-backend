<?php

namespace App\Http\Controllers\Backend\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Services\Backend\Interfaces\IUserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class UserController extends Controller
{
    protected IUserService $userService;

    public function __construct(IUserService $IUserService)
    {
        $this->userService = $IUserService;
    }

    public function login(LoginRequest $request)
    {
        return $this->userService->generateToken($request);
    }
}
