<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
//    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'un Active',
    ];
    public $table = 'wallets';

    protected $dates = [
        'created_at',
        'updated_at',
//        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'currency',
        'balance',
        'status',
        'created_at',
        'updated_at',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
