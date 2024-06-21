<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\QuickAccessResource;
use App\Http\Resources\Api\FeaturedResource;
use App\Http\Resources\Api\SliderResource;
use App\Http\Resources\Api\SpecialtiesResource;
use App\Models\Certificat;
use App\Http\Resources\Api\TestimonialsResource;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lookup;
use App\Models\Slider;
use App\Models\Specialty;
use App\Models\User;
use App\Models\UserCertificate;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class HomePageApiController extends Controller
{
    public function banners()
    {
        try {
            $slider = Slider::all();
            return $this->toJson(SliderResource::collection($slider));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function featured()
    {
        try {
            $featured = Course::with('coursePlace', 'sponsors', 'courseTrack','prices')->where('status', 1)->where('show_in_homepage', 1)->where('show_for_all', 1)->orderBy('id', 'desc')->take(10)->get();
            return $this->toJson(FeaturedResource::collection($featured));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function quickAccess()
    {
        try {
            $quickAccess = Lookup::where('lookup_type_id', 1)->orderBy('id', 'desc')->take(10)->get();
            return $this->toJson(QuickAccessResource::collection($quickAccess));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function topActivities(Request $request)
    {
        try {
            $specialties = Specialty::with(['courses' => function ($courses) {
                $courses->where('status', 1)->where('show_in_homepage', 1)->where('show_for_all', 1)->distinct();
            }])->get();
            return $this->toJson(SpecialtiesResource::collection($specialties));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }
    /**
     *
     * Testimonial
     */
    public function testimonials()
    {
        try {
            $testimonials = Testimonial::where('status', 1)->orderBy('id', 'desc')->get();
            return $this->toJson(TestimonialsResource::collection($testimonials));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function recordedCourses(Request $request)
    {
        try {
            $recorded_courses = Course::with('coursePlace', 'sponsors', 'courseTrack')->where('status', 1)->where('show_for_all', 1)->whereHas('coursePlace', function ($course_place) {
                $course_place->where('slug', 'recorded');
            })->where('show_in_homepage', 1)->orderBy('id', 'desc')->take(10)->get();

            return $this->toJson(FeaturedResource::collection($recorded_courses));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function recentlyViewed(Request $request)
    {
        try {
            $recently_courses = Course::with('coursePlace', 'sponsors', 'courseTrack');

            if ($request->courses_ids) {
                $courses_ids = json_decode($request->courses_ids);
                $recently_courses = $recently_courses->whereIn('id', $courses_ids);
            }

            $recently_courses = $recently_courses->where('show_in_homepage', 1)->where('status', 1)->where('show_for_all', 1)->orderBy('id', 'desc')->take(10)->get();

            return $this->toJson(FeaturedResource::collection($recently_courses));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function statistics(Request $request)
    {
        return $this->toJson([
            [
                'statistic_name' => trans('lms.eventd'),
                'statistic_count'  => Course::count()+ 1000,
                'satatistic_icon' => asset('frontend/img/api/courses.png')
            ],
            [
                'statistic_name' => trans('lms.certificate'),
                'statistic_count' => UserCertificate::count()+ 1000,
                'satatistic_icon' => asset('frontend/img/api/certificate.png')
            ],
            [
                'statistic_name' => trans('lms.instructor'),
                'statistic_count' => Instructor::count()+ 1000,
                'satatistic_icon' => asset('frontend/img/api/instructors.png')
            ],
            [
                'statistic_name' => trans('lms.user'),
                'statistic_count' => User::count()+ 1000,
                'satatistic_icon' => asset('frontend/img/api/users.png')
            ]

        ]);
    }
}
