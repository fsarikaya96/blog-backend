<?php

namespace App\Repositories\Backend\Implementations;

use App\Models\Meta;
use App\Repositories\Backend\Interfaces\IMetaRepository;

class MetaRepository implements IMetaRepository
{
    public function store(Meta $meta): Meta
    {
        $meta->save();

        return $meta;
    }
}
