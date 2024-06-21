@extends('layouts.front ')
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

        $current_specialty = $oneCourse
            ->prices()
            ->where('specialty_id', auth()->user()->specialty_id)
            ->first();
    } else {
        $login = false;
        $reserved = 0;
        $user_course = null;
        $check_exist = null;
        $check_cart = null;
        $current_specialty = null;
    }

    $total_attends = $oneCourse
        ->courses_users()
        ->whereHas('enrolls', function ($enrolls) use ($oneCourse) {
            $enrolls->where('approved', 1)->where('course_id', $oneCourse->id);
        })
        ->count();

    $can_reserve = false;

    if (auth()->check() && !$reserved && isset($end_register_date) && $today < $end_register_date && !$check_exist && $current_specialty) {
        $can_reserve = true;
    } elseif (auth()->check() && !$reserved && isset($end_register_date) && $today < $end_register_date && !$check_exist && !$oneCourse->has_general_price && !$current_specialty && count(auth()->user()->memberships) && auth()->user()->active_membership && $oneCourse->member_price) {
        $can_reserve = true;
    } elseif (auth()->check() && !$reserved && isset($end_register_date) && $today < $end_register_date && !$check_exist && !$current_specialty && !auth()->user()->active_membership && $oneCourse->has_general_price) {
        $can_reserve = true;
    } elseif (!auth()->check()) {
        $can_reserve = true;
    }
    ?>

    <div id="share_course_popup">
        <div class="share_to_social_media">
            {{ __('global.share_to_social_media') }}
            <i class="fa-solid fa-xmark" onclick="shareCourse()"></i>
            <div>
                <!-- Twitter -->
                <a style="color: #55acee;" href="https://twitter.com/intent/tweet?text=sna-academy&url={{ url()->current() }}"
                    role="button">
                    <i class="fab fa-twitter fa-lg"></i>
                </a>
                <!-- Facebook -->
                <a style="color: #3b5998;"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&quote=sna-academy"
                    role="button">
                    <i class="fab fa-facebook-f fa-lg"></i>
                </a>
                <!-- Whatsapp -->
                <a style="color: #25d366;" href="https://wa.me/?text=sna-academy%5Cn%20{{ url()->current() }}"
                    role="button">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </a>
                <!-- Linkedin -->
                <a style="color: #0e76a8;" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                    role="button">
                    <i class="fab fa-linkedin fa-lg"></i>
                </a>
                <!-- Gmail -->
                <a style="color: #bb001b;"
                    href="https://mail.google.com/mail/u/0/?view=cm&to&su=Awesome+Blog!&body=https%3A%2F%2F{{ url()->current() }}%0A&bcc&cc&fs=1&tf=1"
                    role="button">
                    <i class="fa-brands fa-google"></i>
                </a>
            </div>
        </div>

    </div>
    <div class="course_page d-flex flex-row justify-content-center">
        <div class="course_body">
            <div>
                <div class="reservation_time">
                    <p id="timerText">
                        {{ __('global.few_left_until_the_booking_date') }}
                    </p>
                    <div class="booking_timer">
                        <ul>
                            <li>
                                <div class="timer_number" id="days">0</div>
                                <p class="timer_indicator">{{ __('global.day') }}</p>
                            </li>
                            <li>
                                <div class="timer_number" id="hours">0</div>
                                <p class="timer_indicator">{{ __('global.hour') }}</p>
                            </li>
                            <li>
                                <div class="timer_number" id="minutes">0</div>
                                <p class="timer_indicator">{{ __('global.minute') }}</p>
                            </li>
                            <li>
                                <div class="timer_number" id="seconds">0</div>
                                <p class="timer_indicator">{{ __('global.second') }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex_booking_button">
                    @if ($can_reserve)
                        <button onclick="addToCart('redirect')">
                            {{ __('global.book_now') }}
                            @if ($oneCourse->today_price)
                                {{ $oneCourse->today_price . ' ' . __('lms.SR') }}
                            @elseif($oneCourse->has_general_price && $oneCourse->price > 0)
                                {{ $oneCourse->price . ' ' . __('lms.SR') }}
                            @elseif(count($oneCourse->prices) && !$oneCourse->has_general_price)
                                {{ __('lms.different_prices') }}
                            @elseif($oneCourse->has_general_price && $oneCourse->price == 0)
                                {{ __('lms.free') }}
                            @endif
                        </button>
                    @endif
                </div>
                <div class="course_info container">
                    <div class="row">
                        <div class="right_side_info col-lg-9 order-lg-1 order-2">
                            <p>
                                {{ $oneCourse->name }}
                            </p>
                            <div style="padding-top: 13px; height: 72px; content: '';"
                                class="course_condition_images d-flex">
                                @if ($oneCourse->coursePlace)
                                    <img src="{{ $oneCourse->coursePlace->image_url ?? '' }}" alt="course type">
                                @endif
                                @include('frontend.sections.cme_hours', ['course' => $oneCourse])
                            </div>
                            <nav class="content-nav">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="course_intro-tab" data-bs-toggle="tab"
                                        data-bs-target="#course_intro" type="button" role="tab"
                                        aria-controls="course_intro" aria-selected="true">
                                        <h4>{{ __('lms.description') }}</h4>
                                    </button>
                                    <button class="nav-link" id="course_content-tab" data-bs-toggle="tab"
                                        data-bs-target="#course_content" type="button" role="tab"
                                        aria-controls="course_content" aria-selected="false">
                                        <h4>{{ __('lms.content') }}</h4>
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content mt-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="course_intro" role="tabpanel"
                                    aria-labelledby="course_intro-tab">
                                    <div class="course_intro">
                                        <h3>{{ __('global.introduction') }}</h3>
                                        <p>{!! app()->getLocale() == 'en' ? $oneCourse->introduction_to_course_en : $oneCourse->introduction_to_course_ar !!}</p>
                                    </div>
                                    <div class="course_description">
                                        <h3>{{ __('global.description') }}</h3>
                                        <p>{!! app()->getLocale() == 'en' ? $oneCourse->description_en : $oneCourse->description_ar !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="course_content" role="tabpanel"
                                    aria-labelledby="course_content-tab">
                                    @if ($user_course)
                                        <div class="progress_bar">
                                            <span class="percentage_progress">
                                                {{ $user_course->completion_percentage }}%</span>
                                            <div class="first_progress_arrow"
                                                style="width: {{ 100 - $user_course->completion_percentage }}%;"></div>
                                            @for ($i = 0; $i < $count_attended_zooms + $count_quizes_answered; $i++)
                                                <div class="progress_arrow" style="width: {{ (1 / $all_count) * 100 }}%;">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                            @endfor
                                        </div>
                                    @endif
                                    @if ($grouped_zooms)
                                        <div class="row mx-0 course-content-header mb-3">
                                            <span class="col-6 text-black">{{ __('lms.content') }}</span>
                                            <span class="col-6  text-black">{{ __('global.time') }}</span>
                                        </div>
                                    @endif
                                    <div id="accordion">
                                        @if ($grouped_zooms)
                                            @foreach ($grouped_zooms as $key => $zoom_meetings)
                                                <div class="card">
                                                    <div class="card-header px-0" id="heading-{{ $key }}"
                                                        onclick="collaseTabs('collapse-{{ $key }}')">
                                                        <div class="content_header_text d-flex">
                                                            <div>
                                                                <span class="type_header_icon">
                                                                    <i class="fa-solid fa-circle-plus"></i>
                                                                </span>
                                                                <span class="type_header_icon hide_icon">
                                                                    <i class="fa-solid fa-circle-minus"></i>
                                                                </span>
                                                                <span class="m-2">
                                                                    {{ __('global.day') }} {{ $loop->index + 1 }}
                                                                </span>
                                                            </div>
                                                            <span>
                                                                {{ date('Y-m-d', strtotime($key)) }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div id="collapse-{{ $key }}"
                                                        class="{{ $collapse_config ? 'collapsed' : 'collapse' }}"
                                                        aria-labelledby="heading-{{ $key }}"
                                                        data-parent="#accordion">
                                                        <div class="card-body">
                                                            @foreach ($zoom_meetings as $zoom_meeting)
                                                                @php
                                                                    $content_class = get_class($zoom_meeting);
                                                                    $content = $content_class::find($zoom_meeting->id);
                                                                @endphp
                                                                @if ($content_class == 'App\Models\ZoomMeeting')
                                                                    <div
                                                                        class="row mx-0 border  border-right-0 border-left-0 border-top-0">
                                                                        <div class="type_title_parent col-md-6 d-flex p-0">
                                                                            <div class="type_title">
                                                                                <i class="fa fa-play-circle-o"></i>
                                                                                <bdi>{{ $content->topic }}</bdi>
                                                                                <small class="zoom-small">zoom</small>
                                                                            </div>
                                                                        </div>
                                                                        @if ($reserved &&
                                                                            strtotime($content->start_time) < strtotime($now) &&
                                                                            strtotime($now) < strtotime($content->end_time))
                                                                            <div
                                                                                class="col-12 d-flex justify-content-end text-center">
                                                                                <div class="col-8 d-flex my-auto">
                                                                                    <span class="">
                                                                                        <bdi>{{ date('H:i:s', strtotime($content->start_time)) }}</bdi>
                                                                                    </span>
                                                                                    <span class=""> - </span>
                                                                                    <span class="">
                                                                                        <bdi>
                                                                                            {{ date('H:i:s', strtotime($content->end_time)) }}</bdi>
                                                                                        KSA</span>
                                                                                </div>
                                                                                <a class="open-zoom col-4"
                                                                                    href="{{ $content->join_url }}">{{ __('open') }}</a>
                                                                            </div>
                                                                        @elseif(strtotime($content->end_time) < strtotime($now))
                                                                            <div
                                                                                class="col-12 d-flex justify-content-end text-center">
                                                                                <span>{{ __('lms.Closed') }}</span>
                                                                            </div>
                                                                        @elseif(strtotime($content->start_time) > strtotime($now))
                                                                            <div class="col-md-2 p-0"
                                                                                style="display: flex"
                                                                                id="zoom-container-{{ $content->id }}">

                                                                                <div
                                                                                    class="col-12 type_content d-flex justify-content-end text-center zoom-timer-{{ $content->id }}">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="zoom-days-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.day') }}</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="zoom-hours-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.hour') }}</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="zoom-minutes-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.minute') }}</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="zoom-seconds-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.second') }}</span>
                                                                                        </li>
                                                                                    </ul>


                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 d-flex flex-wrap">
                                                                                <div class="col-8 d-flex my-auto">
                                                                                    <span class="">
                                                                                        <bdi>{{ date('H:i:s', strtotime($content->start_time)) }}</bdi>
                                                                                    </span>
                                                                                    <span class=""> - </span>
                                                                                    <span class="">
                                                                                        <bdi>
                                                                                            {{ date('H:i:s', strtotime($content->end_time)) }}</bdi>
                                                                                        KSA</span>
                                                                                </div>
                                                                                @if ($reserved)
                                                                                    <a style="display: none;"
                                                                                        class="open-zoom open-zoom-{{ $content->id }}  col-4 waiting-button-zoom-{{ $content->id }}"
                                                                                        href="{{ $content->join_url }}">{{ __('open') }}</a>
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @elseif($content_class == 'App\Models\CourseQuize')
                                                                    <div
                                                                        class="row mx-0 border  border-right-0 border-left-0 border-top-0">
                                                                        <div class="type_title_parent col-md-6 d-flex p-0">
                                                                            <div class="type_title">
                                                                                <i class="fa-regular fa-file-lines"></i>
                                                                                <bdi>{{ $content->name }}</bdi>
                                                                                <small class="zoom-small">quize</small>
                                                                            </div>
                                                                        </div>
                                                                        @if ($reserved &&
                                                                            strtotime($content->start_at) < strtotime($now) &&
                                                                            strtotime($now) < strtotime($content->end_at) &&
                                                                            auth()->check() &&
                                                                            !$content->scores()->where('user_id', auth()->user()->id)->exists())
                                                                            <a class="open-zoom"
                                                                                href="{{ route('one-course-quize', ['locale' => app()->getLocale(), 'quize_id' => $content->id]) }}">{{ __('open') }}</a>
                                                                        @elseif(auth()->check() &&
                                                                            !$content->scores()->where('user_id', auth()->user()->id)->exists() &&
                                                                            strtotime($content->end_at) < strtotime($now))
                                                                            <div
                                                                                class="col-12 d-flex justify-content-end text-center">
                                                                                <span>{{ __('lms.Closed') }}</span>
                                                                            </div>
                                                                        @elseif(strtotime($content->start_at) > strtotime($now))
                                                                            <div class="col-md-6 p-0"
                                                                                id="quize-container-{{ $content->id }}">
                                                                                <div
                                                                                    class="type_content d-flex justify-content-end text-center quize-timer-{{ $content->id }}">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="quize-days-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.day') }}</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="quize-hours-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.hour') }}</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="quize-minutes-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.minute') }}</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="timer_number"
                                                                                                id="quize-seconds-{{ $content->id }}">
                                                                                                0
                                                                                            </div>
                                                                                            <span>{{ __('global.second') }}</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <span>{{ date('H:i:s', strtotime($content->start_at)) }}</span>
                                                                                    <span>-</span> <span>
                                                                                        {{ date('H:i:s', strtotime($content->end_at)) }}
                                                                                        KSA</span>

                                                                                </div>
                                                                            </div>
                                                                            @if ($reserved &&
                                                                                auth()->check() &&
                                                                                !$content->scores()->where('user_id', auth()->user()->id)->exists())
                                                                                <a class="open-zoom"
                                                                                    id="open-quize-{{ $content->id }}"
                                                                                    style="display: none;"
                                                                                    href="{{ route('one-course-quize', ['locale' => app()->getLocale(), 'quize_id' => $content->id]) }}">{{ __('open') }}</a>
                                                                            @endif
                                                                        @elseif($reserved &&
                                                                            auth()->check() &&
                                                                            $content->scores()->where('user_id', auth()->user()->id)->exists())
                                                                            @php
                                                                                $quizes_score = $content
                                                                                    ->scores()
                                                                                    ->where('user_id', auth()->user()->id)
                                                                                    ->first();
                                                                            @endphp
                                                                            <div class="col-6">

                                                                                <bdi> {{ $quizes_score->score_percentage }}
                                                                                    % </bdi>
                                                                                <span class="px-2">

                                                                                    {!! $quizes_score->success
                                                                                        ? '<i class="fas fa-check-circle text-success"></i>'
                                                                                        : '<i class="fas fa-times-circle text-danger"></i>' !!}
                                                                                </span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>


                            @if (!$reserved)
                                @if (!$oneCourse->has_general_price && count($oneCourse->prices) && !$check_exist)
                                    <div class="add_to_cart_section">
                                        <div class="inner_add_to_cart">
                                            <ul>
                                                @foreach ($oneCourse->prices as $price)
                                                    <li
                                                        class="d-flex flex-row {{ $current_specialty ? ($price->id == $current_specialty->id ? 'hv-card' : '') : '' }}">
                                                        <span>{{ app()->getLocale() == 'en' && $price->specialty ? $price->specialty->name_en : $price->specialty->name_ar }}</span>
                                                        <div>
                                                            <span>{{ $price->late_price . ' ' . __('lms.SR') }}</span>
                                                            @if ($today < $early_date)
                                                                <span class="on_hover_info">{{ __('lms.to') }}
                                                                    {{ date('j F', $early_date) }}
                                                                </span>
                                                                <button onclick="addToCart('redirect')"
                                                                    {{ $current_specialty ? ($price->id != $current_specialty->id ? 'disabled' : '') : 'disabled' }}>
                                                                    {{ __('global.book_now') }}
                                                                    {{ $price->early_price . ' ' . __('lms.SR') }}
                                                                </button>
                                                            @endif
                                                            @if (isset($end_register_date) && $today < $end_register_date && $today > $early_date)
                                                                <button onclick="addToCart('redirect')"
                                                                    {{ $current_specialty ? ($price->id != $current_specialty->id ? 'disabled' : '') : 'disabled' }}>
                                                                    {{ __('global.book_now') }}
                                                                    {{ $price->late_price . ' ' . __('lms.SR') }}
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach


                                            </ul>
                                        </div>
                                        @if (empty($check_cart) && $current_specialty)
                                            <button class="add_to_cart_button" onclick="addToCart('open')">
                                                {{ __('global.add_to_cart') }}
                                            </button>
                                        @endif
                                    </div>
                                    {{-- @elseif(auth()->check())
                                    <div class="offer-type offer-type-nd col-2 p-1 mt-2">
                                        <a href="{{url(app()->getLocale() . '/my_invoices')}}">
                                            <strong>{{ __('lms.goto_invoices') }}</strong>
                                        </a>

                                    </div> --}}
                                @endif
                            @endif
                            @if (count($oneCourse->collaborations))
                                <div class="association_partners">
                                    <h4>
                                        {{ __('global.scientific_association_partners') }}
                                    </h4>
                                    <div class="partner_logos_area owl-carousel owl-drag d-flex flex-row">
                                        @foreach ($oneCourse->collaborations as $collaboration)
                                            <div class="partner_logo d-flex">
                                                @if ($collaboration->image_url)
                                                    <img src="{{ $collaboration->image_url ?? '' }}"
                                                        alt="{{ $collaboration->title }}">
                                                @else
                                                    <p>{{ $collaboration->title }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($oneCourse->video)
                                <div class="course_video">
                                    <h4>
                                        {{ __('global.course_video') }}
                                    </h4>
                                    <div class="video_play">
                                        <video controls>
                                            <source src="{{ $oneCourse->video->url }}" type="video/mp4">
                                            {{-- <source src="mov_bbb.ogg" type="video/ogg"> --}}
                                            Your browser does not support HTML video.
                                        </video>
                                    </div>
                                </div>
                            @endif
                            @if (count($oneCourse->course_target_group))
                                <div class="target_groups">
                                    <h4>
                                        {{ __('global.target_groups') }}
                                    </h4>
                                    <ul class="target_list d-flex flex-row">
                                        @foreach ($oneCourse->course_target_group as $target_group)
                                            <li>
                                                <span class="material-symbols-outlined">
                                                    arrow_back
                                                </span>
                                                {{ app()->getLocale() == 'en' ? $target_group->name_en : $target_group->name_ar }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (count($related_courses))
                                <div class="related_courses">
                                    <h4>
                                        {{ __('global.related_courses') }}
                                    </h4>
                                    <div class="related d-flex flex-wrap flex-row px-0 justify-content-evenly">
                                        @foreach ($related_courses as $v1)
                                            <!-- <div class="col-md-6 col-lg-4 col-sm-12 related-item"> -->
                                                @include('frontend.partials.course-card', [
                                                    'course' => $v1,
                                                ])
                                            <!-- </div> -->
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="related_courses">
                                <h4>
                                    {{ __('global.related_courses') }}
                                </h4>
                                <div class="related_courses_body d-flex flex-row">
                                    <!-- put related courses here -->
                                    @foreach ($related_courses as $v1)
                                        @include('frontend.partials.course-card', ['course' => $v1])
                                    @endforeach
                                </div>
                            </div> --}}
                        </div>
                        <div class="left_side_info col-lg-3 order-lg-2 order-1">
                            <div class="left_side_container">
                                <div class="latestcourse-card-img">
                                    <div class="course-track"> {{ $oneCourse->courseTrack->title ?? '' }} </div>
                                    <img
                                        src="{{ isset($oneCourse->image) ? $oneCourse->image->url : asset('/nazil/imgs/new-page/Group 13513.png') }}">
                                </div>
                                <div class="first_applications_count_card d-flex flex-column">
                                    @if ($oneCourse->courseAvailability)
                                        <div class="new_or_not">
                                            {{ $oneCourse->courseAvailability->title ?? '' }}
                                        </div>
                                    @endif
                                    {{-- <div>
                                        <p class="old_price">
                                            <del>٥٩٩ ر.س</del>
                                        </p>
                                    </div> --}}
                                    @if (!$reserved && !$check_exist)
                                        @if (auth()->check() &&
                                            count(auth()->user()->memberships) &&
                                            auth()->user()->active_membership &&
                                            $oneCourse->member_price)
                                            <div class="applications_count d-flex flex-row">
                                                <div class="d-flex flex-column">

                                                    <p class="student_as_text">{{ __('lms.price') }}</p>
                                                    <div class="offer_details">
                                                        <span class="material-symbols-outlined">
                                                            calendar_today
                                                        </span>
                                                        <p>{{ __('global.timeFrom') }}
                                                            {{ date('j F', strtotime($oneCourse->start_register_date)) }}
                                                        </p>
                                                    </div>

                                                </div>
                                                <div class="d-flex flex-column">
                                                    <p class="current_price">
                                                        {{ $oneCourse->member_price . ' ' . __('lms.SR') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @elseif($oneCourse->has_general_price && $oneCourse->price > 0)
                                            <div class="applications_count d-flex flex-row">
                                                <div class="d-flex flex-column">

                                                    <p class="student_as_text">{{ __('lms.price') }}</p>
                                                    <div class="offer_details">
                                                        <span class="material-symbols-outlined">
                                                            calendar_today
                                                        </span>
                                                        <p>{{ __('global.timeFrom') }}
                                                            {{ date('j F', strtotime($oneCourse->start_register_date)) }}
                                                        </p>
                                                    </div>

                                                </div>
                                                <div class="d-flex flex-column">
                                                    <p class="current_price">
                                                        {{ $oneCourse->price . __('lms.SR') }}
                                                    </p>

                                                </div>
                                            </div>
                                        @elseif(count($oneCourse->prices) && !$oneCourse->has_general_price)
                                            @if ($current_specialty)
                                                @php
                                                    $current_specialty_today = strtotime(now());
                                                    $current_specialty_early_date = strtotime($oneCourse->early_register_date);
                                                    $current_specialty_end_register_date = strtotime($oneCourse->end_register_date);
                                                @endphp
                                                <div class="applications_count d-flex flex-row">
                                                    <div class="d-flex flex-column">
                                                        <p class="early_late_applications">
                                                            {{ __('global.early_applications') }}</p>
                                                        <p class="student_as_text">
                                                            {{ app()->getLocale() == 'en' && $current_specialty->specialty ? $current_specialty->specialty->name_en : $current_specialty->specialty->name_ar }}
                                                        </p>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <p class="current_price">
                                                            {{ $current_specialty->early_price . ' ' . __('lms.SR') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="offer_details">
                                                    <span class="material-symbols-outlined">
                                                        hourglass_bottom
                                                    </span>
                                                    <p>{{ __('global.offer_august_2') }}
                                                        {{ date('j F', $current_specialty_early_date) }}</p>
                                                </div>


                                                <div class="applications_count d-flex flex-row mt-4">
                                                    <div class="d-flex flex-column">
                                                        <p class="early_late_applications">
                                                            {{ __('global.late_applications') }}</p>
                                                        <p class="student_as_text">
                                                            {{ app()->getLocale() == 'en' && $current_specialty->specialty ? $current_specialty->specialty->name_en : $current_specialty->specialty->name_ar }}
                                                        </p>
                                                    </div>
                                                    <div class="d-flex flex-column">

                                                        {{-- <p class="old_price">
                                                                    <del>٥٩٩ ر.س</del>
                                                                </p> --}}
                                                        <p class="current_price">
                                                            {{ $current_specialty->late_price . ' ' . __('lms.SR') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="offer_details">
                                                    <span class="material-symbols-outlined">
                                                        calendar_today
                                                    </span>
                                                    <p>{{ __('lms.to') }}
                                                        {{ date('j F', $current_specialty_end_register_date) }}</p>
                                                </div>
                                            @else
                                                <div class="offer_details">
                                                    <span class="material-symbols-outlined">
                                                        calendar_today
                                                    </span>
                                                    <p>{{ __('global.timeFrom') }}
                                                        {{ date('j F', strtotime($oneCourse->start_register_date)) }}</p>
                                                </div>
                                            @endif
                                        @elseif (strtotime($oneCourse->end_register_date) > $today)
                                            <span
                                                style="
                                            color: #845097;
                                            background-color: #fff;
                                            border: solid #845097 1px;
                                            text-transform: none;
                                            display: block;
                                            border-radius: 50px;
                                            padding: 17px;
                                            text-align: center;
                                            width: 100%;
                                            margin: 20px 0;
                                            font-weight: bold;
                                            ">
                                                {{ __('lms.free') }} </span>
                                        @endif
                                    @elseif(!$reserved && $check_exist)
                                        @if (auth()->check())
                                            <div class="reservation_action w-100 p-0">
                                                <button type="button"
                                                    onclick="window.location.href = '{{ url(app()->getLocale() . '/my_invoices') }}'">
                                                    <strong>{{ __('lms.goto_invoices') }}</strong>
                                                </button>

                                            </div>
                                        @endif
                                    @else
                                        <div class="reservation_action w-100 p-0">
                                            <button onclick="$('#course_content-tab').click()">
                                                {{ __('global.go_course_detials') }} </button>
                                        </div>
                                    @endif


                                </div>
                                {{-- <div class="second_applications_count_card d-flex flex-column">
                                    <div class="applications_count d-flex flex-row">
                                        <div class="d-flex flex-column">
                                            <p class="early_late_applications">{{ __('global.early_applications') }}</p>
                                            <p class="student_as_text">{{ __('global.student') }}</p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <p class="old_price">
                                                <del>٥٩٩ ر.س</del>
                                            </p>
                                            <p class="current_price">
                                                ٢٩٩ ر.س
                                            </p>
                                        </div>
                                    </div>
                                    <div class="offer_details">
                                        <span class="material-symbols-outlined">
                                            calendar_today
                                        </span>
                                        <p>{{ __('global.offer_august_2') }}</p>
                                    </div>
                                </div> --}}
                                <div class="reservation_action">
                                    {{-- <div class="offer_details">
                                        <span class="material-symbols-outlined">
                                            payments
                                        </span>
                                        <p>{{ __('global.30_days_guarantee') }}</p>
                                    </div> --}}
                                    @if (!$oneCourse->has_general_price && count($oneCourse->prices) && !auth()->check())
                                        <div class="reservation_action w-100 p-0">
                                            <button>
                                                {{ __('lms.depends_on') }} </button>
                                        </div>
                                    @endif

                                    @if ($can_reserve)
                                        <button onclick="addToCart('redirect')">{{ __('global.book') }}</button>
                                        @if (empty($check_cart))
                                            <button onclick="addToCart('open')">{{ __('global.add_to_cart') }}</button>
                                        @endif
                                    @endif
                                    <div class="offer_details">
                                        <span class="material-symbols-outlined">
                                            calendar_today
                                        </span>
                                        <p>{{ date('j F', strtotime($oneCourse->start_date)) }} {{ __('lms.to') }}
                                            {{ date('j F', strtotime($oneCourse->end_date)) }}
                                    </div>
                                    {{-- <div class="offer_details">
                                        <span class="material-symbols-outlined">
                                            schedule
                                        </span>
                                        <p>من ٩:٣٠ صباحًا حتى ١٢:٣٠ ظهرًا</p>
                                    </div> --}}
                                    <ul class="course_features">
                                        <li class="d-flex flex-row">
                                            <span class="material-symbols-outlined">
                                                auto_awesome
                                            </span>
                                            <p>
                                                {{ __('global.course_features') }}
                                            </p>
                                        </li>
                                        @if ($total_attends)
                                            <li class="d-flex flex-row">
                                                <span class="material-symbols-outlined">
                                                    group
                                                </span>
                                                <p>
                                                    {{ __('global.number_of_participants') }}
                                                </p>
                                                <p class="left_numbers">{{ $total_attends }}</p>
                                            </li>
                                        @endif
                                        @if ($oneCourse->accredit_hours)
                                            <li class="d-flex flex-row">
                                                <span class="material-symbols-outlined">
                                                    schedule
                                                </span>
                                                <p>
                                                    {{ __('global.certified_training_hours') }}
                                                </p>
                                                <p class="left_numbers">{{ $oneCourse->accredit_hours }}</p>
                                            </li>
                                        @endif
                                        @if ($oneCourse->courseAccreditation)
                                            <li class="d-flex flex-row">
                                                <span class="material-symbols-outlined">
                                                    task
                                                </span>
                                                <p>
                                                    {{ $oneCourse->courseAccreditation->title ?? '' }}
                                                </p>
                                            </li>
                                        @endif
                                        @if ($oneCourse->coursePlace)
                                            <li class="d-flex flex-row">
                                                <span class="material-symbols-outlined">
                                                    language
                                                </span>
                                                <p>
                                                    {{ $oneCourse->coursePlace->title ?? '' }}
                                                </p>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="share_course d-flex flex-raw" onclick="shareCourse()">
                                        <img src="{{ asset('/nazil/imgs/share_course.svg') }}" alt="share course">
                                        <span>{{ __('global.share_course') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if (count($oneCourse->course_instructor))
                                <div class="instructors d-flex flex-column">
                                    <h6>{{ __('global.instructors') }}</h6>
                                    @foreach ($oneCourse->course_instructor as $instructor)
                                        <div class="d-flex flex-row">
                                            @if ($instructor->image)
                                                <img src="{{ $instructor->image ? $instructor->image->url : '' }}"
                                                    alt="instructor image">
                                            @endif
                                            <div class="instructor_info d-flex flex-column">
                                                <div class="d-flex flex-row">
                                                    <span class="instructor_name">
                                                        {{ $instructor->name }}
                                                    </span>

                                                </div>
                                                <p>
                                                    {{ $instructor->bio }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if (count($oneCourse->sponsors))
                                <div class="organized_by">
                                    <h4>
                                        {{ __('global.organized_by') }}
                                    </h4>
                                    <div class="organizors d-flex">
                                        @foreach ($oneCourse->sponsors as $sponsor)
                                            <div class="organizer_logo">
                                                <img src="{{ $sponsor->image_url ?? '' }}"
                                                    alt="{{ $sponsor->title }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> --}}
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
                {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        // *******************************************************************************
        // $(document).ready(function() {
        //     $('#zoom_meeting_link').hide();
        //     // *********************** coumter up ***************
        //     // Set the date we're counting down to
        //     var countDownDate = new Date("{{ $date }}").getTime();

        //     // Update the count down every 1 second
        //     var x = setInterval(function() {

        //         // Get today's date and time
        //         var now = new Date().getTime();

        //         // Find the distance between now and the count down date
        //         var distance = countDownDate - now;

        //         // Time calculations for days, hours, minutes and seconds
        //         var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        //         var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //         var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        //         var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        //         let time = '';

        //         if (days > 0) {
        //             time += days + "D ";
        //         }
        //         if (hours > 0) {
        //             time += hours + "H ";
        //         }
        //         if (minutes > 0) {
        //             time += minutes + "M ";
        //         }
        //         if (seconds > 0) {
        //             time += seconds + "S";
        //         }
        //         // Output the result in an element with id="demo"
        //         document.getElementById("demo").innerHTML = time;

        //         // If the count down is over, write some text
        //         if (distance < 0) {
        //             clearInterval(x);
        //             $('#zoom_meeting_count').hide();
        //             $('#zoom_meeting_text').hide();
        //             $('#zoom_meeting_link').show();
        //             // clearInterval(x);
        //             // document.getElementById("demo").innerHTML = "EXPIRED";
        //         } else {
        //             $('#zoom_meeting_count').show();
        //             $('#zoom_meeting_text').show();
        //         }
        //     }, 1000);
        // });
        // **************************************** new slider banner ************************************************
    </script>

    <script>
        function addToCart(actionType) {
            var cartUrl = null;
            @if ($login)
                var cartUrl = "{{ url('/' . app()->getLocale() . '/carts/' . $oneCourse->id) }}"
            @else
                window.location.href = "{{ url(app()->getLocale() . '/login') }}";
            @endif

            window.location.href = cartUrl;
        }
    </script>

    <script>
        function makeTimer(endDate) {
            //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
            var endTime = new Date(endDate);
            endTime = (Date.parse(endTime) / 1000);
            var date = new Date();
            var now = date.toLocaleString('en-US', {
                timeZone: 'Asia/Riyadh',
            });

            now = (Date.parse(now) / 1000);

            var timeLeft = endTime - now;

            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

            if (hours < "10") {
                hours = "0" + hours;
            }
            if (minutes < "10") {
                minutes = "0" + minutes;
            }
            if (seconds < "10") {
                seconds = "0" + seconds;
            }

            $("#days").html(days);
            $("#hours").html(hours);
            $("#minutes").html(minutes);
            $("#seconds").html(seconds);

        }

        @php
            $timer_today = strtotime(now());
            $timer_early_date = strtotime($oneCourse->early_register_date);
            $timer_end_register_date = strtotime($oneCourse->end_register_date);
            $timer_course_start = strtotime($oneCourse->start_register_date);
        @endphp

        @if ($timer_today < $timer_course_start)
            $('#timerText').text("{{ __('global.few_left_until_the_booking_date') }}");
            setInterval(function() {
                makeTimer("{{ date('Y-m-d', strtotime($oneCourse->start_register_date)) }}");
            }, 1000);
        @elseif ($timer_today < $timer_early_date)
            $('#timerText').text("{{ __('global.few_left_until_the_early_booking_date') }}");
            setInterval(function() {
                makeTimer("{{ date('Y-m-d', strtotime($oneCourse->early_register_date)) }}");
            }, 1000);
        @elseif (isset($timer_end_register_date) &&
            $timer_today < $timer_end_register_date &&
            $timer_today > $timer_early_date)
            $('#timerText').text("{{ __('global.little_to_no_registration_deadline') }}");
            setInterval(function() {
                makeTimer("{{ date('Y-m-d', strtotime($oneCourse->end_register_date)) }}");
            }, 1000);
        @else
            $('.reservation_time').hide();
        @endif
    </script>

    <script>
        @if ($oneCourse->banner)
            $('.right-statc-side-nd').css('background-image', "url('{{ $oneCourse->banner->url }}')")
        @endif
    </script>

    <script>
        function collaseTabs(current_id) {
            // if ($('.collapsed').length) {
            //     $('.collapsed').each(function(key, value) {
            //         console.log(key, value);
            //         value.classList.remove('collapsed');
            //         value.classList.add('collapse');
            //     });
            // }

            // if ($(`#${id}`).hasClass('collapse')) {
            //     $(`#${id}`).removeClass('collapse');
            //     $(`#${id}`).addClass('collapsed');
            // } else {
            //     $(`#${id}`).removeClass('collapsed');
            //     $(`#${id}`).addClass('collapse');
            // }

            // var current_id = $(`#${id}`).id
            var element = document.getElementById(current_id).previousElementSibling.firstElementChild.firstElementChild;


            $(`#${current_id}`).toggleClass('collapsed').toggleClass('collapse')
            element.firstElementChild.classList.toggle('hide_icon')
            element.childNodes[3].classList.toggle('hide_icon');
            // console.log(element.childNodes[3]);
        }
    </script>


    <script>
        function zoomTimer(endDate, id, join_url, container_id) {
            //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
            var date = new Date();
            var now = date.toLocaleString('en-US', {
                timeZone: 'Asia/Riyadh',
            });
            var endTime = new Date(endDate);
            endTime = (Date.parse(endTime) / 1000);
            now = (Date.parse(now) / 1000);
            var dateOver = (now + (15 * 60));
            var reserved = "{{ $reserved }}";

            var timeLeft = endTime - now;

            if (endTime <= dateOver) {
                if (reserved == '1') {
                    $(`.open-${container_id}-${id}`).show();
                }
            }

            if (timeLeft > 0) {
                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                if (hours < "10") {
                    hours = "0" + hours;
                }
                if (minutes < "10") {
                    minutes = "0" + minutes;
                }
                if (seconds < "10") {
                    seconds = "0" + seconds;
                }

                $(`#${container_id}-days-${id}`).html(days);
                $(`#${container_id}-hours-${id}`).html(hours);
                $(`#${container_id}-minutes-${id}`).html(minutes);
                $(`#${container_id}-seconds-${id}`).html(seconds);
            } else {
                $(`#${container_id}-container-${id}`).hide();
                if (reserved == '1') {
                    // $(`#open-${container_id}-${id}`).show();
                    // $(`.waiting-button-${container_id}-${id}`).hide();
                }
            }

        }

        @if ($grouped_zooms)
            @foreach ($grouped_zooms as $key => $group_zooms)
                @foreach ($group_zooms as $zoo)
                    @if (strtotime($zoo->start_time) > strtotime($now))
                        setInterval(function() {
                            zoomTimer("{{ date('Y-m-d H:i:s', strtotime($zoo->start_time)) }}",
                                "{{ $zoo->id }}", "{{ $zoo->join_url }}",
                                "{{ $zoo->class == 'App\Models\ZoomMeeting' ? 'zoom' : 'quize' }}")
                        }, 1000);
                    @endif
                @endforeach
            @endforeach
        @endif
    </script>
@endsection
