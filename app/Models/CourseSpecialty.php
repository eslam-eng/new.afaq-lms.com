<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSpecialty extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'course_target_group';
    protected $fillable = [
        'course_id',
        'specialty_id',
    ];
}
