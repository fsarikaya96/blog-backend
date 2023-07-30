<?php

namespace App\Http\Controllers\Backend\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\StoreAboutRequest;
use App\Services\Backend\Interfaces\IAboutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    private IAboutService $aboutService;

    public function __construct(IAboutService $IAboutService)
    {
        $this->aboutService = $IAboutService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->aboutService->index();
    }

    public function store(StoreAboutRequest $request): JsonResponse
    {
        return $this->aboutService->store($request);
    }

}
