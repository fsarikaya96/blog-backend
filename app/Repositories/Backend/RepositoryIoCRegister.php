<?php

namespace App\Repositories\Backend;

use App\Repositories\Backend\Implementations\AboutRepository;
use App\Repositories\Backend\Implementations\MetaRepository;
use App\Repositories\Backend\Implementations\PostRepository;
use App\Repositories\Backend\Implementations\TagRepository;
use App\Repositories\Backend\Implementations\UserRepository;
use App\Repositories\Backend\Interfaces\IAboutRepository;
use App\Repositories\Backend\Interfaces\IMetaRepository;
use App\Repositories\Backend\Interfaces\IPostRepository;
use App\Repositories\Backend\Interfaces\ITagRepository;
use App\Repositories\Backend\Interfaces\IUserRepository;

class RepositoryIoCRegister
{
    public static function register(): void
    {
        app()->bind(IUserRepository::class, UserRepository::class);
        app()->bind(IPostRepository::class, PostRepository::class);
        app()->bind(ITagRepository::class, TagRepository::class);
        app()->bind(IMetaRepository::class, MetaRepository::class);
        app()->bind(IAboutRepository::class, AboutRepository::class);
    }
}
