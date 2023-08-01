<?php

namespace App\Repositories\Backend\Interfaces;

use App\Models\PageSetting;

interface IPageSettingRepository
{
    public function index(): ?PageSetting;

    public function store(PageSetting $pageSetting): PageSetting;
}
