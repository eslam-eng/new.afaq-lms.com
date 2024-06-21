<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LookupType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lookup_types';

    protected $appends=[
        'title'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title_en',
        'title_ar',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTitleAttribute()
    {
        return (\App::getLocale() == 'en') ? $this->title_en : $this->title_ar;
    }
}
