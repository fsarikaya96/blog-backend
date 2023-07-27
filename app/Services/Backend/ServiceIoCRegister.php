<?php

namespace App\Services\Backend;

use App\Services\Backend\Implementations\PostService;
use App\Services\Backend\Implementations\TagService;
use App\Services\Backend\Implementations\UserService;
use App\Services\Backend\Interfaces\IPostService;
use App\Services\Backend\Interfaces\ITagService;
use App\Services\Backend\Interfaces\IUserService;

class ServiceIoCRegister
{
    public static function register(): void
    {
        app()->bind(IUserService::class, UserService::class);
        app()->bind(IPostService::class, PostService::class);
        app()->bind(ITagService::class, TagService::class);
    }
}
