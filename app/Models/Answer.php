<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['quize_id','exam_id', 'question_id', 'answer_id', 'exams_title_id', 'user_id', 'date', 'flag'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question_answer()
    {
        return $this->belongsTo(QuestionAnswer::class , 'answer_id');
    }
}
