<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessPayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'business_payments';
    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'Un Active',
    ];

    public const PACKAGE_PRICE_TYPE_SELECT = [
        'monthly' => 'Monthly',
        'annual'  => 'Annual',
    ];

    public const DIGITAL_MARKETING_EVENT_SELECT = [
        '0' => 'Lite package',
        '1' => 'Extra package',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable = [
        'package_id',
         'user_id',
        'payment_method_id',
        'payment_number',
        'price',
        'status',
        'package_price_type',
        'provider',

        'package_name_en',
        'package_name_ar',
        'price_package_annual',
        'package_annual_price_offers',
        'price_package_month',
        'package_month_price_offers',
        'event_number',
        'speakers_number',
        'attendance_trainees_number',
        'remote_trainees_number',
        'electronic_registration_system',
        'e_certificate',
        'customize_event_with_host_identity',
        'digital_marketing_event',
        'advertising_afaq_core',
        'quality_control_inquiries',
        'help_center_customer_response',
        'technical_support',
        'event_accreditation',
        'event_free_collection',
        'e_certificate_speaker',
        'two_email_trainees',
        'target_groups_mails',
        'electronic_testing_system',
        'effectiveness_rating_system',
        'discount_free_coupon',
        'event_reports',
        'attendance_absence_qr_system',
        'printable_id_card',
        'conference_workshops_attendance',
        'send_messages_event_participants',
        'event_notification_mobile',
        'fixed_advertising_banner',
        'responsible_employee_manage_event',
        'event_number_days',
        'online',
        'hybrid',
        'onsite',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function package(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BusinessPackage::class, 'package_id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
