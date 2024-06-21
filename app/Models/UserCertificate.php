<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCertificate extends Model
{
    use HasFactory;

    public $table = 'user_certificates';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'course_id',
        'exam_id',
        'certificate_id',
        'certificate_img',
        'qrcode'
    ];

    protected $appends = ['has_img', 'cer_image'];

    public function certificate()
    {
        return $this->belongsTo(Certificat::class, 'certificate_id');
    }

    public function getHasImgAttribute()
    {
        return $this->certificate_img ? is_array(json_decode($this->certificate_img, true)) : 0;
    }

    public function getCerImageAttribute()
    {
        if ($this->certificate_img && is_array(json_decode($this->certificate_img, true))) {

            return json_decode($this->certificate_img)->src ?? '';
        } else {
            return $this->certificate_img;
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class)->withoutGlobalScopes();
    }


    public static function boot(){
        parent::boot();

        UserCertificate::observe(new \App\Observers\Certifacte);
    }
}
