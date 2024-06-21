<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'exam_id', 'complete'];

    public $timestamps = false;

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
