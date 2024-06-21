<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Instructor extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'instructors';

    protected $appends = [
        'image',
        'name',
        'bio',

    ];

    public const RECENT_WORK_RADIO = [
        '1' => 'yes',
        '0' => 'no',
    ];
    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'Un Active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_ar',
        'name_en',
        'mail',
        'password',
        'mobile',
        'bio_ar',
        'bio_en',
        'order',
        'job_title',
        'workplace',
        'specialty_id',
        'twitter_account',
        'recent_work',
        'status',
        'resume',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function specialization()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

//    public function getResumeAttribute()
//    {
//        return $this->getMedia('resume')->last();
//    }

    public function instructors()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? $this->name_en : $this->name_ar;
    }

    public function getBioAttribute()
    {
        return app()->getLocale() == 'en' ? $this->bio_en : $this->bio_ar;
    }
}
