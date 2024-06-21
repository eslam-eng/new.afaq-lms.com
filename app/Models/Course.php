<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;
    public $table = 'courses';
    public const SHOW_IN_HOMEPAGE = [
        '1' => 'true',
        '0' => 'false',
    ];
    public const SHOW_FOR_ALL_SELECT = [
        '1' => 'Show',
        '0' => 'Hide',
    ];

    public const TRAINING_TYPE_RADIO = [
        'course'     => 'Course',
        'conference' => 'Conference',
        'workshop' => 'Workshop',

    ];
    public const ATTEND_TYPE_SELECT = [
        'attend-leave' => 'Attend&Leave',
        'attend'        => 'Attend',
    ];
    public const COURSE_PLACE_SELECT = [
        'online'   => 'Online',
        'onsite'   => 'Onsite',
        'recorded' => 'Recorded',
    ];
    public const STATUS_SELECT = [
        '0' => 'Un Published',
        '1' => 'Published',
        '2' => 'Ended',
        '3' => 'With Offer',
        '4' => 'Hide to all',
    ];

    public const COURSE_ACCREDITATION_SPONSOR_SELECT = [];

    public const COOPERATE_ACCREDITATION_SPONSOR_SELECT = [];

    public const HOSTING_COOPERATE_ACCREDITATION_SPONSOR_SELECT = [];
    public const ACCREDITATION_RADIO = [
        '1' => 'Accredited',
        '0' => 'Not Accredited',
    ];


    protected $appends = [
        'image_en',
        'image_ar',
        'banner_en',
        'banner_ar',
        'image',
        'banner',
        'video',
        'name',
        'description',
        'introduction_to_course',
        'today_price',
        'early_price_for_user',
        'late_price_for_user',
        'rate',
        'in_cart',
        'in_wishlist',
        'is_enrolled',
        'waiting_enroll'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'early_register_date',
        'start_register_date',
        'end_register_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'success_percentage',
        'has_general_price',
        'course_accreditation_id',
        'requirements_en',
        'requirements_ar',
        'has_special_policy',
        'policy_en',
        'policy_ar',
        'evaluation',
        'full_training_evaluation',
        'course_track_id',
        'course_classification_id',
        'course_availability_id',
        'course_place_id',
        'lat',
        'lng',
        'detailed_address',

        'country_id',
        'city_id',
        'category_id',
        'moodle',
        //'instructor_id',
        'name_en',
        'name_ar',
        'price',
        'start_date',
        'end_date',
        'image_title_en',
        'image_title_ar',
        'introduction_to_course_en',
        'introduction_to_course_ar',
        'certificate_price',
        'accreditation_number',
        'accredit_hours',
        'start_register_date',
        'early_register_date',
        'end_register_date',
        'course_place',
        'location',
        'training_type',
        'accreditation',
        'price',
        'member_price',
        'non_member_price',
        'description_en',
        'description_ar',
        'lecture_hours',
        'seating_number',
        'created_at',
        'updated_at',
        'deleted_at',
        'show_in_homepage',
        'show_for_all',
        'order',
        'zoom_link',
        'status',
        'id',
        'attend_type',
        'has_exclusive_mobile',
        'is_generating_in_progress',
    ];


    protected static function booted()
    {
        static::addGlobalScope(new PublishedScope);
        static::addGlobalScope(function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function payment_details_accepted()
    {
        return $this->hasOne(PaymentDetails::class)->where('status', 1)->where('user_id', auth()->user()->id);
    }
    public function payment_details()
    {
        return $this->hasOne(PaymentDetails::class)->where('status', 0)->where('user_id', auth()->user()->id);
    }


    public function prices()
    {
        return $this->hasMany(CoursePrice::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_courses')->withPivot('completion_date','completion_percentage')->withTrashed();
    }

    public function enrolls()
    {
        return $this->hasMany(Enroll::class);
    }

    public function getTodayPriceAttribute($user_id = null)
    {
        if ($user_id) {
            $user = User::find($user_id);
        } elseif (request('user_id')) {
            $user = User::find(request('user_id'));
        } elseif (auth('api')->check()) {
            $user = auth('api')->user();
        } else {
            $user = auth()->user();
        }

        $prices = $this->prices();
        if ($user) {
            $prices = $prices->where('specialty_id', $user->specialty_id);
        }
        $prices = $prices->first();

        $today_price = null;
        $early_date = strtotime($this->early_register_date);
        $start_date = strtotime($this->start_register_date);
        $end_date = strtotime($this->end_register_date);
        $today = strtotime(now());

        if ($user && count($user->memberships) && $user->active_membership && $this->member_price) {
            $today_price =  $this->member_price;
        } else if ($this->has_general_price) {
            $today_price = $this->price;
        } else if ($prices && $user) {
            if ($early_date >= $today) {
                $today_price =  $prices->early_price;
            } elseif (($today < $end_date) && ($today > $early_date)) {
                $today_price =  $prices->late_price;
            }
        }

        // else {
        //     $current_price =  $this->member_price ?? ($this->price ?? ($this->prices()->count() ? $this->prices()->first() : 100));

        //     if (!$this->member_price && !$this->price && $this->prices()->count()) {
        //         if ($early_date >= $today) {
        //             $today_price =  $current_price->early_price;
        //         } elseif (($today < $end_date) && ($today > $early_date)) {
        //             $today_price =  $current_price->late_price;
        //         }
        //     }
        // }

        return $today_price;
    }

    public function getEarlyPriceForUserAttribute()
    {
        $prices = $this->prices()->where('specialty_id', auth()->user()->specialty_id ?? null)
            ->first();

        $early_date = strtotime($this->early_register_date);
        $today = strtotime(now());
        if ($prices && $early_date >= $today) {
            return $prices->early_price;
        }

        return null;
    }

    public function getLatePriceForUserAttribute()
    {
        $prices = $this->prices()->where('specialty_id', auth()->user()->specialty_id ?? null)
            ->first();

        $end_date = strtotime($this->end_register_date);
        $today = strtotime(now());
        if ($prices && $end_date  >= $today) {
            return $prices->late_price;
        }

        return null;
    }

    public function isAvailableforUser()
    {
        if (auth()->check()) {
            $exists = $this->course_target_group()->where('course_target_group.specialty_id', auth()->user()->specialty_id)
                ->first();
            return $exists ? true : false;
        } else {
            return false;
        }
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    // public function instructors()
    // {
    //     return $this->belongsTo(CourseI::class, 'instructor_id');
    // }


    public function course_instructor()
    {
        return $this->belongsToMany(Instructor::class, 'course_instructors'); //, 'instructor_id' , 'course_id'
    }

    public function course_target()
    {
        return $this->belongsToMany(Specialty::class, 'course_target_group')->distinct(); //, 'specialty_id' , 'course_id'
    }

    public function course_targets()
    {
        return $this->hasMany(CourseSpecialty::class, 'course_id')->distinct(); //, 'specialty_id' , 'course_id'
    }

    public function course_sub_specialty()
    {
        return $this->belongsToMany(SubSpecialty::class, 'course_sub_specialties')->distinct(); //, 'sub_specialty_id' , 'course_id'
    }
    public function course_target_group()
    {
        return $this->belongsToMany(Specialty::class, 'course_target_group', 'course_id', 'specialty_id')->distinct(); //, 'specialty_id' , 'course_id'
    }

    public function course_accreditation_sponsor()
    {
        return $this->belongsToMany(AccreditationSponsor::class, 'course_accreditation_sponsors')->withPivot(['type']); //, 'accreditation_sponsor_id' , 'course_id'
    }

    public function course_accreditations()
    {
        return $this->hasMany(CourseAccreditationSponsor::class)->where('type', 'Accredited')->with('accreditation');
    }

    public function course_Cooperated_accreditations()
    {
        return $this->hasMany(CourseAccreditationSponsor::class)->where('type', 'Cooperated')->with('accreditation');
    }
    public function course_Hosted_accreditations()
    {
        return $this->hasMany(CourseAccreditationSponsor::class)->where('type', 'Hosted')->with('accreditation');
    }

    public function getImageEnAttribute()
    {
        $file = $this->getMedia('course_image_en_' . $this->id)->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
    public function getImageArAttribute()
    {
        $file = $this->getMedia('course_image_ar_' . $this->id)->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getBannerEnAttribute()
    {
        $file = $this->getMedia('course_banner_en_' . $this->id)->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
    public function getBannerArAttribute()
    {
        $file = $this->getMedia('course_banner_ar_' . $this->id)->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
    public function getVideoAttribute()
    {
        $file = $this->getMedia('course_video_' . $this->id)->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getImageAttribute()
    {
        return app()->getLocale() == 'en' ? $this->image_en : $this->image_ar;
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getStartRegisterDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartRegisterDateAttribute($value)
    {
        $this->attributes['start_register_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getEndRegisterDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndRegisterDateAttribute($value)
    {
        $this->attributes['end_register_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getEarlyRegisterDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEarlyRegisterDateAttribute($value)
    {
        $this->attributes['early_register_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }


    // public function getEarlyRegisterDateAttribute()
    // {
    //     // dd($this->attributes['early_register_date']);
    //     return date("d-m-Y", strtotime($this->attributes['early_register_date']));
    // }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function certificate()
    {
        return $this->hasOne(CourseCertificate::class);
    }
    //Attendance design
    public function attendance_design()
    {
        return $this->hasOne(CourseAttendenceDesign::class);
    }



    public function certificates()
    {
        return $this->hasMany(CourseCertificate::class);
    }
    //Attendance design Many
    public function attend_designs()
    {
        return $this->hasMany(CourseAttendenceDesign::class);
    }

    public function course_certificates_many()
    {
        return $this->belongsToMany(CourseCertificate::class, 'course_certificates', 'course_id', 'certificate_id');
    }

    /**
     * @return Course attendence
     */
    public function course_attendes_many()
    {
        return $this->belongsToMany(CourseAttendenceDesign::class, 'course_attendence_designs', 'course_id', 'attendance_design_id');
    }

    public function courses_users()
    {
        return $this->belongsToMany(User::class, 'users_courses')->withTrashed(); //, 'instructor_id' , 'course_id'
    }

    public function zooms()
    {
        return $this->hasMany(ZoomMeeting::class);
    }


    /**
     * Get all of the collaborations that are assigned this collaborations
     */
    public function collaborations()
    {
        return $this->morphToMany(Lookup::class, 'lookupable')->where('type', 'course_collaborations')->where('lookupables.deleted_at', null);
    }
    public function organizers()
    {
        return $this->morphToMany(Lookup::class, 'lookupable')->where('type', 'course_organizers')->where('lookupables.deleted_at', null);
    }

    /**
     * Get all of the sponsors that are assigned this sponsors
     */
    public function sponsors()
    {
        return $this->morphToMany(Lookup::class, 'lookupable')->where('type', 'course_sponsors')->where('lookupables.deleted_at', null);
    }

    /**
     * Get all of the sub_classifications that are assigned this sub_classifications
     */
    public function subClassifications()
    {
        return $this->morphToMany(Lookup::class, 'lookupable')->where('type', 'course_sub_classifications');
    }

    /**
     * Get all of the lookups that are assigned this lookups
     */
    public function lookups()
    {
        return $this->morphToMany(Lookup::class, 'lookupable');
    }

    public function coursePlace()
    {
        return $this->belongsTo(Lookup::class, 'course_place_id', 'id');
    }

    public function courseAvailability()
    {
        return $this->belongsTo(Lookup::class, 'course_availability_id', 'id');
    }
    public function courseAccreditation()
    {
        return $this->belongsTo(Lookup::class, 'course_accreditation_id', 'id');
    }
    public function courseClassification()
    {
        return $this->belongsTo(Lookup::class, 'course_classification_id', 'id');
    }

    public function courseTrack()
    {
        return $this->belongsTo(Lookup::class, 'course_track_id', 'id');
    }

    public function getBannerAttribute()
    {
        return app()->getLocale() == 'en' ? $this->banner_en : $this->banner_ar;
    }

    public function setShowInHomepageAttribute($value)
    {
        if ($value == 'on') {
            $this->attributes['show_in_homepage'] = 1;
        } elseif ($value == 'off') {
            $this->attributes['show_in_homepage'] = 0;
        }
    }

    public function setHasGeneralPriceAttribute($value)
    {
        if ($value == 'on') {
            $this->attributes['has_general_price'] = 1;
        } elseif ($value == 'off') {
            $this->attributes['has_general_price'] = 0;
        }
    }

    public function setHasExclusiveMobileAttribute($value)
    {
        if ($value == 'on') {
            $this->attributes['has_exclusive_mobile'] = 1;
        } elseif ($value == 'off') {
            $this->attributes['has_exclusive_mobile'] = 0;
        }
    }


    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->name_en ?? $this->name_ar ?? null)  : ($this->name_ar ?? $this->name_en ?? null);
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->description_en ?? $this->description_ar ?? null) : ($this->description_ar ?? $this->description_en ?? null);
    }

    public function getIntroductionToCourseAttribute()
    {
        return app()->getLocale() == 'en' ? ($this->introduction_to_course_en ?? $this->introduction_to_course_ar ?? null) : ($this->introduction_to_course_ar ?? $this->introduction_to_course_en ?? null);
    }

    public function quizes()
    {
        return $this->hasMany(CourseQuize::class, 'course_id', 'id');
    }
    public function quizesScores()
    {
        return $this->hasMany(CourseQuizeScore::class, 'course_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class, 'course_id', 'id');
    }
    public function questionaire()
    {
        return $this->hasOne(CourseQuestionaire::class, 'course_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id', 'id');
    }

    public function getRateAttribute()
    {
        return  $this->reviews()->count() > 0 ? (string)round($this->reviews()->sum('rate') / $this->reviews()->count(), 2) : 0;
    }
    public function lectures()
    {
        return $this->hasMany(CourseSectionLecture::class, 'course_id', 'id');
    }

    public function courseVideoScore()
    {
        return $this->hasMany(CourseVideoScore::class, 'course_id', 'id');
    }

    public function courseNotes()
    {
        return $this->hasMany(CourseSectionLectureNote::class, 'course_id', 'id');
    }
    public function user_courses()
    {
        return $this->hasMany(UsersCourse::class)->where('user_id', auth()->user()->id);
    }

    public function user_course()
    {
        return $this->hasOne(UsersCourse::class, 'course_id')->where('user_id', auth()->user()->id);
    }

    public function getInCartAttribute()
    {
        $user_id = null;

        if (auth()->check()) {
            $user_id = auth()->user()->id;
        }
        if (request('user_id')) {
            $user_id = request('user_id');
        }

        if ($user_id) {
            if (CartItem::where(['course_id' => $this->id, 'user_id' => $user_id])->whereNull('payment_provider')->first()) {
                return true;
            }
        }
        return false;
    }

    public function getWaitingEnrollAttribute()
    {
        $user_id = null;

        if (auth('api')->check()) {
            $user_id = auth('api')->user()->id;
        }
        if (request('user_id')) {
            $user_id = request('user_id');
        }

        if ($user_id) {
            if (Enroll::where(['course_id' => $this->id, 'user_id' => $user_id, 'status' => 0])->first()) {
                return true;
            }
        }

        return false;
    }
    public function getInWishlistAttribute()
    {
        $in_wishlist = request()->header('token') ? Wishlist::where(function ($q) {
            $q->where(['course_id' => $this->id, 'token' => request()->header('token')]);
        })->exists() : false;

        if ($in_wishlist) {
            return true;
        }
        return false;
    }

    public function getIsEnrolledAttribute()
    {
        $user_id = null;

        if (auth('api')->check()) {
            $user_id = auth('api')->user()->id;
        }
        if (request('user_id')) {
            $user_id = request('user_id');
        }

        if ($user_id) {
            if (Enroll::where(['course_id' => $this->id, 'user_id' => $user_id, 'status' => 1])->first()) {
                return true;
            }
        }
        return false;
    }

    public function attends()
    {
        return  $this->hasMany(UserAttendance::class, 'course_id');
    }

    public function soldOut(){
        $reservation_number =  Enroll::reservation_number($this->id);
        return (($reservation_number < $this->seating_number)  && !is_null($this->seating_number) && $this->seating_number !== 0 ) ? False : True ;
    }

    public function getAllCoursesNames(){

        return Course::where('status', 1)->pluck('name_' . app()->getLocale() . ' as name', 'id');

    }

    public function is_in_wishlist(){
        return Wishlist::where(['course_id' => $this->id, 'user_id' => auth()->user()->id])->exists();

    }

}
