<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointType extends Model
{
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Un Active',
    ];

    public $table = 'point_types';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'name_en',
        'name_ar',
        'key',
        'status',
        'created_at',
        'updated_at',

    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function value()
    {
        return $this->hasOne(PointTypeValue::class);
    }
}
