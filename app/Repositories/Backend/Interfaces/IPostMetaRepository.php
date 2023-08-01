<?php

namespace App\Repositories\Backend\Interfaces;

use App\Models\PostMeta;

interface IPostMetaRepository
{
    public function find(int $post_id): ?PostMeta;

    public function store(PostMeta $postMeta): PostMeta;

    public function update(PostMeta $postMeta): PostMeta;
}
