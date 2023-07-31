<?php

namespace App\Repositories\Backend\Implementations;

use App\Models\Project;
use App\Repositories\Backend\Interfaces\IProjectRepository;
use Illuminate\Support\Collection;

class ProjectRepository implements IProjectRepository
{
    public function findAll(): Collection
    {
        return Project::query()->get();

    }

    public function find(string $uuid): ?Project
    {
        /** @var Project $project */
        $project = Project::query()->where('uuid', '=', $uuid)->first();

        return $project;
    }

    public function store(Project $project): Project
    {
        $project->save();

        return $project;
    }

    public function update(Project $project): Project
    {
        $project->update();

        return $project;
    }

    public function destroy(Project $project): bool
    {
        return $project->delete();

    }
}
