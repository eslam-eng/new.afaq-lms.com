<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPackage extends Model
{
    use HasFactory;

    public $table = 'business_packages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DIGITAL_MARKETING_EVENT_SELECT = [
        '0' => 'Lite package',
        '1' => 'Extra package',
        '2' => 'Without marketing package'
    ];

    protected $fillable = [
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
        'event_fees',
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
