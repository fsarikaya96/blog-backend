<?php

namespace App\Repositories\Backend;

use App\Repositories\Backend\Implementations\UserRepository;
use App\Repositories\Backend\Interfaces\IUserRepository;

class RepositoryIoCRegister
{
    public static function register(): void
    {
        app()->bind(IUserRepository::class, UserRepository::class);
    }
}
