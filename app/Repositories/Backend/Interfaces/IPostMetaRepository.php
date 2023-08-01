<?php

namespace App\Repositories\Backend\Interfaces;

use App\Models\PostMeta;

interface IPostMetaRepository
{
    public function store(PostMeta $postMeta): PostMeta;
}
