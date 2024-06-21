<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinUsStoreRequest;
use App\Models\Blog;
use App\Models\Certificat;
use App\Models\Course;
use App\Models\IconText;
use App\Models\IconTextDe;
use App\Models\Instructor;
use App\Models\Lookup;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\SliderCard;
use App\Models\CourseCategory;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\HomePageSlider;
use App\Models\ComingSoon;
use App\Models\ContentPage;
use App\Models\ContentCategory;
use App\Models\Enquiry;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Specialty;
use App\Models\UserCertificate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $HomePageSliders = HomePageSlider::get();

        $ComingSoons = ComingSoon::get();
        $ContentCategory = ContentCategory::get();
        $sliders = Slider::with(['media'])->orderBy('order', 'asc')->get();
        $sliderCards = SliderCard::with(['media'])->get();
        $iconTexts = IconText::with(['media'])->get();
        $iconTextDes = IconTextDe::with(['media'])->get();
        $blogs = Blog::with(['categories', 'tags', 'media', 'editor'])->where('type','Business')->get();
        $partners = Partner::with(['media'])->get();
        $courses = Course::with(['instructor', 'media', 'course_instructor', 'coursePlace'])
            ->where('show_in_homepage', 1)
            ->where('show_for_all', 1)
            ->orderBy('order', 'asc')->get();

        $recently_viewed = Course::whereIn('id', session()->get('recently_viewed', []))
            ->where('show_for_all', 1)
            ->take(10)->get();


        $category_id = $courses->pluck('category_id');
        $courseCategories = CourseCategory::get();

        $specialties = Specialty::has('courses_many')->with(['courses' => function ($courses) {
            $courses->where('status', 1)
                ->where('show_in_homepage', 1)
                ->where('show_for_all', 1)
                // ->where(function($query){
                //     $query->where('show_for_all','=',1)
                //     ->orWhere('show_for_all','!=',0)
                //     ->orWhereNull('show_for_all');
                // })
                ->orderBy('created_at', 'desc')->distinct();
        }])
            ->where('show_in_homepage', 1)

            ->orderBy('order', 'asc')
            ->get();

        $coursePlaces = Lookup::whereHas('type', function ($type) {
            $type->where('slug', 'course_places');
        })
            ->where('status','1')
            ->get();
        $courseSponsors = Lookup::whereHas('type', function ($type) {
            $type->where('slug', 'course_sponsors');
        })
            ->orderby('id', 'desc')
            ->get();
        $course_collaborations = Lookup::whereHas('type', function ($type) {
                $type->where('slug', 'course_collaborations');
            })
                ->orderby('id', 'desc')
                ->where('show_in_homepage',1)
                ->get();
        $testimonials = $this->testimonials();
        $statistics = json_decode(json_encode($this->statistics()));
        return view('frontend.homepage')
            ->with('HomePageSliders', $HomePageSliders)
            ->with('ComingSoons', $ComingSoons)
            ->with('ContentCategory', $ContentCategory)
            ->with('sliders', $sliders)
            ->with('sliderCards', $sliderCards)
            ->with('iconTexts', $iconTexts)
            ->with('iconTextDes', $iconTextDes)
            ->with('blogs', $blogs)
            ->with('partners', $partners)
            ->with('courses', $courses)
            ->with('courseCategories', $courseCategories)
            ->with('specialties', $specialties)
            ->with('coursePlaces', $coursePlaces)
            ->with('courseSponsors', $courseSponsors)
            ->with('testimonials', $testimonials)
            ->with('statistics', $statistics)
            ->with('recently_viewed', $recently_viewed)
            ->with('course_collaborations',$course_collaborations);
    }


    public function pageContent($lang, $slug)
    {
        $page_content = null;
        $pages = ContentPage::get();
        foreach ($pages as $page) {
            if (Str::slug($page->title) == Str::slug($slug)) {
                $page_content = $page;
                break;
            } else {
                $page_content = ContentPage::first();
            }
        }

        $ContentCategory = ContentCategory::get();
        return view('frontend.pageContent')->with('slug', $slug)
            ->with('page_content', $page_content)
            ->with('ContentCategory', $ContentCategory);
    }

    public function contactUs()
    {
        $ContentCategory = ContentCategory::get();
        return view('frontend.contactUs')->with('ContentCategory', $ContentCategory);
    }

    public function enquiry_create(StoreEnquiryRequest $request)
    {
        $all_request = $request->all();
        $details = [
            'name' => $all_request['name'],
            'email' => $all_request['email'],
            'message' => $all_request['message'],
            'mobile' => isset($all_request['mobile']) ? $all_request['mobile'] : '' ,
        ];
        try {
            Mail::to($all_request['email'])->send(new \App\Mail\ContactMail($details));
            Mail::to(config('app.email'))->send(new \App\Mail\ContactMail($details));
        } catch (\Throwable $th) {
            // throw $th;
        }

        $enquiry = Enquiry::create($details);
        return back()->withSuccess('Your data has been sent successfully. We will contact you shortly.');
    }


    public function get_mobile_sliders()
    {
        $sliders = Slider::select('id')->get();
        return $sliders;
    }
    /**
     *
     * Testimonial
     */
    public function testimonials()
    {
        $testimonials = Testimonial::where('status', 1)->orderBy('id', 'desc')->get();
        //  return $this->toJson(TestimonialsResource::collection($testimonials));
        //           dd($testimonials);

        return $testimonials;
    }
    public function statistics()
    {
        return [
            [
                'statistic_name' => trans('lms.eventd'),
                'statistic_count'  => Course::count(),
                'satatistic_icon' => asset('frontend/img/api/courses.png')
            ],
            [
                'statistic_name' => trans('lms.certificate'),
                'statistic_count' => UserCertificate::count(),
                'satatistic_icon' => asset('frontend/img/api/certificate.png')
            ],
            [
                'statistic_name' => trans('lms.instructor'),
                'statistic_count' => Instructor::count(),
                'satatistic_icon' => asset('frontend/img/api/instructors.png')
            ],
            [
                'statistic_name' => trans('lms.user'),
                'statistic_count' => User::count(),
                'satatistic_icon' => asset('frontend/img/api/users.png')
            ]

        ];
    }
    /**
     *
     * Join Us
     */
    public function joinus()
    {
        $specializations = Specialty::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.joinus',compact('specializations'));

    }
    public function become_instructor(JoinUsStoreRequest $request)
    {

        $all_request = $request->all();

        $details = [
            'name_ar' => $all_request['name_ar'],
            'mail' => $all_request['mail'],
            'specialty_id' => $all_request['specialty_id'],
            'job_title' => $all_request['job_title'],
            'workplace' => $all_request['workplace'],
            'recent_work' => $all_request['recent_work'],
            'twitter_account' => $all_request['twitter_account'],
            'mobile' => $all_request['mobile'],
            'resume' => $all_request['resume'],
            'status' => 0,
        ];

        try {
            Mail::to($all_request['mail'])->send(new \App\Mail\JoinMail($details));
            Mail::to(config('app.email'))->send(new \App\Mail\JoinMail($details));
        } catch (\Throwable $th) {
            // throw $th;
        }

        if (isset($details['resume'])) {
            $details['resume'] = $details['resume']->store('InstructorResume', 'public');

        }
        $join = Instructor::create($details);

        return redirect()->route('join_us',['locale'=>app()->getLocale()])->with('message','Your data has been sent successfully. We will contact you shortly.');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * Ideal Partners
     */
    public function idealpartner()
    {
        $testimonials = Testimonial::where('status', 1)->orderBy('id', 'desc')->get();
        return view('frontend.ideal_partners_list')->with('testimonials', $testimonials) ;
    }
    public function idealpartner_details($testimonials_id)
    {
        $testimonials_id =  \request()->segment(3);
        $testimonial = Testimonial::find($testimonials_id);
        return view('frontend.ideal_partner_details', compact('testimonial'));
    }

    /**
     * Business Archive
     */
    public function afaq_archive()
    {
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        return view('frontend.afaq_archive')
            ->with('ContentCategory', $ContentCategory)
            ;
    }
    /**
     * Business Wishlist
     */
    public function afaq_wishlist()
    {
        $ContentCategory = ContentCategory::where('type', 'Business')->get();
        return view('frontend.afaq_wishlist')
            ->with('ContentCategory', $ContentCategory)
            ;
    }
}
