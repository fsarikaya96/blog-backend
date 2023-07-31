<?php

namespace App\Services\Backend\Interfaces;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use Illuminate\Http\JsonResponse;

interface IProjectService
{
    public function findAll(): JsonResponse;

    public function find(string $uuid): JsonResponse;

    public function store(StoreProjectRequest $request): JsonResponse;

    public function update(UpdateProjectRequest $request, string $uuid): JsonResponse;

    public function destroy(string $uuid): JsonResponse;
}
