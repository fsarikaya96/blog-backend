<?php

namespace App\Repositories\Backend\Implementations;

use App\Models\PageSetting;
use App\Repositories\Backend\Interfaces\IPageSettingRepository;

class PageSettingRepository implements IPageSettingRepository
{
    public function index(): ?PageSetting
    {
        /** @var PageSetting $page_setting */
        $page_setting = PageSetting::query()->first();

        return $page_setting;
    }

    public function store(PageSetting $pageSetting): PageSetting
    {
        $pageSetting->save();

        return $pageSetting;
    }
}
