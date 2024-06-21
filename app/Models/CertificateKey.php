<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertificateKey extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'certificate_keys';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'key',
        'type',
        'related_coulmn',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPES = [
        'users' => "App\Models\User",
        'courses' => "App\Models\Course",
        'instructors' => "App\Models\Instructor",
        'exams' => "App\Models\Exam",
        'sponsers' => "App\Models\AccreditationSponsor",
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
