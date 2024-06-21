<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSpecialRequest extends Model
{
    use HasFactory;

    public const ACCEPT_TERMS_RADIO = [

    ];

    public $table = 'business_special_requests';

    protected $dates = [
        'event_starting_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_type_id',
        'number_of_attendees',
        'event_starting_date',
        'details',
        'full_name',
        'employer',
        'job_title',
        'phone_number',
        'email_address',
        'accept_terms',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function event_type()
    {
        return $this->belongsTo(BusinessEventType::class, 'event_type_id');
    }

    public function getEventStartingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    //    public function setEventStartingDateAttribute($value)
    //    {
    //        $this->attributes['event_starting_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    //    }
}
