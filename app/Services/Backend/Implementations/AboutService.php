<?php

namespace App\Services\Backend\Implementations;

use App\Http\Requests\About\StoreAboutRequest;
use App\Models\About;
use App\Repositories\Backend\Interfaces\IAboutRepository;
use App\Services\Backend\Interfaces\IAboutService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class AboutService implements IAboutService
{
    private IAboutRepository $aboutRepository;

    public function __construct(IAboutRepository $IAboutRepository)
    {
        $this->aboutRepository = $IAboutRepository;
    }

    public function index(): JsonResponse
    {
        Log::channel('api')->info("AboutService called --> Request index() function");

        try {
            $about = $this->aboutRepository->index();

            Log::channel('api')->info("AboutService called --> Return about : " . $about);

            return ResponseResult::generate(true, $about);

        } catch (Exception $exception) {
            Log::channel('api')->info("AboutService called --> index() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreAboutRequest $request): JsonResponse
    {
        DB::beginTransaction();
        Log::channel('api')->info("AboutService called --> Request store() function");

        try {
            $about = About::query()->first();

            if (!$about) {
                $about = new About();

                $about->uuid = Str::uuid();

            }
            $about->description = $request->input('description');

            $this->aboutRepository->store($about);

            DB::commit();
            Log::channel('api')->info("AboutService called --> Return Insert item by about data : " . $about);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel('api')->info("AboutService called --> store() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

}
