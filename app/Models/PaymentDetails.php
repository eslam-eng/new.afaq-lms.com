<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'refound_amount',
        'refound_type',
        'cancel_reason',
        'payment_id',
        'course_id',
        'instructor_id',
        'user_id',
        'payment_number',
        'course_name_en',
        'course_name_ar',
        'course_image_url',
        'instructor_name_en',
        'instructor_name_ar',
        'user_name_en',
        'user_name_ar',
        'price',
        'offer',
        'final_price',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function enrolls()
    {
        return $this->belongsTo(Enroll::class, 'payment_id', 'payment_id');
    }
}
