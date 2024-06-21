<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const READ_RADIO = [
        '1' => 'Read',
        '0' => 'Not Read',
    ];

    public const STATUS_RADIO = [
        '1' => 'Sent',
        '0' => 'Un Sent',
    ];

    public $table = 'notifications';

    protected $dates = [
        'created_at',
        'updated_at',
        //        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'parent_id',
        'user_id',
        'type',
        'title_en',
        'title_ar',
        'message_en',
        'message_ar',
        'data',
        'status',
        'read',
        'fcm_token',
        'created_at',
        'updated_at',
        'item_id',
        'action'
        //        'deleted_at',
    ];

    protected $appends = [
        'title',
        'message'
    ];

}