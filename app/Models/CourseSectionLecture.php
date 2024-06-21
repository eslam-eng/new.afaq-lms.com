<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseSectionLecture extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $table = 'course_section_lectures';

    protected $appends = [
        'attachment', 'title', 'short_description'
    ];

    protected $fillable = [
        'title_en',
        'title_ar',
        'depends_on_id',
        'order',
        'short_description_en',
        'short_description_ar',
        'accessing',
        'course_id',
        'course_section_id',
        'duration',
        'type',
        'created_at',
        'deleted_at',
        'updated_at',
        'file'
    ];


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getAttachmentAttribute()
    {
        $file = $this->getMedia('lecture_attachment')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function quize()
    {
        return $this->hasOne(CourseQuize::class, 'lecture_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function zoom()
    {
        return $this->hasOne(ZoomMeeting::class, 'lecture_id', 'id');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'en' ? $this->title_en : $this->title_ar;
    }

    public function getShortDescriptionAttribute()
    {
        return app()->getLocale() == 'en' ? $this->short_description_en : $this->short_description_ar;
    }

    public function videoScore()
    {
        return $this->hasMany(CourseVideoScore::class, 'lecture_id', 'id');
    }

    public function videoScoreOne()
    {
        if(auth()->check()){
            return $this->hasOne(CourseVideoScore::class, 'lecture_id', 'id')->where('user_id',auth()->user()->id)->latest();
        }else{
            return $this->hasOne(CourseVideoScore::class, 'lecture_id', 'id')->latest();
        }
    }
    public function dependsOn()
    {
        return $this->belongsTo(CourseSectionLecture::class, 'depends_on_id', 'id');
    }

    public function courseNotes()
    {
        return $this->hasMany(CourseSectionLectureNote::class, 'course_section_lecture_id', 'id');
    }
}
