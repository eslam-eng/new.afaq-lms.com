<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'course_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_en',
        'name_ar',
        'featured',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'name'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->name_en ?? $this->name_ar ?? null)  : ($this->name_ar ?? $this->name_en ?? null);
    }
}
