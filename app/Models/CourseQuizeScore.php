<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuizeScore extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'course_quize_scores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'course_id',
        'quize_id',
        'user_id',
        'repeat_times',
        'score_percentage',
        'success',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function quize()
    {
        return $this->belongsTo(CourseQuize::class, 'quize_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
