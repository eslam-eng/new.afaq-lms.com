<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointTypeValue extends Model
{

    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'UN Active',
    ];

    public $table = 'point_type_values';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'point_type_id',
        'give_point',
        'get_point',
        'status',
        'created_at',
        'updated_at',

    ];

    public function point_type()
    {
        return $this->belongsTo(PointType::class, 'point_type_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
