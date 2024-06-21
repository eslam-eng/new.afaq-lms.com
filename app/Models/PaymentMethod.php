<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PaymentMethod extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    public const TYPE_SELECT = [
        'api'   => 'api',
        'offline' => 'offline',
    ];

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Un Active',
    ];

    public const PROVIDER_SELECT = [
        'MyFatoorah' => 'MyFatoorah',
        'Bank'       => 'Bank',
        'UrWay'      => 'UrWay',
        'Hyber'      => 'Hyber',
        'Cash'       => 'Cash',
        'Free'       => 'Free',
        'Tabby'      => 'Tabby'
    ];

    public $table = 'payment_methods';

    protected $appends = [
        'local_image',
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_en',
        'name_ar',
        'provider',
        'provider_method_id',
        'service_fees',
        'type',
        'mode',
        'status',
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


    public function getLocalImageAttribute()
    {
        $file = $this->getMedia('local_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');

            return $file;
        }

        return null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? $this->name_en ?? '' : $this->name_ar ?? '';
    }
}
