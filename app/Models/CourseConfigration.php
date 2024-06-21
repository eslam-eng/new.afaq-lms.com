<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseConfigration extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TYPE_SELECT = [
        '0' => 'order',
        '1' => 'course'
    ];

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Un Active',
    ];

    public $table = 'course_configrations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'key',
        'value',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
