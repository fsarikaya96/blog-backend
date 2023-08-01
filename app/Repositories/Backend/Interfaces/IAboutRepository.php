<?php

namespace App\Repositories\Backend\Interfaces;

use App\Http\Requests\About\StoreAboutRequest;
use App\Models\About;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface IAboutRepository
{
    public function index(): ?About;

    public function store(About $about): About;

}
