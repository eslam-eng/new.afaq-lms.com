@extends('layouts.mobile-view')

@section('content')
    <link rel="stylesheet" href="{{ asset('afaq/assests/css/new-content-style.css') }}">

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
    $all_count = $oneCourse
        ->lectures()
        ->whereIn('type', ['video', 'zoom', 'quize'])
        ->count();
    $all_videos = $oneCourse
        ->lectures()
        ->whereIn('type', ['video'])
        ->with('courseNotes')
        ->get();
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
    $video_scores = 0;
    if (count($oneCourse->courseVideoScore)) {
        if (auth()->check()) {
            $video_scores = $oneCourse
                ->courseVideoScore()
                ->where('user_id', auth()->user()->id)
                ->count();
        }
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
    @include('frontend.course-content.style')



    <div class="container-fluid" style="max-width: 93%;">
        <div class="row mt-5 pt-5 pb-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <div class="small_screen_course_content_header">
                <h4 class="course_title">
                    {{ app()->getLocale() == 'en' ? $oneCourse->name_en : $oneCourse->name_ar }}
                </h4>
                <div class="progress_line_parent">
                    @if ($user_course)
                        <div class="lecture_progress_bar">

                            <div class="progress_bar_top_info">
                                <span class="bold">{{ __('global.completion_percentage') }}</span>
                                <span
                                    class="bold bold progress_bar_percentage pr-2 pl-2">{{ $user_course->completion_percentage }}%</span>

                                <div class="questionaire_button">
                                    @if (isset($user_course) &&
                                            $oneCourse->success_percentage <= $user_course->completion_percentage &&
                                            $oneCourse->questionaire)
                                        @if (auth()->check() &&
                                                \App\Models\Review::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first())
                                            <button type="button">
                                                {{ __('lms.questionnaire_taken') }}
                                            @else
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    {{ __('lms.course_questionaire') }}
                                                </button>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="progress_white_line">
                                <span class="blue-line" style="width: {{ $user_course->completion_percentage }}%;"></span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div
                class=" {{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }} course_content_right_sections_on_small_screen owl-carousel list-group">
                @foreach ($oneCourse->sections as $keySection => $section)
                    @foreach ($section->lectures as $keyLecture => $lecture)
                        @php
                            $quize_repeate_access =
                                $lecture->type == 'quize' &&
                                ($lecture->quize
                                    ->scores()
                                    ->where('user_id', auth()->user()->id)
                                    ->first()
                                    ? ($lecture->quize
                                        ->scores()
                                        ->where('user_id', auth()->user()->id)
                                        ->first()->repeat_times < $lecture->quize->repeat_times
                                        ? true
                                        : false)
                                    : true)
                                    ? true
                                    : false;
                            $depend_access = true;
                            if ($lecture->depends_on_id) {
                                switch ($lecture->dependsOn->type) {
                                    case 'quize':
                                        $depend_access = $lecture->dependsOn->quize
                                            ->scores()
                                            ->where('user_id', auth()->user()->id)
                                            ->first()
                                            ? true
                                            : false;
                                        break;
                                    case 'zoom':
                                        $depend_access = $lecture->dependsOn->zoom
                                            ->reports()
                                            ->where('user_id', auth()->user()->id)
                                            ->first()
                                            ? true
                                            : false;
                                        break;
                                    case 'video':
                                        $depend_access = $lecture->dependsOn
                                            ->videoScore()
                                            ->where('user_id', auth()->user()->id)
                                            ->first()
                                            ? true
                                            : false;
                                        break;
                                    default:
                                        $depend_access = true;
                                        # code...
                                        break;
                                }
                            }
                        @endphp
                        <a @if ($lecture->type == 'video') onclick="setVideoNotes('{{ $lecture->id }}')"
                            @else  onclick="removeNotes('{{ $lecture->id }}')" @endif
                            class="list-group-item list-group-item-action
                                {{ $lecture->id == $lecture_id ? 'active' : '' }}
                                @if (!$reserved && $lecture->accessing == 'private') disabled @endif
                                @if ($lecture->type == 'quize' && !$quize_repeate_access) disabled @endif
                                @if (!$depend_access) disabled @endif"
                            id="list-{{ $lecture->id }}-list" data-bs-toggle="list" href="#list-{{ $lecture->id }}"
                            role="tab" aria-controls="list-{{ $lecture->id }}">
                            <!-- <span class="lecture_title_side_menu">
                                        {{ $loop->index + 1 }}- {{ $lecture->title }}
                                    </span> -->
                            @switch($lecture->type)
                                @case('video')
                                    @if (
                                        $lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                            $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage > 50)
                                        @php $class = 'completed' @endphp
                                    @elseif (
                                        $lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                            $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage < 50)
                                        @php $class = 'not-completed' @endphp
                                    @else
                                        @php $class = '' @endphp
                                    @endif
                                @break

                                @case('zoom')
                                    @php
                                        $zoom_report = $lecture->zoom ? $lecture->zoom->reports()->where('user_id', auth()->user()->id)->first() : null;
                                    @endphp
                                    @if (
                                        $zoom_report &&
                                            $zoom_report->join_percentage > 50)
                                        @php $class = 'completed' @endphp
                                    @elseif (
                                        $zoom_report &&
                                            $zoom_report->join_percentage < 50)
                                        @php $class = 'not-completed' @endphp
                                    @else
                                        @php $class = '' @endphp
                                    @endif
                                @break

                                @case('quize')
                                    @if (
                                        $lecture->quize->scores()->where('user_id', auth()->user()->id)->first() &&
                                            $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage > $lecture->quize->success_percentage)
                                        @php $class = 'completed' @endphp
                                    @elseif (
                                        $lecture->quize->scores()->where('user_id', auth()->user()->id)->first() &&
                                            $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage < $lecture->quize->success_percentage)
                                        @php $class = 'not-completed' @endphp
                                    @else
                                        @php $class = '' @endphp
                                    @endif
                                @break

                                @default
                                    @php
                                        $class = '';
                                    @endphp
                            @endswitch
                            <div class="lecture_list_item_condition {{ $class }}">

                                @switch($lecture->type)
                                    @case('video')
                                        <div class="video_thumbnail_container">
                                            <div class="video_thumbnail justify-content-center"
                                                style="background-image: url('{{ asset('/nazil/imgs/video_icon_afaq.svg') }}')">
                                                @if ($lecture->videoScore()->where('user_id', auth()->user()->id)->first())
                                                    <span class="complete-percentage-hover-top">{{ __('global.finished') }}
                                                        <br>
                                                        {{ $lecture->videoScore()->where('user_id', auth()->user()->id)->first()->score_percentage }}
                                                        %</span>
                                                @endif
                                            </div>
                                            <p>{{ $lecture->title }}</p>
                                        </div>
                                    @break

                                    @case('photo')
                                        <!-- <img src="{{ asset('frontend/icons/file.svg') }}" class="content-icon"> -->
                                        <div class="video_thumbnail_container">
                                            <div class="video_thumbnail"
                                                style="background-image: url({{ asset('/nazil/imgs/image_icon_afaq.svg') }})">
                                            </div>
                                            <p>{{ $lecture->title }}</p>
                                        </div>
                                    @break

                                    @case('zoom')
                                        @php
                                            $zoom_report = $lecture->zoom ? $lecture->zoom->reports()->where('user_id', auth()->user()->id)->first() : null;
                                        @endphp
                                        <div class="video_thumbnail_container">
                                            <div class="video_thumbnail justify-content-center"
                                                style="background-image: url('{{ asset('/nazil/imgs/zoom-icon.svg') }}')">
                                                @if ($zoom_report)
                                                    <span class="complete-percentage-hover-top">{{ __('global.finished') }}
                                                        <br>
                                                        {{ $zoom_report->join_percentage }}
                                                        %</span>
                                                @endif
                                            </div>

                                            <p>{{ $lecture->title }}</p>
                                        </div>
                                    @break

                                    @case('quize')
                                        <div class="video_thumbnail_container">
                                            <div class="video_thumbnail justify-content-center"
                                                style="background-image: url('{{ asset('/nazil/imgs/file-circle-question.svg') }}')">
                                                @if ($lecture->quize->scores()->where('user_id', auth()->user()->id)->first())
                                                    <span class="complete-percentage-hover-top">{{ __('global.finished') }}
                                                        <br>
                                                        {{ $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage }}
                                                        %</span>
                                                @endif
                                            </div>

                                            <p>{{ $lecture->title }}</p>
                                        </div>
                                    @break

                                    @case('file')
                                        <div class="video_thumbnail_container ">
                                            <div class="video_thumbnail"
                                                style="background-image: url({{ asset('/nazil/imgs/file-regular.svg') }})"></div>
                                            <p>{{ $lecture->title }}</p>
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            </div>
                        </a>
                    @endforeach
                @endforeach
            </div>
            <div style="display: none" id="left-notes" class="order-xl-1 order-2">
                <div class="course_content_left_sections">
                    <div class="left_tiny_header">
                        <h4>{{ __('global.notes') }}</h4>
                        <span>{{ __('global.view_all_notes') }}</span>
                    </div>
                    {{-- @foreach ($all_videos as $video)
                        @foreach ($video->courseNotes as $note) --}}
                    <div class="render-notes">

                    </div>

                    {{-- @endforeach
                    @endforeach --}}
                </div>
            </div>
            <div class="col-12 order-xl-2 order-1" id="right-notes">
                <h4 class="course_title on_large_screen mt-5">
                    {{ app()->getLocale() == 'en' ? $oneCourse->name_en : $oneCourse->name_ar }}
                </h4>
                <div class="progress_line_parent on_large_screen">
                    <div class="questionaire_button">
                        @if (isset($user_course) &&
                                $oneCourse->success_percentage <= $user_course->completion_percentage &&
                                $oneCourse->questionaire)
                            @if (auth()->check() &&
                                    \App\Models\Review::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first())
                                <button type="button">
                                    {{ __('lms.questionnaire_taken') }}
                                </button>
                            @else
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    {{ __('lms.course_questionaire') }}
                                </button>
                            @endif
                        @endif
                    </div>
                    @if ($user_course)
                        <div class="lecture_progress_bar">
                            <span class="bold">{{ __('global.completion_percentage') }}</span>
                            <span
                                class="bold bold progress_bar_percentage">{{ $user_course->completion_percentage }}%</span>

                            <div class="progress_white_line">
                                <span class="blue-line"
                                    style="width: {{ $user_course->completion_percentage ?? 0 }}%;"></span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="course_content_right_sections">
                    <div class="course_content_study_section">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            @foreach ($oneCourse->sections as $keySection => $section)
                                <div class="accordion-item">
                                    <h2 class="accordion-header {{ $loop->index == 0 ? 'show' : 'in' }}"
                                        id="coll-h-{{ $section->id }}">
                                        <button class="accordion-button {{ $loop->index == 0 ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#coll-{{ $section->id }}"
                                            aria-expanded="{{ $loop->index == 0 ? 'true' : 'false' }}"
                                            aria-controls="coll-{{ $section->id }}" dir="ltr">
                                            {{ $section->title }}
                                        </button>
                                    </h2>
                                    <div id="coll-{{ $section->id }}"
                                        class="accordion-collapse collapse in {{ $section_id == $section->id ? 'show' : '' }} "
                                        aria-labelledby="coll-h-{{ $section->id }}">
                                        <div class="accordion-body">
                                            <div class="list-group" id="list-tab-{{ $section->id }}" role="tablist">
                                                @foreach ($section->lectures as $keyLecture => $lecture)
                                                    @php
                                                        $quize_repeate_access =
                                                            $lecture->type == 'quize' &&
                                                            ($lecture->quize
                                                                ->scores()
                                                                ->where('user_id', auth()->user()->id)
                                                                ->first()
                                                                ? ($lecture->quize
                                                                    ->scores()
                                                                    ->where('user_id', auth()->user()->id)
                                                                    ->first()->repeat_times < $lecture->quize->repeat_times
                                                                    ? true
                                                                    : false)
                                                                : true)
                                                                ? true
                                                                : false;
                                                        $depend_access = true;
                                                        if ($lecture->depends_on_id) {
                                                            switch ($lecture->dependsOn->type) {
                                                                case 'quize':
                                                                    $depend_access = $lecture->dependsOn->quize
                                                                        ->scores()
                                                                        ->where('user_id', auth()->user()->id)
                                                                        ->first()
                                                                        ? true
                                                                        : false;
                                                                    break;
                                                                case 'zoom':
                                                                    $depend_access = $lecture->dependsOn->zoom
                                                                        ->reports()
                                                                        ->where('user_id', auth()->user()->id)
                                                                        ->first()
                                                                        ? true
                                                                        : false;
                                                                    break;
                                                                case 'video':
                                                                    $depend_access = $lecture->dependsOn
                                                                        ->videoScore()
                                                                        ->where('user_id', auth()->user()->id)
                                                                        ->first()
                                                                        ? true
                                                                        : false;
                                                                    break;
                                                                default:
                                                                    $depend_access = true;
                                                                    # code...
                                                                    break;
                                                            }
                                                        }
                                                    @endphp
                                                    <a @if ($lecture->type == 'video') onclick="setVideoNotes('{{ $lecture->id }}')"
                                                        @else  onclick="removeNotes('{{ $lecture->id }}')" @endif
                                                        class="list-group-item list-group-item-action
                                                         {{ $lecture->id == $lecture_id ? 'active' : '' }}
                                                         @if (!$reserved && $lecture->accessing == 'private') disabled @endif
                                                         @if ($lecture->type == 'quize' && !$quize_repeate_access) disabled @endif
                                                          @if (!$depend_access) disabled @endif"
                                                        id="list-{{ $lecture->id }}-list" data-bs-toggle="list"
                                                        href="#list-{{ $lecture->id }}" role="tab"
                                                        aria-controls="list-{{ $lecture->id }}">
                                                        <!-- <span class="lecture_title_side_menu">
                                                                    {{ $loop->index + 1 }}- {{ $lecture->title }}
                                                                </span> -->
                                                        @switch($lecture->type)
                                                            @case('video')
                                                                @if (
                                                                    $lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                                                        $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage > 50)
                                                                    @php $class = 'completed' @endphp
                                                                @elseif (
                                                                    $lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                                                        $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage < 50)
                                                                    @php $class = 'not-completed' @endphp
                                                                @else
                                                                    @php $class = '' @endphp
                                                                @endif
                                                            @break

                                                            @case('zoom')
                                                                @php
                                                                    $zoom_report = $lecture->zoom ? $lecture->zoom->reports()->where('user_id', auth()->user()->id)->first() : null;
                                                                @endphp
                                                                @if (
                                                                    $zoom_report &&
                                                                        $zoom_report->join_percentage > 50)
                                                                    @php $class = 'completed' @endphp
                                                                @elseif (
                                                                    $zoom_report &&
                                                                        $zoom_report->join_percentage < 50)
                                                                    @php $class = 'not-completed' @endphp
                                                                @else
                                                                    @php $class = '' @endphp
                                                                @endif
                                                            @break

                                                            @case('quize')
                                                                @if (
                                                                    $lecture->quize->scores()->where('user_id', auth()->user()->id)->first() &&
                                                                        $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage > $lecture->quize->success_percentage)
                                                                    @php $class = 'completed' @endphp
                                                                @elseif (
                                                                    $lecture->quize->scores()->where('user_id', auth()->user()->id)->first() &&
                                                                        $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage < $lecture->quize->success_percentage)
                                                                    @php $class = 'not-completed' @endphp
                                                                @else
                                                                    @php $class = '' @endphp
                                                                @endif
                                                            @break

                                                            @default
                                                                @php
                                                                    $class = '';
                                                                @endphp
                                                        @endswitch

                                                        <div class="lecture_list_item_condition {{ $class }}">

                                                            @switch($lecture->type)
                                                                @case('video')
                                                                    <div class="video_thumbnail_container">
                                                                        <div class="video_thumbnail justify-content-center"
                                                                            style="background-image: url('{{ asset('/nazil/imgs/video_icon_afaq.svg') }}')">
                                                                            @if ($lecture->videoScore()->where('user_id', auth()->user()->id)->first())
                                                                                <span
                                                                                    class="complete-percentage-hover">{{ __('global.finished') }}
                                                                                    <br>
                                                                                    {{ $lecture->videoScore()->where('user_id', auth()->user()->id)->first()->score_percentage }}
                                                                                    %</span>
                                                                            @endif
                                                                        </div>
                                                                        <p>{{ $lecture->title }}</p>
                                                                    </div>
                                                                @break

                                                                @case('photo')
                                                                    <!-- <img src="{{ asset('frontend/icons/file.svg') }}" class="content-icon"> -->
                                                                    <div class="video_thumbnail_container">
                                                                        <div class="video_thumbnail"
                                                                            style="background-image: url({{ asset('/nazil/imgs/image_icon_afaq.svg') }})">
                                                                        </div>
                                                                        <p>{{ $lecture->title }}</p>
                                                                    </div>
                                                                @break

                                                                @case('zoom')
                                                                    @php
                                                                        $zoom_report = $lecture->zoom ? $lecture->zoom->reports()->where('user_id', auth()->user()->id)->first() : null;
                                                                    @endphp
                                                                    <div class="video_thumbnail_container">
                                                                        <div class="video_thumbnail justify-content-center"
                                                                            style="background-image: url('{{ asset('/nazil/imgs/zoom-icon.svg') }}')">
                                                                            @if ($zoom_report)
                                                                                <span
                                                                                    class="complete-percentage-hover">{{ __('global.finished') }}
                                                                                    <br>
                                                                                    {{ $zoom_report->join_percentage }}
                                                                                    %</span>
                                                                            @endif
                                                                        </div>

                                                                        <p>{{ $lecture->title }}</p>
                                                                    </div>
                                                                @break

                                                                @case('quize')
                                                                    <div class="video_thumbnail_container">
                                                                        <div class="video_thumbnail justify-content-center"
                                                                            style="background-image: url('{{ asset('/nazil/imgs/file-circle-question.svg') }}')">
                                                                            @if ($lecture->quize->scores()->where('user_id', auth()->user()->id)->first())
                                                                                <span
                                                                                    class="complete-percentage-hover">{{ __('global.finished') }}
                                                                                    <br>
                                                                                    {{ $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage }}
                                                                                    %</span>
                                                                            @endif
                                                                        </div>

                                                                        <p>{{ $lecture->title }}</p>
                                                                    </div>
                                                                @break

                                                                @case('file')
                                                                    <div class="video_thumbnail_container ">
                                                                        <div class="video_thumbnail"
                                                                            style="background-image: url({{ asset('/nazil/imgs/file-regular.svg') }})">
                                                                        </div>
                                                                        <p>{{ $lecture->title }}</p>
                                                                    </div>
                                                                @break

                                                                @default
                                                            @endswitch
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="course_content_lecture_items_section">
                        <div class="tab-content" id="nav-tabContent">
                            @foreach ($oneCourse->sections as $key => $sect)
                                @foreach ($sect->lectures as $keyLec => $lect)
                                    <div class="tab-pane  {{ $lect->id == $lecture_id ? 'active show' : '' }} "
                                        id="list-{{ $lect->id }}" role="tabpanel"
                                        aria-labelledby="list-{{ $lect->id }}-list">
                                        @if ($lect->type == 'quize')
                                            <h4 class="lecture_main_title">
                                                {{ $lect->title }}
                                            </h4>
                                        @endif
                                        @switch($lect->type)
                                            @case('video')
                                                @include('frontend.course-content.video-viewer', [
                                                    'lecture' => $lect,
                                                ])
                                            @break

                                            @case('photo')
                                                @include('frontend.course-content.photo-viewer', [
                                                    'lecture' => $lect,
                                                ])
                                            @break

                                            @case('file')
                                                @include('frontend.course-content.file-view', [
                                                    'lecture' => $lect,
                                                ])
                                            @break

                                            @case('zoom')
                                                @include('frontend.course-content.zoom-viewer', [
                                                    'lecture' => $lect,
                                                ])
                                            @break

                                            @case('quize')
                                                @include('frontend.course-content.quize-viewer', [
                                                    'quize' => $lect->quize,
                                                ])
                                            @break

                                            @default
                                        @endswitch
                                        <div class="lectures_navigation_buttons">
                                            <button class="previous @if (isset($sect->lectures[$loop->index + 1]) &&
                                                    ($sect->lectures[$loop->index + 1]['accessing'] == 'private' && !$reserved)) 'disabled' @endif"
                                                onclick="backLecture('{{ $lecture->id }}')">{{ __('global.previous') }}</button>

                                            <button class="next @if (isset($sect->lectures[$loop->index + 1]) &&
                                                    ($sect->lectures[$loop->index + 1]['accessing'] == 'private' && !$reserved)) 'disabled' @endif"
                                                onclick="nextLecture('{{ $lecture->id }}')">{{ __('global.next') }}</button>
                                        </div>
                                        @if ($lect->type != 'quize')
                                            <h4 class="lecture_main_title">
                                                {{ $lect->title }}
                                            </h4>
                                            <p class="lecture_main_short_description">
                                                {{ $lecture->short_description }}
                                            </p>
                                            @if ($lect->type == 'video')
                                                <div class="current-lec-note-{{ $lect->id }}">

                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    @if ($oneCourse->questionaire)
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="mt-1" action="{{ route('questionaire.result', ['locale' => app()->getLocale()]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $oneCourse['id'] }}">
                        <input type="hidden" name="course_questionaire_id" value="{{ $oneCourse->questionaire->id }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('lms.course_questionaire') }}</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="main-div p-3">

                                <ul class="quiz">
                                    @foreach ($oneCourse->questionaire->questions as $qkey => $question)
                                        <li class="d-block">
                                            <p>{{ $loop->index + 1 }} - {!! app()->getLocale() == 'ar' ? $question['title_ar'] : $question['title_en'] !!} <small><span
                                                        class="subhead-golden">
                                                    </span></small></p>
                                            <ul class="choices">
                                                @if ($question['type'] == 'true_false')
                                                    @foreach (['true', 'false'] as $key => $ans)
                                                        <input type="hidden"
                                                            name="questions[{{ $qkey }}][course_questionaire_question_id]"
                                                            value="{{ $question['id'] }}">
                                                        <input type="hidden" name="questions[{{ $qkey }}][type]"
                                                            value="{{ $question['type'] }}">
                                                        <li><label class="d-flex">
                                                                <input id="answer_id{{ $key }}" class="col-1"
                                                                    type="radio"
                                                                    name="questions[{{ $qkey }}][answer_id]"
                                                                    value="{{ $ans }}"><span
                                                                    class="col-11">{!! $ans !!}</span></label>
                                                        </li>
                                                    @endforeach
                                                @elseif($question['type'] == 'select')
                                                    @foreach ($question['answars'] as $key => $ans)
                                                        <input type="hidden"
                                                            name="questions[{{ $qkey }}][course_questionaire_question_id]"
                                                            value="{{ $question['id'] }}">
                                                        <input type="hidden"
                                                            name="questions[{{ $qkey }}][type]"
                                                            value="{{ $question['type'] }}">
                                                        <li><label class="d-flex">
                                                                <input id="answer_id{{ $key }}" class="col-1"
                                                                    type="radio"
                                                                    name="questions[{{ $qkey }}][answer_id]"
                                                                    value="{{ $ans['id'] }}"><span
                                                                    class="col-11">{!! $ans['title_en'] !!}</span></label>
                                                        </li>
                                                    @endforeach
                                                @elseif($question['type'] == 'text')
                                                    <input type="hidden"
                                                        name="questions[{{ $qkey }}][course_questionaire_question_id]"
                                                        value="{{ $question['id'] }}">
                                                    <input type="hidden" name="questions[{{ $qkey }}][type]"
                                                        value="{{ $question['type'] }}">
                                                    <li><label class="d-flex">
                                                            <textarea id="answer_id{{ $qkey }}" class="col-11" name="questions[{{ $qkey }}][answer_id]"></textarea>
                                                        </label>
                                                    </li>
                                                @elseif($question['type'] == 'multi_select')
                                                    @foreach ($question['answars'] as $key => $ans)
                                                        @php
                                                            $qkey += 1;
                                                        @endphp
                                                        <input type="hidden"
                                                            name="questions[{{ $qkey }}][course_questionaire_question_id]"
                                                            value="{{ $question['id'] }}">
                                                        <input type="hidden"
                                                            name="questions[{{ $qkey }}][type]"
                                                            value="{{ $question['type'] }}">
                                                        <li><label class="d-flex">
                                                                <input id="answer_id{{ $key }}" class="col-1"
                                                                    type="checkbox"
                                                                    name="questions[{{ $qkey }}][answer_id]"
                                                                    value="{{ $ans['id'] }}"><span
                                                                    class="col-11">{!! $ans['title_en'] !!}</span></label>
                                                        </li>
                                                    @endforeach
                                                @endif


                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>


                                <div class="form-group m-2 pt-2 d-flex justify-content-center"
                                    style="border: none; background-color: #845097;">
                                    <div class="rating__stars">
                                        <input id="rating-1" class="rating__input rating__input-1" type="radio"
                                            name="rating" value="1">
                                        <input id="rating-2" class="rating__input rating__input-2" type="radio"
                                            name="rating" value="2">
                                        <input id="rating-3" class="rating__input rating__input-3" type="radio"
                                            name="rating" value="3">
                                        <input id="rating-4" class="rating__input rating__input-4" type="radio"
                                            name="rating" value="4">
                                        <input id="rating-5" class="rating__input rating__input-5" type="radio"
                                            name="rating" value="5">
                                        <label class="rating__label" for="rating-1">
                                            <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32"
                                                aria-hidden="true">
                                                <g transform="translate(16,16)">
                                                    <circle class="rating__star-ring" fill="none" stroke="#000"
                                                        stroke-width="16" r="8" transform="scale(0)" />
                                                </g>
                                                <g stroke="#000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g transform="translate(16,16) rotate(180)">
                                                        <polygon class="rating__star-stroke"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="none" />
                                                        <polygon class="rating__star-fill"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="#000" />
                                                    </g>
                                                    <g transform="translate(16,16)" stroke-dasharray="12 12"
                                                        stroke-dashoffset="12">
                                                        <polyline class="rating__star-line" transform="rotate(0)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(72)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(144)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(216)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(288)"
                                                            points="0 4,0 16" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="rating__sr">1 star—Terrible</span>
                                        </label>
                                        <label class="rating__label" for="rating-2">
                                            <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32"
                                                aria-hidden="true">
                                                <g transform="translate(16,16)">
                                                    <circle class="rating__star-ring" fill="none" stroke="#000"
                                                        stroke-width="16" r="8" transform="scale(0)" />
                                                </g>
                                                <g stroke="#000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g transform="translate(16,16) rotate(180)">
                                                        <polygon class="rating__star-stroke"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="none" />
                                                        <polygon class="rating__star-fill"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="#000" />
                                                    </g>
                                                    <g transform="translate(16,16)" stroke-dasharray="12 12"
                                                        stroke-dashoffset="12">
                                                        <polyline class="rating__star-line" transform="rotate(0)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(72)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(144)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(216)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(288)"
                                                            points="0 4,0 16" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="rating__sr">2 stars—Bad</span>
                                        </label>
                                        <label class="rating__label" for="rating-3">
                                            <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32"
                                                aria-hidden="true">
                                                <g transform="translate(16,16)">
                                                    <circle class="rating__star-ring" fill="none" stroke="#000"
                                                        stroke-width="16" r="8" transform="scale(0)" />
                                                </g>
                                                <g stroke="#000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g transform="translate(16,16) rotate(180)">
                                                        <polygon class="rating__star-stroke"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="none" />
                                                        <polygon class="rating__star-fill"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="#000" />
                                                    </g>
                                                    <g transform="translate(16,16)" stroke-dasharray="12 12"
                                                        stroke-dashoffset="12">
                                                        <polyline class="rating__star-line" transform="rotate(0)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(72)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(144)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(216)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(288)"
                                                            points="0 4,0 16" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="rating__sr">3 stars—OK</span>
                                        </label>
                                        <label class="rating__label" for="rating-4">
                                            <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32"
                                                aria-hidden="true">
                                                <g transform="translate(16,16)">
                                                    <circle class="rating__star-ring" fill="none" stroke="#000"
                                                        stroke-width="16" r="8" transform="scale(0)" />
                                                </g>
                                                <g stroke="#000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g transform="translate(16,16) rotate(180)">
                                                        <polygon class="rating__star-stroke"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="none" />
                                                        <polygon class="rating__star-fill"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="#000" />
                                                    </g>
                                                    <g transform="translate(16,16)" stroke-dasharray="12 12"
                                                        stroke-dashoffset="12">
                                                        <polyline class="rating__star-line" transform="rotate(0)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(72)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(144)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(216)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(288)"
                                                            points="0 4,0 16" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="rating__sr">4 stars—Good</span>
                                        </label>
                                        <label class="rating__label" for="rating-5">
                                            <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32"
                                                aria-hidden="true">
                                                <g transform="translate(16,16)">
                                                    <circle class="rating__star-ring" fill="none" stroke="#000"
                                                        stroke-width="16" r="8" transform="scale(0)" />
                                                </g>
                                                <g stroke="#000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g transform="translate(16,16) rotate(180)">
                                                        <polygon class="rating__star-stroke"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="none" />
                                                        <polygon class="rating__star-fill"
                                                            points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07"
                                                            fill="#000" />
                                                    </g>
                                                    <g transform="translate(16,16)" stroke-dasharray="12 12"
                                                        stroke-dashoffset="12">
                                                        <polyline class="rating__star-line" transform="rotate(0)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(72)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(144)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(216)"
                                                            points="0 4,0 16" />
                                                        <polyline class="rating__star-line" transform="rotate(288)"
                                                            points="0 4,0 16" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="rating__sr">5 stars—Excellent</span>
                                        </label>
                                    </div>
                                </div>
                                <label class="d-flex m-2 flex-column-reverse">
                                    <textarea class="col-10 m-2" type="text" name="review"></textarea>
                                    <span>{{ __('lms.course_review') }}</span>
                                </label>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('lms.Save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
@endsection
@include('frontend.course-content.scripts')
<script>
    function backLecture(lectureId) {
        if ($('.course_content_right_sections .accordion-item').length) {

            var prevA = $('.course_content_right_sections a.list-group-item.active').prev()
            prevDiv = $('div.tab-pane.active.show').prev(),
                parentAccordion = $('.course_content_right_sections a.list-group-item.active').parents(
                    '.accordion-item'),
                parentAccordionPrev = parentAccordion.prev(),
                parentAccordionPrevChild = parentAccordionPrev.find(
                    '.list-group a.list-group-item:not(.disabled):last-of-type');

            if (prevA.length > 0 && prevDiv.length > 0 && !$(prevA).hasClass('disabled')) {
                // console.log(prevA)
                $('.course_content_right_sections a.list-group-item.active').attr('aria-selected', 'false').removeClass(
                    'active')
                prevA.addClass('active')
                prevA.attr('aria-selected', 'true')

                $('div.tab-pane.active.show').removeClass('active').removeClass('show')
                prevDiv.addClass('active').addClass('show')
            }

            if (parentAccordionPrevChild.length && !prevA.length > 0) {
                $('.course_content_right_sections a.list-group-item.active').attr('aria-selected', 'false').removeClass(
                    'active')
                parentAccordionPrevChild.addClass('active')
                parentAccordionPrevChild.attr('aria-selected', 'true')

                $('div.tab-pane.active.show').removeClass('active').removeClass('show')
                prevDiv.addClass('active').addClass('show')

                $('.course_content_right_sections .accordion-item').children('.accordion-header').children(
                    "button[aria-expanded = 'true']").addClass('collapsed')
                $('.course_content_right_sections .accordion-item').children('.accordion-header').children(
                    "button[aria-expanded = 'true']").attr('aria-expanded', 'false')
                $('.course_content_right_sections .accordion-item').children('.accordion-header.show').removeClass(
                    'show')
                $('.course_content_right_sections .accordion-item').children('.accordion-collapse.show').removeClass(
                    'show')

                parentAccordionPrev.children('.accordion-header').children("button[aria-expanded = 'false']")
                    .removeClass('collapsed')
                parentAccordionPrev.children('.accordion-header').children("button[aria-expanded = 'false']").attr(
                    'aria-expanded', 'true')
                parentAccordionPrev.children('.accordion-header').addClass('show')
                parentAccordionPrev.children('.accordion-collapse').addClass('show')
            }
        }
        if ($('.course_content_right_sections_on_small_screen').length) {
            var prevA = $('.course_content_right_sections_on_small_screen a.list-group-item.active').parents(
                '.owl-item').prev().find('a.list-group-item')
            //         // prevDiv = $('div.tab-pane.active.show').next(),
            //         // parentAccordion = $('.course_content_right_sections_on_small_screen a.list-group-item.active').parents('.accordion-item'),
            //         // parentAccordionPrev = parentAccordion.next(),
            //         // parentAccordionPrevChild = parentAccordionPrev.find('.list-group a.list-group-item:not(.disabled):last-of-type');

            console.log('prevA: ' + prevA.attr('class'))

            if (prevA.length > 0 && !$(prevA).hasClass('disabled')) {
                $('.course_content_right_sections_on_small_screen a.list-group-item.active').attr('aria-selected',
                    'false').removeClass('active')
                prevA.addClass('active')
                prevA.attr('aria-selected', 'true')

                $('div.tab-pane.active.show').removeClass('active').removeClass('show')
                prevDiv.addClass('active').addClass('show')
            }
        }
    }

    function nextLecture(lectureId) {
        if ($('.course_content_right_sections .accordion-item').length) {
            // alert($('.course_content_right_sections .accordion-item').length)

            var prevA = $('.course_content_right_sections a.list-group-item.active').next()
            prevDiv = $('div.tab-pane.active.show').next(),
                parentAccordion = $('.course_content_right_sections a.list-group-item.active').parents(
                    '.accordion-item'),
                parentAccordionPrev = parentAccordion.next(),
                parentAccordionPrevChild = parentAccordionPrev.find(
                    '.list-group a.list-group-item:not(.disabled):last-of-type');

            if (prevA.length > 0 && prevDiv.length > 0 && !$(prevA).hasClass('disabled')) {
                // console.log(prevA)
                $('.course_content_right_sections a.list-group-item.active').attr('aria-selected', 'false').removeClass(
                    'active')
                prevA.addClass('active')
                prevA.attr('aria-selected', 'true')

                $('div.tab-pane.active.show').removeClass('active').removeClass('show')
                prevDiv.addClass('active').addClass('show')
            }

            if (parentAccordionPrevChild.length && !prevA.length > 0) {
                $('.course_content_right_sections a.list-group-item.active').attr('aria-selected', 'false').removeClass(
                    'active')
                parentAccordionPrevChild.addClass('active')
                parentAccordionPrevChild.attr('aria-selected', 'true')

                $('div.tab-pane.active.show').removeClass('active').removeClass('show')
                prevDiv.addClass('active').addClass('show')

                $('.course_content_right_sections .accordion-item').children('.accordion-header').children(
                    "button[aria-expanded = 'true']").addClass('collapsed')
                $('.course_content_right_sections .accordion-item').children('.accordion-header').children(
                    "button[aria-expanded = 'true']").attr('aria-expanded', 'false')
                $('.course_content_right_sections .accordion-item').children('.accordion-header.show').removeClass(
                    'show')
                $('.course_content_right_sections .accordion-item').children('.accordion-collapse.show').removeClass(
                    'show')

                parentAccordionPrev.children('.accordion-header').children("button[aria-expanded = 'false']")
                    .removeClass('collapsed')
                parentAccordionPrev.children('.accordion-header').children("button[aria-expanded = 'false']").attr(
                    'aria-expanded', 'true')
                parentAccordionPrev.children('.accordion-header').addClass('show')
                parentAccordionPrev.children('.accordion-collapse').addClass('show')
            }
        }
        if ($('.course_content_right_sections_on_small_screen').length) {
            var prevA = $('.course_content_right_sections_on_small_screen a.list-group-item.active').parents(
                '.owl-item').next().find('a.list-group-item')
            //         // prevDiv = $('div.tab-pane.active.show').next(),
            //         // parentAccordion = $('.course_content_right_sections_on_small_screen a.list-group-item.active').parents('.accordion-item'),
            //         // parentAccordionPrev = parentAccordion.next(),
            //         // parentAccordionPrevChild = parentAccordionPrev.find('.list-group a.list-group-item:not(.disabled):last-of-type');

            console.log('prevA: ' + prevA.attr('class'))

            if (prevA.length > 0 && !$(prevA).hasClass('disabled')) {
                $('.course_content_right_sections_on_small_screen a.list-group-item.active').attr('aria-selected',
                    'false').removeClass('active')
                prevA.addClass('active')
                prevA.attr('aria-selected', 'true')

                $('div.tab-pane.active.show').removeClass('active').removeClass('show')
                prevDiv.addClass('active').addClass('show')
            }
        }
    }
</script>
{{-- @include('frontend.course-content.scripts') --}}
@section('scripts')
    @parent
    <script>
        $(document).on('click', '.accordion-button', function() {
            var id = $(this).attr('data-bs-target');
            console.log(id);
            if ($(this).hasClass('collapsed')) {
                console.log('gf');
                $(id).removeClass('in').addClass('collapse');
            } else {
                console.log('gfs');
                $(id).removeClass('collapse').addClass('in');
            }
        });
        $(document).on('click', '.list-group-item-action', function() {
            var current = $(this);
            $('.list-group-item-action').each(function(index, currentValue) {
                if ($(currentValue).attr("id") != $(current).attr('id')) {
                    currentValue.classList.remove('active');
                    var accord = $(currentValue).attr("id");
                    accord = accord.replace('-list', '');
                    $(`#${accord}`).removeClass('active');
                }
            });
        })


        // close the other accordion-item
        $('.course_content_right_sections .accordion-item').click(function() {
            $(this).siblings('.accordion-item').children('.accordion-header').children(
                "button[aria-expanded = 'true']").addClass('collapsed')
            $(this).siblings('.accordion-item').children('.accordion-header').children(
                "button[aria-expanded = 'true']").attr('aria-expanded', 'false')
            $(this).siblings('.accordion-item').children('.accordion-header.show').removeClass('show')
            $(this).siblings('.accordion-item').children('.accordion-collapse.show').removeClass('show')
        })
    </script>
@endsection
