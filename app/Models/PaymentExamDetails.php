<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentExamDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_id',
        'exam_id',
        'user_id',
        'payment_number',
        'exam_name_en',
        'exam_name_ar',
        'exam_image_url',
        'user_name_en',
        'user_name_ar',
        'price',
        'offer',
        'final_price',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
