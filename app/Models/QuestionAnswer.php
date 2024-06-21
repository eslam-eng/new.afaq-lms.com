<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class QuestionAnswer extends Model
{
//    use SoftDeletes;


    protected $fillable = ['question_banks_id', 'answer', 'correct_answer',  'deleted_at',];

    public $timestamps = false;
}
