<?php

namespace App\Repositories\Backend\Implementations;

use App\Models\PostMeta;
use App\Repositories\Backend\Interfaces\IPostMetaRepository;

class PostMetaRepository implements IPostMetaRepository
{
    public function store(PostMeta $postMeta): PostMeta
    {
        $postMeta->save();

        return $postMeta;
    }
}
