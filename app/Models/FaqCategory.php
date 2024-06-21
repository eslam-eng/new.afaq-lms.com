<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class FaqCategory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'faq_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public const TYPE_SELECT = [
        'wallet' => 'Wallet',
        'point' => 'Point',
        '' => 'Null',
        'business' => 'Business',
    ];
    protected $fillable = [
        'category_ar',
        'category_en',
        'created_at',
        'updated_at',
        'deleted_at',
        'type',
         'order',
    ];

    protected $appends = [
        'category'
    ];

    public function getCategoryAttribute()
    {
        return app()->getLocale() == 'en' ? $this->category_en : $this->category_ar;
    }
    public function faqQuestions()
    {
        return $this->hasMany(FaqQuestion::class,'category_id','id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
