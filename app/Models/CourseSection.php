<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'course_sections';

    protected $appends = [
        'title'
    ];
    protected $fillable = [
        'id',
        'title_en',
        'title_ar',
        'course_id'
    ];


    public function lectures()
    {
        return $this->hasMany(CourseSectionLecture::class, 'course_section_id', 'id')->orderBy('order', 'asc');
    }

    public function quizes()
    {
        return $this->hasMany(CourseQuize::class, 'section_id', 'id');
    }

    public function zoomMeetings()
    {
        return $this->hasMany(ZoomMeeting::class, 'section_id', 'id');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'en' ? $this->title_en : $this->title_ar;
    }
}
