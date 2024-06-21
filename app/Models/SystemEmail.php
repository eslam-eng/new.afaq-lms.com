<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class SystemEmail extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'system_emails';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable = [
        'name',
        'name_id',
        'slug',
        'subject',
        'message',
        'type',
        'course_id',
        'exam_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public static $system_emails_types = [1 => "General",2 => "Exam",  3 => "Course"];
    public static $system_emails_names = [
        1 => "Approval Email",
        2 => "Verify User Notification",
        3 => "InvoiceBankTransfereCoursePAymentNotification",//Disapproval Email
        4 => "Course Reminder E-Mail",//After program Payment Email
        5 => "Programs Payment Email",
        6 => "Certificate Exporting Email",//"Binding Registrations Email",
        7 => "Second Email after payment",
        8 => "InvoiceAfterCoursePaymentNotification",// "UnPaid Programs Email",
        9 => "Visitors Approval Email",
        10 => "VisitorEGRegisteration",//
        11 => "Admin Approve Payment Course",
        12 => "Visitor Welcome Email",
        13 => "AttendanceCard",
        14=>"CancelPaymentRequestNotification",
        15=>"RejectedCancelRequestNotification",
        16=>"CancelByAdminRefundNotification"


    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
