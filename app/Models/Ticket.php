<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Ticket extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'tickets';

    protected $appends = [
//        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUES_SELECT = [
        '1' => 'Resolved',
        '0' => 'Opened',
    ];
    public const TYPE_SELECT = [
        'AFAQ'     => 'AFAQ',
        'Business' => 'Business',
    ];

    protected $fillable = [
        'user_id',
        'email',
        'title',
        'ticket_category_id',
        'ticket_id',
        'replies_number',
        'statues',
        'description',
        'image',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

//    public function registerMediaConversions(Media $media = null): void
//    {
//        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
//        $this->addMediaConversion('preview')->fit('crop', 120, 120);
//    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function ticket_category()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }
    public function ticket_comments()
    {
        return $this->hasMany(TicketComment::class,'ticket_id','id');
    }
    public function ticket_business_comments()
    {
        return $this->hasMany(TicketComment::class,'ticket_id','id')->where('type','Business');
    }
//    public function getImageAttribute()
//    {
//        $file = $this->getMedia('image')->last();
//        if ($file) {
//            $file->url       = $file->getUrl();
//            $file->thumbnail = $file->getUrl('thumb');
//            $file->preview   = $file->getUrl('preview');
//        }
//
//        return $file;
//    }
}
