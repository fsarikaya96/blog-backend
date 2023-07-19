<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $uuid;
 * @property mixed $title;
 * @property mixed $description;
 * @property mixed $views;
 * @property mixed $status_id;
 * @property mixed $created_by_user_id;
 */

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'views',
        'status_id',
        'created_by_user_id'
    ];
}
