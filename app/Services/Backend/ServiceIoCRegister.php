<?php

namespace App\Services\Backend;

use App\Services\Backend\Implementations\UserService;
use App\Services\Backend\Interfaces\IUserService;

class ServiceIoCRegister
{
    public static function register(): void
    {
        app()->bind(IUserService::class, UserService::class);
    }
}
