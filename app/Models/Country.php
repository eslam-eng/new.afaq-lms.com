<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $appends = [
        'title','nationality'
    ];

    protected $fillable = [
        "country_code",
        "country_enName",
        "country_arName",
        "country_enNationality",
        "country_arNationality",
        "order",
        "parent_id"
    ];


    public function cities()
    {
        return $this->hasMany(Country::class , 'parent_id','id');
    }

    public function getTitleAttribute()
    {
        return (\App::getLocale() == 'en') ? $this->country_enName : $this->country_arName;
    }

    public function getNationalityAttribute()
    {
        return (\App::getLocale() == 'en') ? $this->country_enNationality : $this->country_arNationality;
    }
}
