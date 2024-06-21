<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoomReport extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'id',
        'user_id',
        'name',
        'user_email',
        'join_time',
        'leave_time',
        'duration',
        'attentiveness_score',
        'failover',
        'status',
        'customer_key',
        'meeting_id',
        'report_id',
        'join_percentage',
	'participant_user_id',
    ];
}
