<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNotification extends Model
{
    //    use SoftDeletes;
    use HasFactory;

    public const READ_RADIO = [
        '1' => 'Read',
        '0' => 'Not Read',
    ];

    public const STATUS_RADIO = [
        '1' => 'Sent',
        '0' => 'Un Sent',
    ];

    public $table = 'user_notifications';

    protected $dates = [
        'created_at',
        'updated_at',
        //        'deleted_at',
    ];

    protected $fillable = [
        'parent_id',
        'user_id',
        'type',
        'title_en',
        'title_ar',
        'message_en',
        'message_ar',
        'data',
        'status',
        'read',
        'fcm_token',
        'created_at',
        'updated_at',
        'item_id',
        'action'
        //        'deleted_at',
    ];

    protected $appends = [
        'title',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'en' ? $this->title_en ?? $this->title_ar : $this->title_ar ?? $this->title_en;
    }

    public function getMessageAttribute()
    {
        return app()->getLocale() == 'en' ? $this->message_en ?? $this->message_ar : $this->message_ar ?? $this->message_en;
    }
}
