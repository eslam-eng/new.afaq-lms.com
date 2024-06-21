<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enroll extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function bank_invoice()
    {
        return $this->belongsTo(BankInvoice::class, 'provider_payment_id', 'invoice_id');
    }

    public function reservation_number($oneCourse_id)
    {
        return Enroll::where(['course_id' => $oneCourse_id, 'approved' => 1])->count();
    }
}
