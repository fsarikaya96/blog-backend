<?php

namespace App\Services\Backend;

use App\Services\Backend\Implementations\AboutService;
use App\Services\Backend\Implementations\PageSettingService;
use App\Services\Backend\Implementations\PostService;
use App\Services\Backend\Implementations\ProjectService;
use App\Services\Backend\Implementations\TagService;
use App\Services\Backend\Implementations\UserService;
use App\Services\Backend\Interfaces\IAboutService;
use App\Services\Backend\Interfaces\IPageSettingService;
use App\Services\Backend\Interfaces\IPostService;
use App\Services\Backend\Interfaces\IProjectService;
use App\Services\Backend\Interfaces\ITagService;
use App\Services\Backend\Interfaces\IUserService;

class ServiceIoCRegister
{
    public static function register(): void
    {
        app()->bind(IUserService::class, UserService::class);
        app()->bind(IPostService::class, PostService::class);
        app()->bind(ITagService::class, TagService::class);
        app()->bind(IAboutService::class, AboutService::class);
        app()->bind(IProjectService::class, ProjectService::class);
        app()->bind(IPageSettingService::class, PageSettingService::class);
    }
}
