<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuestionaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "course_questionaire";

    protected $fillable = ['title_en', 'title_ar', 'course_id', 'created_at', 'updated_at', 'deleted_at'];

    public function questions()
    {
        return $this->hasMany(CourseQuestionaireQuestion::class,'course_questionaire_id');
    }
}
