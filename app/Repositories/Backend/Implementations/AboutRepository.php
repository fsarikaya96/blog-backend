<?php

namespace App\Repositories\Backend\Implementations;

use App\Http\Requests\About\StoreAboutRequest;
use App\Models\About;
use App\Repositories\Backend\Interfaces\IAboutRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class AboutRepository implements IAboutRepository
{
    public function index(): ?About
    {
        /** @var About $about */
        $about = About::query()->first();

        return $about;
    }

    public function store(About $about): About
    {
        $about->save();

        return $about;
    }
}
