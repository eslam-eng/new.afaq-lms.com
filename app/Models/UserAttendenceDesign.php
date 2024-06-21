<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAttendenceDesign extends Model
{
    use HasFactory;




    public $table = 'user_attendence_designs';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'course_id',
        'attendance_design_id',
        'attendance_design_img',
        'qrcode',
       'lecture_id'
    ];

    protected $appends = ['has_img', 'cer_image'];

    public function attendance_designs()
    {
        return $this->belongsTo(AttendanceDesign::class, 'attendance_design_id');
    }

    public function getHasImgAttribute()
    {
        return $this->attendance_design_img ? is_array(json_decode($this->attendance_design_img, true)) : 0;
    }

    public function getCerImageAttribute()
    {
        if ($this->attendance_design_img && is_array(json_decode($this->attendance_design_img, true))) {

            return json_decode($this->attendance_design_img)->src;
        } else {
            return $this->attendance_design_img;
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class)->withoutGlobalScopes();
    }
}
