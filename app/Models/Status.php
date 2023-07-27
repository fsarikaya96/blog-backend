<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static active()
 * @method static passive()
 */
class Status extends Model
{
    use HasFactory, SoftDeletes;

    public mixed $id;
    protected $fillable = [
        'uuid',
        'code',
        'name_tr',
        'name_en'
    ];

    public function scopeActive($query)
    {
        return $query->where('code', '=', 'active')->first();
    }

    public function scopePassive($query)
    {
        return $query->where('code', '=', 'passive')->first();
    }
}
