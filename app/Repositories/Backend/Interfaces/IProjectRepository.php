<?php

namespace App\Repositories\Backend\Interfaces;

use App\Models\Project;
use Illuminate\Support\Collection;

interface IProjectRepository
{
    public function findAll(): Collection;

    public function find(string $uuid): ?Project;

    public function store(Project $project): Project;

    public function update(Project $project): Project;

    public function destroy(Project $project): bool;
}
