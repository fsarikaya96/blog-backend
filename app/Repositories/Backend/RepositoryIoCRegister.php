<?php

namespace App\Repositories\Backend;

use App\Repositories\Backend\Implementations\AboutRepository;
use App\Repositories\Backend\Implementations\PageSettingRepository;
use App\Repositories\Backend\Implementations\PostMetaRepository;
use App\Repositories\Backend\Implementations\PostRepository;
use App\Repositories\Backend\Implementations\ProjectImageRepository;
use App\Repositories\Backend\Implementations\ProjectRepository;
use App\Repositories\Backend\Implementations\TagRepository;
use App\Repositories\Backend\Implementations\UserRepository;
use App\Repositories\Backend\Interfaces\IAboutRepository;
use App\Repositories\Backend\Interfaces\IPageSettingRepository;
use App\Repositories\Backend\Interfaces\IPostMetaRepository;
use App\Repositories\Backend\Interfaces\IPostRepository;
use App\Repositories\Backend\Interfaces\IProjectImageRepository;
use App\Repositories\Backend\Interfaces\IProjectRepository;
use App\Repositories\Backend\Interfaces\ITagRepository;
use App\Repositories\Backend\Interfaces\IUserRepository;

class RepositoryIoCRegister
{
    public static function register(): void
    {
        app()->bind(IUserRepository::class, UserRepository::class);
        app()->bind(IPostRepository::class, PostRepository::class);
        app()->bind(ITagRepository::class, TagRepository::class);
        app()->bind(IPostMetaRepository::class, PostMetaRepository::class);
        app()->bind(IAboutRepository::class, AboutRepository::class);
        app()->bind(IProjectRepository::class, ProjectRepository::class);
        app()->bind(IProjectImageRepository::class, ProjectImageRepository::class);
        app()->bind(IPageSettingRepository::class, PageSettingRepository::class);
    }
}
