<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseQuize extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'UnActive',
    ];

    public $table = 'course_quizes';

    protected $appends = [
        'image','name'
    ];

    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'section_id',
        'lecture_id',
        'course_id',
        'repeat_times',
        'exam_title_id',
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'tips_guidelines',
        'success_percentage',
        'start_at',
        'end_at',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function lecture()
    {
        return $this->belongsTo(CourseSectionLecture::class, 'lecture_id');
    }

    public function exam_title()
    {
        return $this->belongsTo(ExamsTitle::class, 'exam_title_id');
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

    public function getStartAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    // public function setStartAtAttribute($value)
    // {
    //     $this->attributes['start_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    // public function getEndAtAttribute($value)
    // {
    //     return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    // }

    // public function setEndAtAttribute($value)
    // {
    //     $this->attributes['end_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getNameAttribute(){
        return app()->getLocale() ? $this->title_en : $this->title_ar;
    }

    public function scores(){
        return $this->hasMany(CourseQuizeScore::class,'quize_id','id');
    }

    public function score()
    {
       return $this->hasOne(CourseQuizeScore::class,'quize_id','id')->latest();
    }
}
