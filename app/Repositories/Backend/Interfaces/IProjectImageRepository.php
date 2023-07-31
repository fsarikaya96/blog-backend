<?php

namespace App\Repositories\Backend\Interfaces;

use App\Models\ProjectImage;

interface IProjectImageRepository
{
    public function find(int $project_id);

    public function store(ProjectImage $projectImage): ProjectImage;

    public function update(ProjectImage $projectImage): ProjectImage;
}
