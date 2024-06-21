<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TicketComment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'ticket_comments';
//    protected $appends = [
//        'image',
//    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public const TYPE_SELECT = [
        'AFAQ'     => 'AFAQ',
        'Business' => 'Business',
    ];
    protected $fillable = [
        'user_id',
        'ticket_id',
        'author_name',
        'author_email',
        'comment_text',
        'image',
        'comment_type',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }
}
