<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoomMeeting extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const MEETING_TYPE_SELECT = [
        'meetings' => 'Meetings',
        'webinars' => 'Webinars',
    ];

    public const TYPE_SELECT = [
        '1' => 'Daily',
        '2' => 'Weekly',
        '3' => 'Monthly',
    ];

    public const AUTO_RECORDING_SELECT = [
        'local' => 'local',
        'cloud' => 'cloud',
        'none'  => 'none',
    ];

    public const AUDIO_SELECT = [
        'both'      => 'both',
        'telephony' => 'telephony',
        'voip'      => 'voip',
    ];

    public $table = 'zoom_meetings';

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'course_id',
        'section_id',
        'lecture_id',
        'meeting_id',
        'start_url',
        'join_url',
        'status',
        'all_data',
        'topic',
        'start_time',
        'end_time',
        'duration',
        'agenda',
        'host_video',
        'participant_video',
        'password',
        'default_password',
        'type',
        'audio',
        'auto_recording',
        'alternative_hosts',
        'mute_upon_entry',
        'watermark',
        'waiting_room',
        'created_at',
        'updated_at',
        'deleted_at',
        'meeting_type',
        'report_status'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // public function getStartTimeAttribute($value)
    // {
    //     return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    // }

    // public function setStartTimeAttribute($value)
    // {
    //     $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = date('Y-m-d H:i:s', strtotime($value)) ?? null;
        $this->attributes['end_time'] = date('Y-m-d H:i:s', strtotime($value . '+ ' . request('duration') . 'minutes')) ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function reports()
    {
        return $this->hasMany(ZoomReport::class, 'meeting_id', 'meeting_id');
    }

    public function report()
    {
        return $this->hasOne(ZoomReport::class, 'meeting_id', 'meeting_id');
    }
}
