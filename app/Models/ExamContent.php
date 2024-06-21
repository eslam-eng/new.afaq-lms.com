<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamContent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['exam_id', 'exams_title_id'];

    public $timestamps = false;

    public function exam_title()
    {
        return $this->belongsTo(ExamsTitle::class, 'exams_title_id')->with('questions');
    }
}
