<?php

namespace App\Repositories\Backend\Interfaces;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Collection;

interface IPostRepository
{
    public function index(): Collection;

    public function show(string $uuid);

    public function store($post);

    public function update(Post $post);

    public function destroy(Post $post);
}
