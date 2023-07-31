<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed uuid
 * @property mixed project_id
 * @property mixed name
 * @property mixed path
 * @property mixed size
 * @property mixed ext
 */
class ProjectImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'project_id',
        'name',
        'path',
        'size',
        'ext'
    ];
}
