<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankList extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'Un Active',
    ];

    public $table = 'bank_lists';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $append = ['name'];
    protected $fillable = [
        'name_en',
        'name_ar',
        'status',
        'created_at',
        'updated_at',

    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? $this->name_en : $this->name_ar;
    }
}
