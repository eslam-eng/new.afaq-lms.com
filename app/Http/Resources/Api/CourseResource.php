<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\ReviewResource;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = app()->getLocale();

        $share_link = config('app.APP_URL', 'https://afaq.myevntoo.info') . '/' . $lang . '/course/' . $this->id;

        $member_ship = auth()->check() ? auth()->user()->active_membership : null;
        $trainer_number = \App\Models\Enroll::where(['course_id' => $this->id, 'approved' => 1])->count();

        if ($this->coursePlace && $this->coursePlace->slug == 'physical-training') {
            $location = [
                'lat'  => $this->lat,
                'lng'  => $this->lng,
                'address'  => $this->location,
            ];
        } else {
            $location = null;
        }

        $course_features = [];
//        $course_features[] = [
//            'text' => app()->getLocale() == 'en' ? "English" : 'العربية',
//            'image' => asset('afaq/language.png')
//        ];

        if ($this->lecture_hours) {
            $course_features[] = [
                'text' => trans('global.training_hours') . '  ' . $this->lecture_hours  ,
                'image' => asset('afaq/training_hours.png')
            ];
        }

        if ($trainer_number) {
            $course_features[] = [
//                'text' => $trainer_number ? $trainer_number . ' ' . __('afaq.reservation_number') : null,
                'text' => __('afaq.reservation_number') . '  ' . $trainer_number ,
                'image' => asset('afaq/graduation-cap@2x.png')
            ];
        }



        if($this->accreditation_number && $this->accredit_hours && ($this->course_accreditation_id == 12)) {
            if ($this->lecture_hours) {
                $course_features[] = [
                    'text' => $this->accredit_hours ? $this->accredit_hours . ' ' . trans('lms.hours') : null,
                    'image' => asset('afaq/cme.png')
                ];
            }
        }elseif($this->courseAccreditation->id == 13){
            $course_features[] = [
                'text' =>  trans('global.not_accredited'),
                'image' => asset('afaq/time-check@2x.png')
            ];

        } else{
            $course_features[] = [
                'text' =>  trans('global.under_accredit')  ,
                'image' => asset('afaq/time-check@2x.png')
            ];
        }

//        if (count($this->certificates)) {
//            $course_features[] = [
//                'text' => $this->certificates()->first()->name,
//                'image' => asset('afaq/certificate.png')
//            ];
//        }
        if (count($this->certificates ) && $this->certificate_price ) {

                $course_features[] = [
                    'text' => trans('lms.Certificate_fees') . ' ' . $this->certificate_price  ,
                    'image' => asset('afaq/certificate.png')
                ];

            } else {
                $course_features[] = [
                    'text' => trans('lms.Certificate'),
                    'image' => asset('afaq/certificate.png')
                ];
            }


        $timer_today = strtotime(now());
        $timer_early_date = strtotime($this->early_register_date);
        $timer_end_register_date = strtotime($this->end_register_date);
        $timer_course_start = strtotime($this->start_register_date);

        $timer_value = null;
        $timer_text = null;

        if ($timer_today < $timer_course_start) {
            $timer_value = $timer_course_start;
            $timer_text = trans('global.few_left_until_the_booking_date');
        } elseif ($timer_today < $timer_early_date) {
            $timer_value = $timer_early_date;
            $timer_text = trans('global.few_left_until_the_early_booking_date');
        } elseif (
            isset($timer_end_register_date) &&
            $timer_today < $timer_end_register_date &&
            $timer_today > $timer_early_date
        ) {
            $timer_value = $timer_end_register_date;
            $timer_text = trans('global.little_to_no_registration_deadline');
        }

        if (request('user_id')) {
            $user = User::find(request('user_id'));
        } else {
            $user = null;
        }

        $prices = $this->prices ? CoursePriceResource::collection(!$user ? $this->prices : $this->prices->where('specialty_id', $user->specialty_id)) : null;
        if($this->has_exclusive_mobile === 1){
            $price =__('home.free');
            $prices = [];
        }else{
            $price = $this->today_price ? get_price($this->today_price) : __('home.free');
        }


        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'description' => $this->description ?? null,
            'introduction' => $this->introduction_to_course ?? null,
            'price' => $price,
            'old_price' => $member_ship ? ($this->price ?? null) : null,
            'image' => $this->image ? get_image($this->image->url) : null,
            'video' => $this->video ? $this->video->url : null,
            'has_general_price' => $this->has_general_price,
            'has_exclusive_mobile' => $this->has_exclusive_mobile,
            // 'sponsor_img' => $this->sponsors->first() ? get_image($this->sponsors->first()->image_url) : null,
            'sponsor_img_object' => $this->when($this->accreditation_number && $this->accredit_hours && ($this->course_accreditation_id == 12), [
                'accreditation_number' => $this->accreditation_number ?? null,
                'accredit_hours' => $this->accredit_hours ?? null,
            ]),
            'under_accredit' => $this->when($this->course_accreditation_id == 14,$this->courseAccreditation->image_url),
            'place_img' => $this->coursePlace ? get_image($this->coursePlace->image_url) : null,
            'start_register_date' => $this->start_register_date ? date('Y-m-d', strtotime($this->start_register_date)) : null,
            'end_register_date' => $this->end_register_date ? date('Y-m-d', strtotime($this->end_register_date)) : null,
            'course_track' => $this->courseTrack ? $this->courseTrack->title : null,
            'start_date' => $this->start_date ? date('Y-m-d', strtotime($this->start_date)) : null,
            'rating' => $this->rate,
            'reviews' => ReviewResource::collection($this->reviews),

            'media' => $this->media->pluck('url')->unique()->filter(fn ($i) => $i != null)->values(),
            'instructors' => InstructorResource::collection($this->course_instructor),
            'course_features' => $course_features,
            'course_dates' => [
                'start_date' => $this->start_date ? date('Y-m-d', strtotime($this->start_date)) : null,
                'end_date' => $this->end_date ? date('Y-m-d', strtotime($this->end_date)) : null,
                'early_booking_date' => $this->early_register_date ? date('Y-m-d', strtotime($this->early_register_date)) : null,
            ],
            'course_prices' => $prices,
            'course_content' => $this->sections ? CourseSectionResource::collection($this->sections) : null,
            'collaborations' => $this->collaborations ? collect($this->collaborations)->pluck('image_url')->toArray() : null,
            'target_audience' => $this->course_target ? collect($this->course_target)->pluck('name')->toArray() : null,
            'offered_by' => [
                'logo' => asset('afaq/logo.png'),
                'title' => 'AFAQ'
            ],
            'hosting_entities' => $this->sponsors ? collect($this->sponsors)->pluck('image_url')->toArray() : null,
            'location' => $location,
            'share_link' => __('home.share_link', ['name' => $this->name, 'link' => $share_link]),
            'share_item' => [
                'type' => 'course',
                'item_id' => $this->id
            ],
            'timer' => $this->when($timer_value, [
                'timer_value' => $timer_value,
                'timer_text' => $timer_text
            ]),
            'in_wishlist' => $this->in_wishlist,
            'in_cart' => $this->in_cart,
            'is_enrolled' => $this->is_enrolled,
            'waiting_enroll' => $this->waiting_enroll,
        ];
    }
}
