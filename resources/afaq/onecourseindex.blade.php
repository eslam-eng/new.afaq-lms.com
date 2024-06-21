@extends('layouts.front')
@section('title')
    <title>{{app()->getLocale()=='en' ? $oneCourse->name_en ?? '' : $oneCourse->name_ar ?? ''}}</title>
@endsection
@section('content')

    <!-- ********** end header ************** -->
    <?php
    // date_default_timezone_set('UTC');
    $zoom_links_exist = $oneCourse->zooms;
    $zoom = $oneCourse->zooms
        ? $oneCourse
            ->zooms()
            ->orderBy('end_time', 'asc')
            ->where('end_time', '>=', date('Y-m-d H:i:s', strtotime(now())))
            ->first()
        : null;
    $zoom_link = $zoom ? $zoom->join_url : null;
    $date = $zoom ? $zoom->start_time : '1970-01-01';
    $end_time = $zoom ? $zoom->end_time : null;
    $now = date('Y-m-d H:i:s', strtotime(now()));
    $today = strtotime(now());
    $early_date = strtotime($oneCourse->early_register_date);
    $end_register_date = strtotime($oneCourse->end_register_date);
    $collapse_config = \App\Models\CourseConfigration::where('type', 'course')
        ->where('status', 1)
        ->where('key', 'auto_collapse_style')
        ->first();

    $all_count = count($oneCourse->zooms) + count($oneCourse->quizes);
    $count_attended_zooms = 0;
    if (count($oneCourse->zooms)) {
        if (auth()->check()) {
            $count_attended_zooms = $oneCourse
                ->zooms()
                ->whereHas('reports', function ($reports) {
                    $reports->where('user_id', auth()->user()->id);
                })
                ->count();
        }

        $get_zoom_class = get_class($oneCourse->zooms()->first());
        $zooms = $oneCourse
            ->zooms()
            ->select('id', 'start_time', 'join_url')
            ->get();

        $zooms = $zooms->map(function ($zoom) use ($get_zoom_class) {
            $zoom['class'] = $get_zoom_class;
            // $zoom['id'] = 'z-' . $zoom->id;
            return $zoom;
        });
    } else {
        $zooms = [];
    }

    $count_quizes_answered = 0;
    if (count($oneCourse->quizes)) {
        if (auth()->check()) {
            $count_quizes_answered = $oneCourse
                ->quizes()
                ->whereHas('scores', function ($scores) {
                    $scores->where('user_id', auth()->user()->id);
                })
                ->count();
        }

        $get_quize_class = get_class($oneCourse->quizes()->first());
        $quizes = $oneCourse
            ->quizes()
            ->select('id', 'start_at as start_time')
            ->get();

        $quizes = $quizes->map(function ($quize) use ($get_quize_class) {
            $quize['class'] = $get_quize_class;
            $quize['join_url'] = route('one-course-quize', ['locale' => app()->getLocale(), 'quize_id' => $quize->id]);

            return $quize;
        });
    } else {
        $quizes = [];
    }

    if (count($zooms) && count($quizes)) {
        $grouped_zooms = collect($zooms)->merge(collect($quizes));
    } elseif (count($zooms)) {
        $grouped_zooms = $zooms;
    } elseif (count($quizes)) {
        $grouped_zooms = $quizes;
    } else {
        $grouped_zooms = null;
    }

    if ($grouped_zooms) {
        $grouped_zooms = $grouped_zooms->sortBy(['start_time', 'asc'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->start_time)->format('Y-m-d'); // grouping by years
            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
    } else {
        $grouped_zooms = null;
    }

    if (auth()->check()) {
        $login = true;
        $reserved = \App\Models\PaymentDetails::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id,'status' => 1])->count();
        $user_course = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first();
        $check_exist = \App\Models\Enroll::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first();
        $check_cart = \App\Models\CartItem::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first();
        if (empty($check_cart)) {
            $check_cart = \App\Models\Enroll::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first() ? 'wait_payment' : 0;
        }

        $spe =$oneCourse
            ->course_target_group()
            ->where('specialty_id', auth()->user()->specialty_id)
            ->exists();
        $sub_spe= $oneCourse->course_sub_specialty()->where('sub_specialty_id', auth()->user()->sub_specialty_id)->exists();

        if($spe && !$sub_spe && count($oneCourse->course_sub_specialty)){
            $current_specialty =null;
        }elseif($spe && !count($oneCourse->course_sub_specialty)){
            $current_specialty = $oneCourse
            ->prices()
            ->where('specialty_id', auth()->user()->specialty_id)
            ->first();
        }elseif ($sub_spe) {
            $current_specialty = $oneCourse
            ->prices()
            ->where('specialty_id', auth()->user()->specialty_id)
            ->first();
        }
        else {
            $current_specialty =null;
        }
    } else {
        $login = false;
        $reserved = 0;
        $user_course = null;
        $check_exist = null;
        $check_cart = null;
        $current_specialty = null;
    }
    ?>
    <!-- ********** end header ************** -->
    {{-- @include('frontend.oneCoursePage.partials.share-course') --}}
    <style>
        .open-zoom i {
            color: rgb(136, 189, 47);
        }

        .Brought-img {
            cursor: pointer;
        }

        .book-btn_ .add-card-btn {
            width: auto !important;
        }

        .swiper {
            width: 100%;
            height: 100%;
            overflow: hidden !important;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            /* background: #fff; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* .swiper-slide, swiper-slide{
           width: auto !important;
        } */
        .stick-tabs-afaq .swiper.mySwiper.all-tabs-section {
            width: 100%;
        }
        .swiper-wrapper {
      display: flex !important;
    }
        /* .stick-tabs-afaq span.item {
            width: max-content !important;
            display: flex;
        } */

        span.item {
        border-radius: 30px;
        padding: 6px 10px;
        color: #707070;
        margin: 0 10px;
        cursor: pointer;
        font-weight: 500;
        font-size: 16px;
        display: flex;
        align-items: center;
        width: max-content;
        }

.swiper-slide, swiper-slide {
    width: auto !important;
}

    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.css" integrity="sha512-zar81H5lVN36QFsq/da1hxpOLODXK4/oFwBGOFrvdWX6SBe3NWriWTQS6YQDVfW5fDeb2Vry41YQCELOe8cHww==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="inner-bunner"
            @if ($oneCourse->banner) style="background-image:url('{{ $oneCourse->banner->url }}')" @endif>
            <div class="col-12 onecourse-bunner">
                <div class="br-div" style="">
                    <ul class="br-ul">
                        <li><a href="{{ route('site-home', ['locale' => app()->getLocale()]) }}">{{ __('lms.homepage') }}</a>
                            /
                        </li>
                        <li><a
                                href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">{{ __('frontend.eventandactivities') }}</a>
                            /</li>
                        <li><a
                                href="{{ route('one-courses-new', ['courses_id' => $oneCourse->id, 'locale' => app()->getLocale()]) }}">{{ $oneCourse->name }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-10 offset-1">

                    <div class="all-data-in-bunner">

                        <div class="inner-page-cours-type d-flex align-items-center justify-content-start">
                            @if ($oneCourse->courseAccreditation && $oneCourse->courseAccreditation->slug == 'accredited')
                                <span class="Accredited">{{ __('afaq.Accredited') }}</span>
                            @endif

                            @if ($oneCourse->courseTrack && $oneCourse->courseTrack->slug == 'course')
                                <span
                                    class="Course">{{ $oneCourse->courseTrack ? $oneCourse->courseTrack->title : '' }}</span>
                            @else
                                <span
                                    class="Laboratories">{{ $oneCourse->courseTrack ? $oneCourse->courseTrack->title : '' }}</span>
                            @endif
                            <span class="icon">
                                {{-- <img src="/afaq/imgs/bxs-offer.png" alt=""> --}}
                                <img src="/afaq/imgs/1371296.png" alt="">
                            </span>
                        </div>
                        <div class="inner-bunner-title">
                            <strong>
                                {{ app()->getLocale() == 'en' ? $oneCourse->name_en ?? '' : $oneCourse->name_ar ?? '' }}

                            </strong>
                        </div>
                        {{-- <div class="inner-bunner-rateing d-flex align-items-center justify-content-start">
                            <div class="star-rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="review-rate">
                                <span>(4.5)</span>
                            </div>
                            <div class="number-review-rate">
                                <span>
                                    82,862
                                    <em>
                                        ratings
                                    </em>
                                </span>
                            </div>

                        </div> --}}

                        <div class="cours-houre-count d-flex flex-wrap">
                            @if ($oneCourse->courseAccreditation && $oneCourse->courseAccreditation->slug == 'accredited')
                                <div class="cours-count_">
                                    <div class="hours-course">
                                        <div class="cme-hours">
                                            <div class="cme-top d-flex">
                                                <img  src="/afaq/imgs/Groupkkkk.png" alt="cme">
                                                <h2 class="stroke-double" title="{{ $oneCourse->accredit_hours }}">
                                                    {{ $oneCourse->accredit_hours }}</h2>
                                                <p>CME HOURS</p>
                                            </div>
                                            <div class="cme-bottom">
                                                <p>{{ $oneCourse->accreditation_number }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($oneCourse->courseAccreditation && $oneCourse->courseAccreditation->slug == 'under-accreditation')
                                <div class="cours-count_ not-allowed">
                                    <img class=""  src="{{asset('storage/'.$oneCourse->courseAccreditation->image)}}" alt="cme">

                                </div>
                            @endif

                            @if ($oneCourse->coursePlace)
                                <div class="cours-type_">
                                    <img src="{{ $oneCourse->coursePlace ? $oneCourse->coursePlace->image_url : '' }}"
                                        alt="">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- *********** end-slider ******************** -->
    <section class="set-time-out">

        {{-- Course Time --}}
        @include('frontend.oneCoursePage.partials.course-timer')
    </section>
    <!-- *********** end-set-time-out ******************** -->
    <section class="Introduction">

        <div class="col-12">
            <div class="col-10 offset-1">
                <div class="Introduction-section-page">
                    <div class="Introduction-title">
                        <div class="stick-tabs-afaq">

                            {{-- ***************************************** --}}
                            <div class="swiper mySwiper all-tabs-section">
                                <div class="swiper-wrapper">

                                    @if (
                                        (app()->getLocale() == 'en' && $oneCourse->introduction_to_course_en) ||
                                            (app()->getLocale() == 'ar' && $oneCourse->introduction_to_course_ar))
                                        <div class="swiper-slide">
                                            <span class="active item">
                                                <a href="#Introductions"
                                                    class="Introductions-btn">{{ __('global.introduction') }}</a>
                                            </span>
                                        </div>
                                    @endif


                                    @if (
                                        (app()->getLocale() == 'en' && $oneCourse->description_en) ||
                                            (app()->getLocale() == 'ar' && $oneCourse->description_ar))
                                        <div class="swiper-slide">
                                            <span class="item text-uppercase">
                                                <a href="#Descriptions"
                                                    class="Descriptions-btn">{{ __('global.description') }}</a>
                                            </span>
                                        </div>
                                    @endif


                                    @if ($oneCourse->courseAccreditation && $oneCourse->courseAccreditation->slug == 'accredited')
                                        <div class="swiper-slide">
                                            <span class="item text-uppercase">
                                                <a href="#Accreditations"
                                                    class="Accreditations-btn">{{ __('home.accreditation') }}</a>
                                            </span>
                                        </div>
                                    @endif


                                    @if ($oneCourse->prices->count())
                                        <div class="swiper-slide">
                                            <span class="item text-uppercase">
                                                <a href="#early_booking"
                                                    class="early_booking-btn">{{ __('home.early_booking') }}</a>
                                            </span>
                                        </div>
                                    @endif

                                    @if ($oneCourse->sections->count())
                                        <div class="swiper-slide">
                                            <span class="item text-uppercase">
                                                <a href="#CourseContents"
                                                    class="CourseContents-btn">{{ __('home.course_content') }}</a>
                                            </span>
                                        </div>
                                    @endif
                                    @if (count($oneCourse->course_target))
                                        <div class="swiper-slide">

                                            <span class="item text-uppercase">
                                                <a href="#TargetAudience"
                                                    class="TargetAudience-btn">{{ __('home.target_audience') }}</a>
                                            </span>
                                        </div>
                                    @endif
                                        @if ($oneCourse->has_special_policy == 1)
                                            <div class="swiper-slide">

                                            <span class="item text-uppercase">
                                                <a href="#Has_special_policy"
                                                   class="TargetAudience-btn">{{ trans('cruds.course.fields.has_special_policy') }} </a>
                                            </span>
                                            </div>
                                        @endif
                                    @if (count($oneCourse->course_instructor))
                                        <div class="swiper-slide">
                                            <span class="item text-uppercase">
                                                <a href="#AboutInstructors"
                                                    class="AboutInstructors-btn">{{ __('home.about_instructors') }}</a>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                {{-- <div class="swiper-pagination"></div> --}}
                            </div>
                            {{-- ***************************************** --}}
                        </div>

                        @if ($oneCourse->introduction_to_course_en || $oneCourse->introduction_to_course_ar)
                            <div class="the-Introduction Introductions_lms">
                                <strong> {{ __('global.introduction') }}</strong>
                                <p>
                                    {!! app()->getLocale() == 'en'
                                        ? $oneCourse->introduction_to_course_en ?? ''
                                        : $oneCourse->introduction_to_course_ar ?? '' !!}

                                </p>
                            </div>
                        @endif
                        @if ($oneCourse->description_en || $oneCourse->description_ar)
                            <div class="decription_lms Descriptions_lms">
                                <div class="decript-title Introduction-What-learn">
                                    <div class="icons">
                                        <span class="small-icon">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                        <span class="big-icon">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                    </div>
                                    <strong> {{ __('global.description') }}</strong>
                                </div>
                              <div class="on-table dec-table">
                                <p>
                                    {!! app()->getLocale() == 'en' ? $oneCourse->description_en ?? '' : $oneCourse->description_ar ?? '' !!}

                                </p>
                              </div>
                            </div>
                        @endif
                        <div class="TargetAudience_lms">
                            {{-- <div class="Introduction-What-learn">
                                <div class="icons">
                                    <span class="small-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                    <span class="big-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                </div>
                                <p>
                                    {!! app()->getLocale() == 'en' ? $oneCourse->description_en ?? '' : $oneCourse->description_ar ?? '' !!}

                                </p>
                            </div> --}}
                            @if ($oneCourse->requirements_en || $oneCourse->requirements_ar)
                                <div >
                                    <div class="Introduction-What-learn">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ __('home.Requirements') }}</strong>
                                    </div>
                                    <div class="answer-Introduction-What-learn">
                                        <ul class="answer-list ">

                                            <li>
                                                {!! app()->getLocale() == 'en' ? $oneCourse->requirements_en ?? '' : $oneCourse->requirements_ar ?? '' !!}
                                            </li>

                                        </ul>
                                        <span class="read-more active">
                                            <i class="fa-solid fa-down-long"></i>
                                            <em>Read More</em>
                                        </span>
                                        <span class="read-less ">
                                            <i class="fa-solid fa-up-long"></i>
                                            <em>Read less</em>
                                        </span>
                                    </div>
                                </div>
                            @endif


                            @if ($oneCourse->courseAccreditation && $oneCourse->courseAccreditation->slug == 'accredited')
                                <div class="Accreditation" id="Accreditations">

                                    <div class="Accreditation Accreditations_lms">

                                        <strong>{{ __('home.accreditation') }}</strong>
                                        <span class="time_">
                                            {{ __('afaq.CME_Hours') }}  {{ $oneCourse->accredit_hours }}
                                        </span>
                                        <span class="date_">
                                            {{ __('afaq.accreditation_number') }}   {{ $oneCourse->accreditation_number }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            {{-- Pricing --}}
                            @if ($oneCourse->prices->count())
                                <div class="early-booking early_booking_lms">
                                    @if ($oneCourse->early_date)
                                        <div class="early-booking-title">
                                            <img src="/afaq/imgs/message-smile-solid.png" alt="">
                                            <span>{{ __('afaq.early_booking_until') }} {{ date('j F', $early_date) }}
                                            </span>
                                        </div>
                                    @endif

                                    {{-- All Course Prices Per Specialties --}}
                                    @include('frontend.oneCoursePage.partials.prices-per-specialty')
                                    {{-- END Pricing --}}
                                </div>
                            @endif

                            {{-- Course Content --}}
                            @if ($oneCourse->sections->count())
                                <div class="the-cours-cont_Lms CourseContents_lms">
                                    <div class="the-cours-cont_ pt-4 d-flex justify-content-between">
                                        <div class="Introduction-What-learn">
                                            <div class="icons">
                                                <span class="small-icon">
                                                    <i class="fa-solid fa-circle"></i>
                                                </span>
                                                <span class="big-icon">
                                                    <i class="fa-solid fa-circle"></i>
                                                </span>
                                            </div>
                                            <strong>{{ __('afaq.Course_Content') }} </strong>
                                        </div>

                                    </div>
                                    <div class="section-cours-time-data mt-4">
                                        <div class="lms-afaq">

                                            @include('frontend.oneCoursePage.partials.course-content')
                                        </div>

                                    </div>
                                </div>
                            @endif
                            {{-- End Course Connent --}}
                            @if ($oneCourse->course_target)
                                <div class="Target-Audience-card mt-4 the-TargetAudience_lms" id="TargetAudience">
                                    <div class="Introduction-What-learn">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ __('home.target_audience') }}:</strong>
                                    </div>
                                    <div class="Target-Audience-list">

                                            <ul class="list-target">
                                                @foreach ($oneCourse->course_target as $CourseTarget)
                                                    <li>·<em>
                                                            {{ app()->getLocale() == 'en' ? $CourseTarget->name_en ?? '' : $CourseTarget->name_ar ?? '' }}
                                                        </em></li>
                                                @endforeach

                                            </ul>
                                    </div>
                                </div>
                            @endif
                            @if ($oneCourse->course_sub_specialty)
                                <div class="Target-Audience-card mt-4 the-TargetAudience_lms" id="TargetAudience">
                                    <div class="Introduction-What-learn">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ app()->getLocale() == 'en' ?  'Sub specialty' : 'التخصص الفرعي' }}:</strong>
                                    </div>
                                    <div class="Target-Audience-list">

                                            <ul class="list-target">
                                        
                                                @foreach ($oneCourse->course_sub_specialty as $course_sub_specialty)
                                                    <li>·<em>
                                                            {{ app()->getLocale() == 'en' ? $course_sub_specialty->name_en ?? '' : $course_sub_specialty->name_ar ?? '' }}
                                                        </em></li>
                                                @endforeach
                                            </ul>
                                    </div>
                                </div>
                            @endif
                            {{-- If Course has special policy --}}
                            @if ($oneCourse->has_special_policy == 1)
                            @if ($oneCourse->policy_en || $oneCourse->policy_ar)
                                <div >
                                    <div class="Introduction-What-learn"  id="Has_special_policy">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ trans('cruds.course.fields.has_special_policy') }} </strong>
                                    </div>
                                    <div class="answer-Introduction-What-learn">
                                        <ul class="answer-list ">

                                            <li>
                                                {!! app()->getLocale() == 'en' ? $oneCourse->policy_en ?? '' : $oneCourse->policy_ar ?? '' !!}
                                            </li>

                                        </ul>
                                        <span class="read-more active">
                                            <i class="fa-solid fa-down-long"></i>
                                            <em>Read More</em>
                                        </span>
                                        <span class="read-less ">
                                            <i class="fa-solid fa-up-long"></i>
                                            <em>Read less</em>
                                        </span>
                                    </div>
                                </div>
                            @endif
                            @endif
{{--                            @if ($oneCourse->has_special_policy == 1)--}}
{{--                                <div class="Target-Audience-card mt-4 the-TargetAudience_lms" id="Has_special_policy">--}}
{{--                                    <div class="Introduction-What-learn">--}}
{{--                                        <div class="icons">--}}
{{--                                            <span class="small-icon">--}}
{{--                                                <i class="fa-solid fa-circle"></i>--}}
{{--                                            </span>--}}
{{--                                            <span class="big-icon">--}}
{{--                                                <i class="fa-solid fa-circle"></i>--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                        <strong>Has Special request :</strong>--}}
{{--                                    </div>--}}
{{--                                    <div class="Target-Audience-list">--}}

{{--                                        <ul class="list-target">--}}
{{--                                            @foreach ($oneCourse->has_special_policy as $CoursePolicy )--}}
{{--                                                <li>·<em>--}}
{{--                                                        {{ app()->getLocale() == 'en' ? $CoursePolicy->policy_en ?? '' : $CoursePolicy->policy_ar ?? '' }}--}}
{{--                                                    </em></li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}




                            {{--End Has Special Ploicy --}}
                            @if (isset($oneCourse->video))
                                <div class="video-card mt-4">
                                    <div class="Introduction-What-learn">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ __('afaq.video') }}</strong>
                                    </div>
                                    {{--                        {{dd($oneCourse->video)}} --}}


                                    <div class="video-frame">

                                        <video controls="">

                                            <source src="{{ isset($oneCourse->video) ? $oneCourse->video->url : '' }}"
                                                type="video/mp4">

                                            {{ __('afaq.video_support') }}
                                        </video>

                                    </div>

                                </div>
                            @endif
                            @if (count($oneCourse->course_instructor))
                                <div class="Target-Audience-card mt-4 AboutInstructors_lms" id="AboutInstructors">
                                    <div class="Introduction-What-learn">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ __('home.about_instructors') }}</strong>
                                    </div>
                                    {{--                      InStructor For each Heere --}}

                                    @foreach ($oneCourse->course_instructor as $courseInstructor)
                                        <div
                                            class="Instructors-details d-flex align-items-center justify-content-start mt-4">
                                            <div class="Instructors-img">

                                                <img src="{{ isset($courseInstructor->image) ? $courseInstructor->image->url : '' }}"
                                                    alt="">

                                            </div>
                                            <div class="all-Instructors-data">
                                                <span class="Instructors-title">

                                                    {{ app()->getLocale() == 'en' ? $courseInstructor->name_en ?? '' : $courseInstructor->name_ar ?? '' }}
                                                </span>

                                                <p>-{{ app()->getLocale() == 'en' ? $courseInstructor->bio_en ?? '' : $courseInstructor->bio_ar ?? '' }}

                                                </p>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                            @if ($oneCourse->coursePlace && $oneCourse->coursePlace->slug == 'physical-training')
                                <div class="the-Introduction ">
                                    <strong> {{ trans('cruds.course.fields.detailed_address') }}</strong>
                                    <p>
                                        {{ $oneCourse->detailed_address ?? ''}}

                                    </p>
                                </div>
                                <div class="location-card mt-4">
                                    <div class="Introduction-What-learn">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ __('afaq.location') }}</strong>
                                    </div>
                                    <p>{{ $oneCourse->location }}</p>
                                    <div class="googale-maps">
                                        <div class="mapouter">
                                            <div class="gmap_canvas" id="map">

                                                @include('frontend.oneCoursePage.partials.course-content')
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        {{-- Course Sponsors Organized By --}}
                        @if (count($oneCourse->organizers))
                            <div class="organizer mt-4">
                                <div class="Introduction-What-learn">
                                    <div class="icons">
                                        <span class="small-icon">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                        <span class="big-icon">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                    </div>
                                    <strong>{{ __('lms.organized_by') }} </strong>
                                </div>
                                <div class=" organizer-nd-card owl-carousel owl-theme">

                                    @foreach ($oneCourse->organizers as $organizer)
                                        <div class="organizer-nd">
                                            <img src="{{ isset($organizer->image) ? $organizer->image_url : '' }}"
                                                alt="">
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif

                        @if (count($oneCourse->sponsors))
                        <div class="organizer mt-4">
                            <div class="Introduction-What-learn">
                                <div class="icons">
                                    <span class="small-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                    <span class="big-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                </div>
                                <strong>{{ __('lms.Course_Coursesponsors') }} </strong>
                            </div>
                            <div class=" organizer-nd-card owl-carousel owl-theme">

                                @foreach ($oneCourse->sponsors as $courseSponcer)
                                    <div class="organizer-nd">
                                        <img src="{{ isset($courseSponcer->image) ? $courseSponcer->image_url : '' }}"
                                            alt="">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                        {{-- Course Reviews --}}
                        @if ($oneCourse->reviews->count())
                            <div class="Target-Audience-card mt-4" id="theReviews">
                                <div class="review-text">
                                    <strong>{{ __('global.reviews') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="Instructors-img">

                                        <span class="count-reviewss">{{ $oneCourse->reviews->sum('rate') }}</span>
                                        <div class="review-star_">
                                            <span class="Instructors-rate">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </span>
                                        </div>
                                        <div class="number-reviews-count">
                                            <span>{{ $oneCourse->reviews->count() }} {{ __('global.reviews') }} </span>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                    </div>
                                    <div class="all-Instructors-data">
                                        {{-- Review For Each Here --}}
                                        @foreach ($oneCourse->reviews as $review)
                                            <div class="afaq-cours-time-end d-flex ">
                                                <div class="afaq-cours-img">
                                                    <img src="{{ $review->user->personal_photo ? $review->user->personal_photo->url : '/afaq/imgs/Groupimg.png' }}"
                                                        alt="">
                                                </div>
                                                <div class="afaq-details-time_">
                                                    <span>{{ date('F j, Y, g:i a', strtotime($review->created_at)) }}</span>
                                                    <strong>{{ app()->getLocale() == 'en' ? $review->user->full_name_en : $review->user->full_name_ar }}</strong>
                                                    <span class="Instructors-rate">
                                                        @switch($review->rate)
                                                            @case(1)
                                                                <i class="fa-solid fa-star"></i>
                                                            @break

                                                            @case(2)
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                            @break

                                                            @case(3)
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                            @break

                                                            @case(4)
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                            @break

                                                            @case(5)
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                            @break

                                                            @default
                                                        @endswitch

                                                    </span>
                                                    <p class="description">
                                                        {{ $review->review }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- End Review ForEach --}}


                                    </div>
                                </div>

                            </div>
                        @endif
                        {{-- Related Course --}}
                        @if (count($related_courses))
                            <div class="Also-Brought-toYou">
                                <strong>{{ __('lms.Brought') }}</strong>
                                <span>{{ __('lms.Watch') }}</span>
                                <p>{{ __('lms.Recorded') }}</p>
                                <div class="Also-Brought-card  owl-carousel owl-theme">
                                    {{--                            You May Also Like    For each Here --}}
                                    {{--                            {{dd($related_courses)}} --}}

                                    @foreach ($related_courses as $v1)
                                        <div class="Brought-card-details">
                                            @include('frontend.partials.course-card', [
                                                'course' => $v1,
                                            ])
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif

                    </div>

                    {{--             ***********     Card Cart Section *****************/ --}}
                    {{-- Left Side Container --}}
                    @include('frontend.oneCoursePage.partials.left-side')
                </div>
            </div>
        </div>
    </section>
    <!-- *********** end-Introduction ******************** -->
    <!-- Modal -->
    <div class="modal in" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center my-3">
                        {{ __('lms.course_added_to_cart') }}
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn col-4 mx-2"
                            style="color:white;background-color: rgb(0, 179, 54);"
                            onclick="window.location.replace('{{ url('/' . app()->getLocale() . '/carts') }}')">{{ __('lms.goto_cart') }}</button>
                        <button type="button" class="btn btn-secondry col-4 mx-2" data-bs-toggle="modal"
                            onclick="window.location.replace('{{ url('/' . app()->getLocale() . '/all-courses') }}')"
                            data-bs-target="#exampleModal"> {{ __('lms.continue_shoping') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.min.js" integrity="sha512-+z66PuMP/eeemN2MgRhPvI3G15FOBbsp5NcCJBojg6dZBEFL0Zoi0PEGkhjubEcQF7N1EpTX15LZvfuw+Ej95Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

        });
    </script>
@endsection
@include('frontend.oneCoursePage.scripts')
