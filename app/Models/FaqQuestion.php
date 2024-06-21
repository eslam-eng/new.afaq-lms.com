<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class FaqQuestion extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'faq_questions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category_id',
        'question_en',
        'answer_en',
        'question_ar',
        'answer_ar',
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'question', 'answer'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'category_id');
    }

    public function getQuestionAttribute()
    {
        return app()->getLocale() == 'en' ? $this->question_en : $this->question_ar;
    }

    public function getAnswerAttribute()
    {
        return app()->getLocale() == 'en' ? $this->answer_en : $this->answer_ar;
    }
}
