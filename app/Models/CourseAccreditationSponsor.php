<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseAccreditationSponsor extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'course_accreditation_sponsors';
    protected $fillable = [
        'course_id',
        'accreditation_sponsor_id',
        'type',
    ];

    public function accreditation()
    {
        return $this->belongsTo(AccreditationSponsor::class, 'accreditation_sponsor_id');
    }

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
