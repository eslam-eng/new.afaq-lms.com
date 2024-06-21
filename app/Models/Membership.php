<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TIME_TYPE_SELECT = [
        'for_one_year'   => 'Year',
        'for_two_year'   => '2 Year',
        'for_three_year' => '3 Year',

    ];

    public $table = 'memberships';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'membership_type_id',
        'time_type',
        'price',
        'link',
        'subscribtion_count',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function membership_type()
    {
        return $this->belongsTo(MembershipType::class, 'membership_type_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
