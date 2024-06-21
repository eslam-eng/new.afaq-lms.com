<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'content_categories';

    public const TYPE_SELECT = [
        'AFAQ'     => 'AFAQ',
        'Business' => 'Business',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function contents()
    {
        return $this->belongsToMany(ContentPage::class,'content_category_content_page','content_category_id','content_page_id');
    }
}
