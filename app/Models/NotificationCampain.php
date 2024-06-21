<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationCampain extends Model
{
    use HasFactory;

    public const TYPE_SELECT = [
        'Course' => 'Course',
        'Search' => 'Search',
    ];

    public const STATUS_RADIO = [
        '1' => 'Sent',
        '0' => 'UN Sent',
    ];

    public $table = 'notification_campains';

    protected $dates = [
        'send_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'specialty_id',
        'title_en',
        'title_ar',
        'message_en',
        'message_ar',
        'type',
        'send_at',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    public function getSendAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    //    public function setSendAtAttribute($value)
    //    {
    //        $this->attributes['send_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    //    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'specialty_id', 'specialty_id');
    }
}
