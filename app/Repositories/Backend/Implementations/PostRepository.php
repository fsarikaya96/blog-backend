<?php

namespace App\Repositories\Backend\Implementations;

use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Repositories\Backend\Interfaces\IPostRepository;
use Illuminate\Support\Collection;

class PostRepository implements IPostRepository
{

    public function index(): Collection
    {
        return Post::query()->get();
    }

    public function show(string $uuid)
    {
        return Post::query()->where('uuid', '=', $uuid)->first();
    }

    public function store($post): Post
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
