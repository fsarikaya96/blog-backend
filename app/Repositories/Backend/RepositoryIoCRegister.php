<?php

namespace App\Repositories\Backend;

use App\Repositories\Backend\Implementations\PostRepository;
use App\Repositories\Backend\Implementations\UserRepository;
use App\Repositories\Backend\Interfaces\IPostRepository;
use App\Repositories\Backend\Interfaces\IUserRepository;

class RepositoryIoCRegister
{
    public static function register(): void
    {
        app()->bind(IUserRepository::class, UserRepository::class);
        app()->bind(IPostRepository::class, PostRepository::class);
    }
}
