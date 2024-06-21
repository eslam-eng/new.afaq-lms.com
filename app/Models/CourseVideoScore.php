<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseVideoScore extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'course_video_scores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'course_id',
        'lecture_id',
        'user_id',
        'score_percentage',
        'success',
        'video_duration',
        'show_video_duration',
        'display_show_video_duration',
        'show_time_ranges',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'show_time_ranges' => 'array'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lecture_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
