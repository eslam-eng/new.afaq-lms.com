<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Payment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'refound_amount',
        'refound_type',
        'payment_number',
        'user_id',
        'transaction',
        'status',
        'amount',
        'payment_method_id',
        'provider',
        'lecture_id',
        'fullresponse',
        'currency',
        'approved',
        'qr_image',
        'initial_response',
        'status_response',
        'payment_status',
        'wallet',
        'wallet_discount',
        'deleted_at',
        'invoice_number'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function course()
    {
        return $this->belongsTo(PaymentDetails::class, 'course_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
    public function payment_details()
    {
        return $this->hasMany(PaymentDetails::class, 'payment_id');
    }

    public function payment_details_canceled()
    {
        return $this->hasMany(PaymentDetails::class, 'payment_id')->withTrashed()->whereNotNull('deleted_at');
    }

    public function payment_enrolls()
    {
        return $this->hasMany(Enroll::class, 'payment_id', 'id')->with('user', 'course');
    }
//    public function reservation_enrolls()
//    {
//        return $this->hasOne(Enroll::class, 'payment_provider');
//    }
    public function payment_exam_details()
    {
        return $this->hasMany(PaymentExamDetails::class, 'payment_id');
    }
    public function payment_invoices()
    {
        return $this->belongsTo(BankInvoice::class, 'transaction', 'invoice_id');
    }
}
