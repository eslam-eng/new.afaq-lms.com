<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSubSpecialty extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'course_sub_specialties';
    protected $fillable = [
        'course_id',
        'sub_specialty_id',

    ];
}
