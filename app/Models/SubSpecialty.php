<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSpecialty extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'sub_specialties';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends =[
        'name'
    ];
    protected $fillable = [
        'specialty_id',
        'name_en',
        'name_ar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getNameAttribute()
    {
        return (app()->getLocale() == 'en') ? $this->name_en : $this->name_ar;
    }
}
