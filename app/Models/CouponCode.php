<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponCode extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const COUPON_TYPE_SELECT = [
        'cash' => 'Cash',
        'percentage' => 'Percentage %',
    ];

    public $table = 'coupon_codes';

    protected $dates = [
        'coupon_expire_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'coupon_text',
        'coupon_type',
        'coupon_amount',
        'coupon_expire_date',
        'coupon_use_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getCouponExpireDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCouponExpireDateAttribute($value)
    {
        $this->attributes['coupon_expire_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function course_coupon()
    {
        return $this->belongsToMany(Course::class, 'course_coupons'); //, 'course_id','coupon_code_id'
    }

    public function courses()
    {
        return $this->hasMany(CourseCoupon::class)->with(['coupon', 'course', 'course.category']);
    }

    public function enrolles()
    {
        return $this->hasMany(Enroll::class, 'coupon', 'coupon_text')->where('status', 1);
    }
}
