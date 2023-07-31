<?php

namespace App\Http\Controllers\Backend\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Services\Backend\Interfaces\IProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private IProjectService $projectService;

    public function __construct(IProjectService $IProjectService)
    {
        $this->projectService = $IProjectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->projectService->findAll();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        return $this->projectService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): JsonResponse
    {
        return $this->projectService->find($uuid);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $uuid): JsonResponse
    {
        return $this->projectService->update($request, $uuid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        return $this->projectService->destroy($uuid);
    }
}
