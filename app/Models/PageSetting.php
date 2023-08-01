<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $id
 * @property mixed uuid
 * @property mixed website_name
 * @property mixed website_url
 * @property mixed website_title
 * @property mixed meta_keyword
 * @property mixed meta_description
 * @property mixed email
 * @property mixed github
 * @property mixed linkedin
 */
class PageSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'website_name',
        'website_url',
        'website_title',
        'meta_keyword',
        'meta_description',
        'email',
        'github',
        'linkedin',
    ];
}
