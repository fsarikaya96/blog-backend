<?php

namespace App\Services\Backend\Implementations;

use App\Http\Requests\User\LoginRequest;
use App\Repositories\Backend\Interfaces\IUserRepository;
use App\Services\Backend\Interfaces\IUserService;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class UserService implements IUserService
{
    protected IUserRepository $userRepository;

    public function __construct(protected IUserRepository $IUserRepository)
    {
        $this->userRepository = $IUserRepository;
    }

    /**
     * Get already logged user
     *
     * @return Authenticatable|null
     */
    private function _getLoggedUser(): ?Authenticatable
    {
        return Auth::user() ?? null;
    }

    /**
     * Generate token and login user
     */
    public function generateToken(LoginRequest $request): JsonResponse
    {

        Log::channel('api')->info("UserService called --> Request generateToken() function");
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $token = $this->userRepository->generateToken($this->_getLoggedUser());

                Log::channel('api')->info("UserService called --> Return generate token : " . $token);
                return ResponseResult::generate(true, ['user' => Auth::user(), 'token' => $token], ResponseCodes::HTTP_OK);
            }
            return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            Log::channel('api')->info("UserService called --> exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
