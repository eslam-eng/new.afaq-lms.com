<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionBank extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const CORRECT_ANSWER_RADIO = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'question_banks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'exams_title_id',
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $with = ['bank_answer'];

    public function exam_title()
    {
        return $this->belongsTo(ExamsTitle::class, 'exams_title_id');
    }

    public function bank_answer()
    {
        return $this->hasMany(QuestionAnswer::class, 'question_banks_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'question_id')->latest()->where('user_id', auth()->user()->id)->with('question_answer');
    }
}
