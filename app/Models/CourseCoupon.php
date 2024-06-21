<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCoupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'course_coupons';
    protected $fillable = [
        'course_id',
        'coupon_code_id',
    ];

    public function coupon()
    {
        return $this->belongsTo(CouponCode::class, 'coupon_code_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
