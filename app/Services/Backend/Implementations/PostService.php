<?php

namespace App\Services\Backend\Implementations;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\Backend\Interfaces\IPostRepository;
use App\Services\Backend\Interfaces\IPostService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class PostService implements IPostService
{
    protected IPostRepository $postRepository;

    public function __construct(IPostRepository $IPostRepository)
    {
        $this->postRepository = $IPostRepository;
    }

    public function index(): JsonResponse
    {
        Log::channel('api')->info("PostService called --> Request index() function");
        try {
            Log::channel('api')->info("PostService called --> Return all posts");

            $posts = $this->postRepository->index();

            return ResponseResult::generate(true, $posts);
        } catch (Exception $exception) {
            Log::channel('api')->info("PostService called --> index() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $uuid): JsonResponse
    {
        Log::channel('api')->info("PostService called --> Request show() function");
        try {

            $post = $this->postRepository->show($uuid);

            Log::channel('api')->info("PostService called --> Return post by uuid : " . $uuid);

            if (!$post) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }
            return ResponseResult::generate(true, $post);
        } catch (Exception $exception) {
            Log::channel('api')->info("PostService called --> show() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("PostService called --> Request store() function");
        try {
            $post = Post::query()->create($request->validated());

            $this->postRepository->store($post);

            DB::commit();

            Log::channel('api')->info("PostService called --> Return Insert item by post data : " . $post);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('api')->info("PostService called --> store() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdatePostRequest $request, string $uuid): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("PostService called --> Request update() function");
        try {
            $post = $this->postRepository->show($uuid);

            $post?->update($request->validated());

            $this->postRepository->update($post);

            DB::commit();

            Log::channel('api')->info("PostService called --> Update post data : " . $post);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('api')->info("PostService called --> update() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $uuid): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("PostService called --> Request destroy() function");
        try {
            $post = $this->postRepository->show($uuid);

            if (!$post) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }
            $this->postRepository->destroy($post);

            DB::commit();

            Log::channel('api')->info("PostService called --> Destroy post by uuid : " . $uuid);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('api')->info("PostService called --> destroy() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
