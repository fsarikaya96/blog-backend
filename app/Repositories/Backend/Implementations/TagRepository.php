<?php

namespace App\Repositories\Backend\Implementations;

use App\Models\Tag;
use App\Repositories\Backend\Interfaces\ITagRepository;
use Illuminate\Support\Collection;

class TagRepository implements ITagRepository
{
    public function findAll(): Collection
    {
        return Tag::query()->get();
    }

    public function find(string $uuid): ?Tag
    {
        /** @var Tag $tag */
        $tag = Tag::query()->where('uuid', '=', $uuid)->first();

        return $tag;
    }

    public function store(Tag $tag): Tag
    {
        $tag->save();

        return $tag;
    }

    public function update(Tag $tag): Tag
    {
        $tag->update();

        return $tag;
    }

    public function destroy(Tag $tag): bool
    {
        return $tag->delete();
    }
}
