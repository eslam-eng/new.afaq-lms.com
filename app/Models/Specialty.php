<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Specialty extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'specialties';
    public const SHOW_IN_HOMEPAGE_SELECT = [
        '1' => 'Show',
        '0' => 'Hide',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['name'];
    protected $fillable = [
        'name_en',
        'name_ar',
        'show_in_homepage',
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    function subcategories()
    {
        return $this->hasMany(SubSpecialty::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_target_group', 'specialty_id', 'course_id'); //,
    }

    public function courses_many()
    {
        return $this->hasMany(CourseSpecialty::class); //,
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? $this->name_en : $this->name_ar;
    }
}
