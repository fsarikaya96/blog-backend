<?php

namespace App\Services\Backend\Implementations;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Repositories\Backend\Interfaces\IProjectImageRepository;
use App\Repositories\Backend\Interfaces\IProjectRepository;
use App\Services\Backend\Interfaces\IProjectService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class ProjectService implements IProjectService
{
    private IProjectRepository $projectRepository;
    private IProjectImageRepository $projectImageRepository;

    public function __construct(IProjectRepository $IProjectRepository, IProjectImageRepository $IProjectImageRepository)
    {
        $this->projectRepository = $IProjectRepository;
        $this->projectImageRepository = $IProjectImageRepository;

    }

    public function findAll(): JsonResponse
    {
        Log::channel('api')->info("ProjectService called --> Request findAll() function");

        try {

            $projects = $this->projectRepository->findAll();

            Log::channel('api')->info("ProjectService called --> Return all projects : " . $projects);
            return ResponseResult::generate(true, $projects);
        } catch (Exception $exception) {
            Log::channel('api')->info("ProjectService called --> findAll() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function find(string $uuid): JsonResponse
    {
        Log::channel('api')->info("ProjectService called --> Request find() function");
        try {

            $project = $this->projectRepository->find($uuid);

            Log::channel('api')->info("ProjectService called --> Return project by uuid : " . $uuid);

            if (!$project) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }
            return ResponseResult::generate(true, $project);
        } catch (Exception $exception) {
            Log::channel('api')->info("ProjectService called --> find() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("ProjectService called --> Request store() function");

        try {

            $project = new Project();

            $project->uuid = Str::uuid();
            $project->title = $request->input('title');
            $project->description = $request->input('description');

            $project = $this->projectRepository->store($project);

            $file = $request->file('project_image');

            $target_path = "project/$project->uuid/" . $file->getClientOriginalName();

            $project_image = new ProjectImage();

            $project_image->uuid = Str::uuid();
            $project_image->project_id = $project->id;
            $project_image->name = $file->getClientOriginalName();
            $project_image->path = $target_path;
            $project_image->size = $file->getSize();
            $project_image->ext = $file->extension();

            $this->projectImageRepository->store($project_image);

            DB::commit();

            Log::channel('api')->info("ProjectService called --> Return Insert item by project data : " . $project);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel('api')->info("ProjectService called --> store() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateProjectRequest $request, string $uuid): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("ProjectService called --> Request update() function");
        try {
            $project = $this->projectRepository->find($uuid);

            if (!$project) {
                return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_NOT_FOUND);
            }

            $project->title = $request->input('title');
            $project->description = $request->input('description');

            $this->projectRepository->update($project);

            $project_image = $this->projectImageRepository->find($project->id);

            $file = $request->file('project_image');

            $target_path = "project/$project->uuid/" . $file->getClientOriginalName();

            $project_image->name = $file->getClientOriginalName();
            $project_image->path = $target_path;
            $project_image->size = $file->getSize();
            $project_image->ext = $file->extension();

            $this->projectImageRepository->update($project_image);

            DB::commit();

            Log::channel('api')->info("ProjectService called --> Update project data : " . $project);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('api')->info("ProjectService called --> update() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $uuid): JsonResponse
    {
        DB::beginTransaction();

        Log::channel('api')->info("ProjectService called --> Request destroy() function");
        try {
            $project = $this->projectRepository->find($uuid);

            if (!$project) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }
            $this->projectRepository->destroy($project);

            $project_image = $this->projectImageRepository->find($project->id);

            if (!$project_image) {
                return ResponseResult::generate(false, [__('service.something_went_wrong')], ResponseCodes::HTTP_NOT_FOUND);
            }
            $this->projectImageRepository->destroy($project_image);

            DB::commit();

            Log::channel('api')->info("ProjectService called --> Destroy post by uuid : " . $uuid);
            return ResponseResult::generate(true, __('service.the_operation_was_successful'));
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('api')->info("ProjectService called --> destroy() exception : " . $exception->getMessage());
            return ResponseResult::generate(false, [__('service.error_occurred_during_operation')], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
