<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Observers\PointObserver;

class Point extends Model
{
    use HasFactory;
    public const USE_CODE_SELECT = [
        '1' => 'Used',
        '0' => 'Not Used',
    ];
    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'un Active',
    ];
    public $table = 'points';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'currency',
        'points',
        'status',
        'invite_code',
        'use_code',
        'used_code',
        'created_at',
        'updated_at',
    ];

    public static function booted()
    {
        Point::observe(PointObserver::class);
        self::creating(function ($model) {
            $model->invite_code = rand(10000 , 99999);
        });
    }
    


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
