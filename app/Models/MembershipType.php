<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'un Active',
    ];

    public $table = 'membership_types';

    protected $appends = [
        'name'
    ];

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'status',

    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class,'membership_type_id','id');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? $this->name_en : $this->name_ar;
    }
}
