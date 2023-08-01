<?php

namespace App\Http\Controllers\Backend\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageSetting\StorePageSettingRequest;
use App\Services\Backend\Interfaces\IPageSettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageSettingController extends Controller
{
    private IPageSettingService $pageSettingService;

    public function __construct(IPageSettingService $IPageSettingService)
    {
        $this->pageSettingService = $IPageSettingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->pageSettingService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageSettingRequest $request): JsonResponse
    {
        return $this->pageSettingService->store($request);
    }

}
