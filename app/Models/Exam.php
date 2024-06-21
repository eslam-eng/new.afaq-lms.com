<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Exam extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'UnActive',
    ];

    public $table = 'exams';

    protected $appends = [
        'image',
        'available'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'tips_guidelines',
        'success_percentage',
        'number_question',
        'certificate_id',
        'price',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'start_at',
        'end_at'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function exam_content()
    {
        return $this->hasMany(ExamContent::class)->with('exam_title');
    }

    public function exam_title()
    {
        return $this->hasMany(ExamContent::class)->with('exam_title');
    }

    public function certificate()
    {
        return $this->belongsTo(Certificat::class, 'certificate_id');
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function create_exam_exam_title()
    {
        return $this->belongsToMany(ExamsTitle::class, 'exam_contents', 'exam_id', 'exams_title_id');
    }

    public function getAvailableAttribute()
    {
        if (auth()->check() && UserExam::where('user_id', auth()->user()->id)->where('exam_id', $this->id)->first()) {
            $available = 'joined_before';
        } elseif (strtotime($this->start_at) < strtotime(now()) && strtotime(now()) < strtotime($this->end_at) && auth()->check() && UserExam::where('user_id', auth()->user()->id)->where('exam_id', $this->id)->first()) {
            $available =  1;
        } else {
            $available = 'join';
        }

        return $available;
    }
}
