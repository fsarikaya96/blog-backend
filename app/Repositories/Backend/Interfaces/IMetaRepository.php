<?php

namespace App\Repositories\Backend\Interfaces;

use App\Models\Meta;

interface IMetaRepository
{
    public function store(Meta $meta): Meta;
}
