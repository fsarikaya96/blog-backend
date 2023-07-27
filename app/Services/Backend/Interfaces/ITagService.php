<?php

namespace App\Services\Backend\Interfaces;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface ITagService
{
    public function findAll(): JsonResponse;

    public function find(string $uuid): JsonResponse;

    public function store(StoreTagRequest $request): JsonResponse;

    public function update(UpdateTagRequest $request, string $uuid): JsonResponse;

    public function destroy(string $uuid): JsonResponse;
}
