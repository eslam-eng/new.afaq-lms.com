<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancelRequest extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'Un Active',
    ];

    public const APPROVED_SELECT = [
        '1' => 'Approved',
        '0' => 'Un Approved',
    ];
    public const Rejected_SELECT = [
        '1' => 'Rejected',//Yes
        '0' => 'Not Rejected', //No
    ];

    public $table = 'cancel_requests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'course_id',
        'user_id',
        'type',
        'amount',
        'status',
        'approved',
        'rejected',
        'cancel_reason',
        'payment_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function payment_details()
    {
        return $this->belongsTo(PaymentDetails::class, 'payment_id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
