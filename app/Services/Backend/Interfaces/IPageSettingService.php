<?php

namespace App\Services\Backend\Interfaces;

use App\Http\Requests\PageSetting\StorePageSettingRequest;
use Illuminate\Http\JsonResponse;

interface IPageSettingService
{
    public function index(): JsonResponse;

    public function store(StorePageSettingRequest $request): JsonResponse;
}
