<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $uuid;
 * @property mixed post_id;
 * @property mixed meta_title;
 * @property mixed meta_keyword;
 * @property mixed meta_description;
 */

class PostMeta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'post_id',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];

}
