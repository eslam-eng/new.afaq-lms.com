<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Lookup extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lookups';

    public const STATUS_RADIO = [
        '1' => 'Show',
        '0' => 'Hide',
    ];
    public const SHOW_IN_HOMEPAGE_SELECT = [
        '1' => 'Show',
        '0' => 'Hide',
    ];
    protected $appends = [
        'image_url',
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
        'lookup_type_id',
        'image',
        'slug',
        'status',
        'show_in_homepage',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function type()
    {
        return $this->belongsTo(LookupType::class, 'lookup_type_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Lookup::class, 'parent_id', 'id');
    }

    public function childerns()
    {
        return $this->hasMany(Lookup::class, 'parent_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('afaq/logo.png');
    }

    public function getTitleAttribute()
    {
        return (\App::getLocale() == 'en') ? $this->title_en : $this->title_ar;
    }
    /**
     * Get all of the courses that are assigned this lookup
     */
    public function courses()
    {
        return $this->morphedByMany(Course::class, 'lookupables');
    }

    public function getQuickAccess(){
        
        return Lookup::where('lookup_type_id', 1)->pluck('title_' . app()->getLocale() . ' as title', 'id');
         
    }
}
