<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancelationPolicy extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'cancelation_policies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'course_id',
        'days',
        'amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function cancelationValues()
    {
        return $this->hasMany(CancelationPolicyValue::class,'cancelation_policy_id','id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function cancelValue()
    {
        return $this->hasOne(CancelationPolicyValue::class,'cancelation_policy_id','id');
    }
}
