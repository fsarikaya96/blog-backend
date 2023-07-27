<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property mixed $uuid;
 * @property mixed $name;
 */

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name'
    ];
}
