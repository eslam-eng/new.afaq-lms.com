<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancelationPolicyValue extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'cancelation_policy_values';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'days',
        'amount',
        'cancelation_policy_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cancelationPolicy()
    {
        return $this->belongsTo(CancelationPolicy::class, 'cancelation_policy_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
