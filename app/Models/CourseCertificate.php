<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCertificate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['certificate_id', 'course_id'];

    public function certificate()
    {
        return $this->belongsTo(Certificat::class, 'certificate_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
