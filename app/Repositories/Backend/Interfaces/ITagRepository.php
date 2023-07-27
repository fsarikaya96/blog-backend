<?php

namespace App\Repositories\Backend\Interfaces;

use App\Models\Tag;
use Illuminate\Support\Collection;

interface ITagRepository
{
    public function findAll(): Collection;

    public function find(string $uuid): ?Tag;

    public function store(Tag $tag): Tag;

    public function update(Tag $tag): Tag;

    public function destroy(Tag $tag): bool;
}
