<?php

namespace App\Repositories\Backend\Interfaces;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Collection;

interface IPostRepository
{
    public function findAll(): Collection;

    public function find(string $uuid): ?Post;

    public function store(Post $post): Post;

    public function update(Post $post): Post;

    public function destroy(Post $post): bool;
}
