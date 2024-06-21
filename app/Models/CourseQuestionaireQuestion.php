<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseQuestionaireQuestion extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $table = 'course_questionaire_questions';

    protected $appends = [
        'attachment'
    ];

    protected $fillable = [
        'course_id',
        'course_questionaire_id',
        'title_en',
        'title_ar',
        'type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getAttachmentAttribute()
    {
        $file = $this->getMedia('questionaire_attachment')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function answars()
    {
        return $this->hasMany(CourseQuestionaireQuestionAnswar::class, 'course_questionaire_question_id');
    }
}
