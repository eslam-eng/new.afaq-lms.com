<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSectionLectureNote extends Model
{
    use HasFactory;

    protected $table = "course_section_lecture_notes";

    protected $appends = [
        'note'
    ];
    protected $fillable = [
        'course_id',
        'course_section_id',
        'course_section_lecture_id',
        'note_en',
        'note_ar',
        'in_time', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getNoteAttribute()
    {
        return app()->getLocale() == 'en' ? $this->note_en : $this->note_ar;
    }
}
