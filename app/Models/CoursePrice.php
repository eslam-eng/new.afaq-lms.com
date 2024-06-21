<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePrice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id' , 'id');
    }


    public function specialty()
    {
        return $this->belongsTo(Specialty::class , 'specialty_id' , 'id');
    }
}
