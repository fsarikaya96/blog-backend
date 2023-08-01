<?php

namespace App\Services\Backend\Implementations;

use App\Http\Requests\PageSetting\StorePageSettingRequest;
use App\Models\About;
use App\Models\PageSetting;
use App\Repositories\Backend\Interfaces\IPageSettingRepository;
use App\Services\Backend\Interfaces\IPageSettingService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class PageSettingService implements IPageSettingService
{
    private IPageSettingRepository $pageSettingRepository;

    public function __construct(IPageSettingRepository $IPageSettingRepository)
    {
        $this->pageSettingRepository = $IPageSettingRepository;
    }

    public function index(): JsonResponse
    {
        Log::channel('api')->info("PageService called --> Request index() function");

        try {

            $page_setting = $this->pageSettingRepository->index();

            Log::channel('api')->info("PageService called --> Return page setting : " . $page_setting);

            return ResponseResult::generate(true, $page_setting);

        } catch (Exception $exception) {
            Log::channel('api')->info("PageService called --> index() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePageSettingRequest $request): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("PageSettingService called --> Request store() function");

        try {
            $page_setting = $this->pageSettingRepository->index();

            if (!$page_setting) {

                $page_setting = new PageSetting();
                $page_setting->uuid = Str::uuid();
            }

            $page_setting->website_name = $request->input('website_name');
            $page_setting->website_url = $request->input('website_url');
            $page_setting->website_title = $request->input('website_title');
            $page_setting->meta_keyword = $request->input('meta_keyword');
            $page_setting->meta_description = $request->input('meta_description');
            $page_setting->email = $request->input('email');
            $page_setting->github = $request->input('github');
            $page_setting->linkedin = $request->input('linkedin');

            $this->pageSettingRepository->store($page_setting);

            DB::commit();
            Log::channel('api')->info("PageSettingService called --> Return Insert item by about data : " . $page_setting);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel('api')->info("PageSettingService called --> store() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
