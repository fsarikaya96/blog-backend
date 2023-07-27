<?php

namespace App\Http\Controllers\Backend\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Services\Backend\Implementations\TagService;
use App\Services\Backend\Interfaces\ITagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private TagService $tagService;

    public function __construct(ITagService $ITagService)
    {
        $this->tagService = $ITagService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->tagService->findAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request): JsonResponse
    {
        return $this->tagService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): JsonResponse
    {
        return $this->tagService->find($uuid);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, string $uuid): JsonResponse
    {
        return $this->tagService->update($request, $uuid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        return $this->tagService->destroy($uuid);
    }
}
