@extends('layouts.front ')
@section('title')
    <title>{{app()->getLocale()=='en' ? $oneCourse->name_en ?? '' : $oneCourse->name_ar ?? ''}}</title>
@endsection
@section('content')

    <link rel="stylesheet" href="/frontend/css/course_page.css">

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
        $reserved = \App\Models\Enroll::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id, 'approved' => 1])->count();
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
        $sub_spe=  $oneCourse->course_sub_specialty()->where('sub_specialty_id', auth()->user()->sub_specialty_id)->exists();

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

    <link rel="stylesheet" href="{{asset('afaq/assets/css/share_popup.css')}}" />
    <style>
        .content-icon {
            width: 20px;
        }
    </style>
    {{-- Share Course --}}
    @include('frontend.oneCoursePage.partials.share-course')

    <div class="course_page d-flex flex-row justify-content-center">
        <div class="course_body">
            <div>

                {{-- Course Time --}}
                @include('frontend.oneCoursePage.partials.course-timer')

                {{-- Booking button --}}
                @include('frontend.oneCoursePage.partials.booking-button')

                {{-- Course Content --}}
                <div class="course_info container">
                    <div class="row">
                        @include('frontend.oneCoursePage.partials.course-content')
                    </div>
                </div>

                {{-- All Course Prices Per Specialties --}}
                @include('frontend.oneCoursePage.partials.prices-per-specialty')

                {{-- Collaborations --}}
                @include('frontend.oneCoursePage.partials.collaborations')

                {{-- Intro Course Video --}}
                @include('frontend.oneCoursePage.partials.video')

                {{-- Target Specialties --}}
                @include('frontend.oneCoursePage.partials.target-groups')

                {{-- Related Course --}}
                @include('frontend.oneCoursePage.partials.related-courses')
            </div>

            {{-- Left Side Container --}}
            @include('frontend.oneCoursePage.partials.left-side')
        </div>
    </div>

    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center my-3">
                        {{ __('lms.course_added_to_cart') }}
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn col-4 mx-2"
                                style="color:white;background-color: rgb(105,68,159);"
                                onclick="window.location.replace('{{ url('/' . app()->getLocale() . '/carts') }}')">{{ __('lms.goto_cart') }}</button>
                        <button type="button" class="btn btn-secondry col-4 mx-2" data-bs-toggle="modal"
                                onclick="window.location.replace('{{ url('/' . app()->getLocale() . '/all-courses') }}')"
                                data-bs-target="#exampleModal"> {{ __('lms.continue_shoping') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@include('frontend.oneCoursePage.scripts')
