<?php

namespace App\Services\Backend\Interfaces;

use App\Http\Requests\About\StoreAboutRequest;
use Illuminate\Http\JsonResponse;

interface IAboutService
{
    public function index(): JsonResponse;

    public function store(StoreAboutRequest $request): JsonResponse;

}
