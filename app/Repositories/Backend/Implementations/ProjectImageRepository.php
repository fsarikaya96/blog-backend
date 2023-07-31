<?php

namespace App\Repositories\Backend\Implementations;

use App\Models\ProjectImage;
use App\Repositories\Backend\Interfaces\IProjectImageRepository;

class ProjectImageRepository implements IProjectImageRepository
{
    public function find(int $project_id): ?ProjectImage
    {
        /** @var ProjectImage $project_image */
        $project_image = ProjectImage::query()->where('project_id', '=', $project_id)->first();

        return $project_image;
    }

    public function store(ProjectImage $projectImage): ProjectImage
    {
        $projectImage->save();

        return $projectImage;
    }

    public function update(ProjectImage $projectImage): ProjectImage
    {
        $projectImage->update();

        return $projectImage;
    }
}
