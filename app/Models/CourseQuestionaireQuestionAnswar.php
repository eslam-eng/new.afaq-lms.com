<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuestionaireQuestionAnswar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "course_questionaire_question_answars";

    protected $fillable = [
        'course_id',
        'course_questionaire_id',
        'course_questionaire_question_id',
        'title_en',
        'title_ar',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
