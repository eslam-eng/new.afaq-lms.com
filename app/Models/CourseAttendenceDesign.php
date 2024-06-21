<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseAttendenceDesign extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['course_id','attendance_design_id' ];
    public function attendance_designs()
    {
        return $this->belongsTo(AttendanceDesign::class, 'attendance_design_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }








}
