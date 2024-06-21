<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'sliders';

    protected $appends = [
        'image',
        'image_ar',
        'mobile_image_en',
        'mobile_image_ar',
        'mobile',
        'title',
        'description',
        'img',
        'mobile_img',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'link_en',
        'link_ar',
        'course_id',
        'type_id_for_search',
        'type',
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
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

    public function getImageArAttribute()
    {
        $file = $this->getMedia('image_ar')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
    public function getMobileImageEnAttribute()
    {
        $file = $this->getMedia('mobile_image_en')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getMobileImageArAttribute()
    {
        $file = $this->getMedia('mobile_image_ar')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getMobileAttribute()
    {
        return app()->getLocale() == 'en' ? $this->mobile_image_en : $this->mobile_image_ar;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->title_en ?? $this->title_ar ?? null) : ($this->title_ar ?? $this->title_en ?? null);
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->description_en ?? $this->description_ar ?? null) : ($this->description_ar ?? $this->description_en ?? null);
    }

    public function getLinkAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->link_en ?? $this->link_ar ?? null) : ($this->link_ar ?? $this->link_en ?? null);
    }

    public function getImgAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->image ? $this->image->url : null) : ($this->image_ar ? $this->image_ar->url : null);
    }
    public function getMobileImgAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->mobile_image_en ? $this->mobile_image_en->url : null) : ($this->mobile_image_ar ? $this->mobile_image_ar->url : null);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function quickAccess()
    {
        return $this->belongsTo(Lookup::class, 'type_id_for_search');
    }

    
         


    
}
