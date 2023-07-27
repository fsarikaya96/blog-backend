<?php

namespace App\Services\Backend\Implementations;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Meta;
use App\Models\Post;
use App\Repositories\Backend\Interfaces\IMetaRepository;
use App\Repositories\Backend\Interfaces\IPostRepository;
use App\Services\Backend\Interfaces\IPostService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class PostService implements IPostService
{
    protected IPostRepository $postRepository;
    protected IMetaRepository $metaRepository;

    public function __construct(IPostRepository $IPostRepository, IMetaRepository $IMetaRepository)
    {
        $this->postRepository = $IPostRepository;
        $this->metaRepository = $IMetaRepository;
    }

    public function findAll(): JsonResponse
    {
        Log::channel('api')->info("PostService called --> Request findAll() function");
        try {
            Log::channel('api')->info("PostService called --> Return all posts");

            $posts = $this->postRepository->findAll();

            return ResponseResult::generate(true, $posts);
        } catch (Exception $exception) {
            Log::channel('api')->info("PostService called --> findAll() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function find(string $uuid): JsonResponse
    {
        Log::channel('api')->info("PostService called --> Request find() function");
        try {

            $post = $this->postRepository->find($uuid);

            Log::channel('api')->info("PostService called --> Return post by uuid : " . $uuid);

            if (!$post) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }
            return ResponseResult::generate(true, $post);
        } catch (Exception $exception) {
            Log::channel('api')->info("PostService called --> find() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("PostService called --> Request store() function");
        try {

            $post = new Post();
            $post->uuid = Str::uuid();
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->status_id = $request->input('status_id');
            $post->created_by_user_id = Auth::id();

            $post = $this->postRepository->store($post);

            $tags = $request->input('tags');

            $post?->tags()->sync($tags);

            $meta = new Meta();
            $meta->uuid = Str::uuid();
            $meta->post_id = $post->id;
            $meta->meta_title = $request->input('meta_title');
            $meta->meta_keyword = $request->input('meta_keyword');
            $meta->meta_description = $request->input('meta_description');

            $this->metaRepository->store($meta);

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
            $post = $this->postRepository->find($uuid);

            if (!$post) {
                return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_NOT_FOUND);
            }

            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->status_id = $request->input('status_id');

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
            $post = $this->postRepository->find($uuid);

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
