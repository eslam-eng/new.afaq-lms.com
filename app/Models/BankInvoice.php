<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BankInvoice extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    public $table = 'bank_invoices';

    // protected $guarded = [];

    protected $appends = [
        'invoice_image',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'invoice_id',
        'payment_method_id',
        'bank_id',
        'amount',
        'currency',
        'date',
        'bank_name',
        'bank_number',
        'admin_invoice_note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function bank()
    {
        return $this->belongsTo(BankList::class, 'bank_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function courses()
    {
        return $this->hasMany(PaymentDetails::class, 'payment_number', 'invoice_id');
    }
    public function courseName()
    {
        return $this->belongsTo(PaymentDetails::class,'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ReaservationCourse()
    {
        return $this->hasMany(PaymentDetails::class,'payment_number','invoice_id');
    }
    public function payment_enrolls()
    {
        return $this->hasMany(Enroll::class, 'provider_payment_id', 'invoice_id');
    }
    public function getInvoiceImageAttribute()
    {
        $file = $this->getMedia('invoice_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class,'invoice_id','payment_number');
    }

    public function pay_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');//->where('type', 'offline');
    }
}
