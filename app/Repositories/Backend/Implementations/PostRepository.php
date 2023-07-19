<?php

namespace App\Repositories\Backend\Implementations;

use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Repositories\Backend\Interfaces\IPostRepository;
use Illuminate\Support\Collection;

class PostRepository implements IPostRepository
{

    public function findAll(): Collection
    {
        return Post::query()->get();
    }

    public function find(string $uuid): ?Post
    {
        /** @var Post $post */
        $post = Post::query()->where('uuid', '=', $uuid)->first();

        return $post;
    }

    public function store(Post $post): Post
    {
        $post->save();

        return $post;
    }

    public function update(Post $post): Post
    {
        $post->update();

        return $post;
    }

    public function destroy(Post $post): bool
    {
        return $post->delete();
    }

}
