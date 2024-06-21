<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, HasApiTokens, InteractsWithMedia, HasFactory;

    public $table = 'users';

    protected $with = ['wallet'];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $appends = [
        'personal_photo','full_name'
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    const DEGREE_SELECT = [
        'BSC.'                 => 'BSC.',
        'BA.'                  => 'BA.',
        'Diploma'              => 'Diploma',
        'PHD.'                 => 'PHD.',
        'High School Graduate' => 'High School Graduate',
        'Other'                => 'Other',
    ];
    protected $fillable = [
        'name',
        'name_title',
        'email',
        'email_verified_at',
        'password',
        'approved',
        'verified',
        'verified_at',
        'verification_token',
        'remember_token',
        'full_name_en',
        'full_name_ar',
        'birth_date',
        'phone',
        'country',
        'city',
        'degree',
        'status',
        'reason',
        'created_at',
        'updated_at',
        'deleted_at',
        'gender',
        'specialty_id',
        'sub_specialty_id',
        'nationality_id',
        'identity_type',
        'identity_number',
        'occupational_classification_number',
        'sub_degree',
        'job_place',
        'job_name',
        'fcm_token'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            try {

                if (auth()->check()) {
                    $user->verified    = 1;
                    $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                    $user->save();
                } elseif (!$user->verification_token) {
                    $token     = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();

                    while ($usedToken) {
                        $token     = Str::random(64);
                        $usedToken = User::where('verification_token', $token)->first();
                    }

                    $user->verification_token = $token;
                    $user->save();

                    $registrationRole = config('panel.registration_default_role');

                    if (!$user->roles()->get()->contains($registrationRole)) {
                        $user->roles()->attach($registrationRole);
                    }

                    $user->notify(new VerifyUserNotification($user));
                }
                //code...
            } catch (\Throwable $th) {
                //throw $th;
            }
        });
    }
    public static function boot()
    {
        parent::boot();
        // User::observe(new \App\Observers\UserActionObserver);
    }


    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
    public function SubSpecialty()
    {
        return $this->belongsTo(SubSpecialty::class, 'sub_specialty_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'users_courses');
    }

    public function certificates()
    {
        return $this->hasMany(UserCertificate::class)->with('course', 'certificate')->has('course')->has('certificate');
    }

    public function userCertificates()
    {
        return $this->belongsToMany(Certificat::class, 'user_certificates', 'user_id', 'certificate_id');
    }
    public function userExams()
    {
        return $this->belongsToMany(Exam::class, 'user_exams', 'user_id', 'exam_id');
    }

    public function enrolls()
    {
        return $this->hasMany(Enroll::class, 'user_id', 'id');
    }
    public function userInvoices()
    {
        return $this->hasMany(BankInvoice::class, 'user_id');
    }

    public function userPayments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }
    public function userUserMemberships()
    {
        return $this->hasMany(UserMembership::class, 'user_id', 'id');
    }
    public function membership()
    {
        return $this->belongsTo(UserMembership::class, 'membership_id');
    }

    public function memberships()
    {
        return $this->hasMany(UserMembership::class);
    }

    public function active_membership()
    {
        return $this->hasOne(UserMembership::class)->where('status', 1)->where('end_date', '>=', date('Y-m-d'));
    }

    public function last_membership()
    {
        return $this->hasOne(UserMembership::class)->latest();
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }
    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? date('Y-m-d H:i:s', strtotime($value)) : null;
    }

    public function setPasswordAttribute($input)
    {
        $this->attributes['password'] = $input && Hash::needsRehash($input) ? Hash::make($input) : $input;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ?  date('Y-m-d H:i:s', strtotime($value)) : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getPersonalPhotoAttribute()
    {
        $file = $this->getMedia('personal_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }


    public function getBirthDateAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function country_and_nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function providers()
    {
        return $this->hasMany(Provider::class, 'user_id', 'id');
    }

    public function tokens()
    {
        return $this->hasMany(UserToken::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function tickets_comments()
    {
        return $this->hasMany(TicketsComment::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getFullNameAttribute()
    {
        return app()->getLocale() == 'en' ? $this->full_name_en : $this->full_name_ar;
    }
}
