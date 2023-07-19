<?php

namespace App\Services\Backend\Interfaces;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Http\JsonResponse;

interface IPostService
{
    public function findAll(): JsonResponse;

    public function find(string $uuid): JsonResponse;

    public function store(StorePostRequest $request): JsonResponse;

    public function update(UpdatePostRequest $request, string $uuid): JsonResponse;

    public function destroy(string $uuid): JsonResponse;
}
