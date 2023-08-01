<?php

namespace App\Services\Backend\Implementations;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use App\Repositories\Backend\Implementations\TagRepository;
use App\Repositories\Backend\Interfaces\ITagRepository;
use App\Services\Backend\Interfaces\ITagService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class TagService implements ITagService
{
    private TagRepository $tagRepository;

    public function __construct(ITagRepository $ITagRepository)
    {
        $this->tagRepository = $ITagRepository;
    }

    public function findAll(): JsonResponse
    {
        Log::channel('api')->info("TagService called --> Request findAll() function");
        try {
            $tags = $this->tagRepository->findAll();

            Log::channel('api')->info("TagService called --> Return all tags : " . $tags);

            return ResponseResult::generate(true, $tags);
        } catch (Exception $exception) {
            Log::channel('api')->info("TagService called --> findAll() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function find(string $uuid): JsonResponse
    {
        Log::channel('api')->info("TagService called --> Request find() function");

        try {
            $tag = $this->tagRepository->find($uuid);

            if (!$tag) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }
            Log::channel('api')->info("TagService called --> Return tag by uuid : " . $uuid);

            return ResponseResult::generate(true, $tag);
        } catch (Exception $exception) {
            Log::channel('api')->info("TagService called --> find() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreTagRequest $request): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("TagService called --> Request store() function");
        try {
            $tag = new Tag();
            $tag->uuid = Str::uuid();
            $tag->name = $request->input('name');

            $this->tagRepository->store($tag);

            DB::commit();
            Log::channel('api')->info("TagService called --> Return Insert item by tag data : . $tag");
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel('api')->info("TagService called --> store() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateTagRequest $request, string $uuid): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("TagService called --> Request update() function");
        try {
            $tag = $this->tagRepository->find($uuid);

            if (!$tag) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }

            $tag->name = $request->input('name');

            $this->tagRepository->update($tag);

            DB::commit();
            Log::channel('api')->info("TagService called --> Update item by tag data : . $tag");
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel('api')->info("TagService called --> update() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $uuid): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("TagService called --> Request destroy() function");
        try {
            $tag = $this->tagRepository->find($uuid);

            if (!$tag) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }

            $this->tagRepository->destroy($tag);

            DB::commit();
            Log::channel('api')->info("TagService called --> Destroy tag by uuid : . $uuid");
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel('api')->info("TagService called --> update() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
