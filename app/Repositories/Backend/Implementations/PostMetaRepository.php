<?php

namespace App\Repositories\Backend\Implementations;

use App\Models\PostMeta;
use App\Repositories\Backend\Interfaces\IPostMetaRepository;

class PostMetaRepository implements IPostMetaRepository
{
    public function find(int $post_id): ?PostMeta
    {
        /** @var PostMeta $post_meta */
        $post_meta = PostMeta::query()->where('post_id', '=', $post_id)->first();

        return $post_meta;
    }

    public function store(PostMeta $postMeta): PostMeta
    {
        $postMeta->save();

        return $postMeta;
    }

    public function update(PostMeta $postMeta): PostMeta
    {
        $postMeta->update();

        return $postMeta;
    }
}
