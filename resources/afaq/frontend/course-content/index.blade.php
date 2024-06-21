@extends('layouts.front ')
<style>
    .end-course-card#exampleModal {
        background: #7d7d7d;
    }

    .end-course-card#exampleModal .modal-dialog {
        margin: 25vh auto 0 auto;
    }

    @font-face {
        font-family: 'VideoJS';
        src: url('https://vjs.zencdn.net/f/1/vjs.eot');
        src: url('https://vjs.zencdn.net/f/1/vjs.eot?#iefix') format('embedded-opentype'),
            url('https://vjs.zencdn.net/f/1/vjs.woff') format('woff'),
            url('https://vjs.zencdn.net/f/1/vjs.ttf') format('truetype');
    }

    .video-js .vjs-play-control.vjs-playing .vjs-icon-placeholder:before,
    .vjs-icon-pause:before {
        content: "\f103";
        font-family: 'VideoJS';
    }

    .video-js .vjs-mute-control .vjs-icon-placeholder:before,
    .vjs-icon-volume-high:before {
        content: "\f107";
        font-family: 'VideoJS';
    }

    .video-js .vjs-big-play-button .vjs-icon-placeholder:before,
    .video-js .vjs-play-control .vjs-icon-placeholder:before,
    .vjs-icon-play:before {
        content: "\f101";
        font-family: 'VideoJS';
    }

    .video-js .vjs-picture-in-picture-control .vjs-icon-placeholder:before,
    .vjs-icon-picture-in-picture-enter:before {
        content: "\f121";
        font-family: 'VideoJS';
    }



    .video-js .vjs-fullscreen-control .vjs-icon-placeholder:before,
    .vjs-icon-fullscreen-enter:before {
        content: "\f108";
        font-family: 'VideoJS';
    }
</style>
@section('title', __('lms.courses'))
@section('content')

    <link rel="stylesheet" href="{{ asset('afaq/assests/css/new-content-style.css') }}">

    <?php
    // date_default_timezone_set('UTC');
    $role = auth()->check() ? auth()->user()->roles()->where('id', 1)->exists() : false;

    if (auth()->check()) {
        $login = true;
        $reserved = \App\Models\Enroll::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id, 'approved' => 1])->count();
        $user_course = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first();
    } else {
        $login = false;
        $reserved = 0;
        $user_course = null;
        $check_cart = null;
    }
    ?>
    @include('frontend.course-content.style')


    <div class="br-div px-5 course-content-page" style="">
        <ul class="br-ul">
            <li><a href="{{ route('site-home', ['locale' => app()->getLocale()]) }}">{{ __('lms.homepage') }}</a> /</li>
            <li><a
                    href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">{{ __('frontend.eventandactivities') }}</a>
                /</li>
            <li><a
                    href="{{ route('one-courses-new', ['courses_id' => $oneCourse->id, 'locale' => app()->getLocale()]) }}">{{ $oneCourse->name }}</a>
                /</li>
            <li><a href="#">{{ __('afaq.content') }}</a></li>
        </ul>
    </div>
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
                            $quize_score =  $lecture->quize ? $lecture->quize
                                ->scores()
                                ->where('user_id', auth()->user()->id)
                                ->first() : null;
                            $quize_repeate_access =
                                $lecture->type == 'quize' &&
                                ($quize_score
                                    ? ($quize_score->repeat_times < $lecture->quize->repeat_times
                                        ? true
                                        : false)
                                    : true)
                                    ? true
                                    : false;
                            $depend_access = true;
                            if ($lecture->depends_on_id) {
                                switch ($lecture->dependsOn->type) {
                                    case 'quize':
                                        $quiz_depends_score = $lecture->dependsOn->quize
                                            ? $lecture->dependsOn->quize
                                                ->scores()
                                                ->where('user_id', auth()->user()->id)
                                                ->first()
                                            : null;
                                        $depend_access =
                                            $quiz_depends_score && $quiz_depends_score->score_percentage > 90
                                                ? true
                                                : false;
                                        break;
                                    case 'zoom':
                                        $zoom_depend_score = $lecture->dependsOn->zoom
                                            ? $lecture->dependsOn->zoom
                                                ->reports()
                                                ->where('user_id', auth()->user()->id)
                                                ->first()
                                            : null;
                                        $depend_access = $lecture->dependsOn->zoom
                                            ? ($zoom_depend_score && $zoom_depend_score->score_percentage > 90
                                                ? true
                                                : false)
                                            : false;
                                        break;
                                    case 'video':
                                        $video_depend_score = $lecture->dependsOn
                                            ? $lecture->dependsOn
                                                ->videoScore()
                                                ->where('user_id', auth()->user()->id)
                                                ->first()
                                            : null;
                                        $depend_access = $lecture->dependsOn
                                            ? ($video_depend_score && $video_depend_score->score_percentage > 90
                                                ? true
                                                : false)
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
                                @if (!$role && !$reserved && $lecture->accessing == 'private') disabled @endif
                                @if ($lecture->type == 'quize' && !$quize_repeate_access) disabled @endif
                                @if (!$depend_access) disabled @endif"
                            id="list-{{ $lecture->id }}-list"
                            href="{{ route('one-course-content', ['locale' => app()->getLocale(), 'course_id' => $oneCourse->id, 'section_id' => $section->id, 'lecture_id' => $lecture->id]) }}"
                            role="tab" aria-controls="list-{{ $lecture->id }}">

                            <!-- <span class="lecture_title_side_menu">
                                                                                                    {{ $loop->index + 1 }}- {{ $lecture->title }}
                                                                                                </span> -->
                            @switch($lecture->type)
                                @case('video')
                                    @if (
                                        $lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                            $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage > 90)
                                        @php $class = 'completed' @endphp
                                    @elseif (
                                        $lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                            $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage < 90)
                                        @php $class = 'not-completed' @endphp
                                    @else
                                        @php $class = '' @endphp
                                    @endif
                                @break

                                @case('zoom')
                                    @php
                                        $zoom_report = $lecture->zoom
                                            ? $lecture->zoom
                                                ->reports()
                                                ->where('user_id', auth()->user()->id)
                                                ->first()
                                            : null;
                                    @endphp
                                    @if ($zoom_report && $zoom_report->join_percentage > 50)
                                        @php $class = 'completed' @endphp
                                    @elseif ($zoom_report && $zoom_report->join_percentage < 50)
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
                                                @php
                                                    $rsd = $lecture->videoScore()->where('user_id', auth()->user()->id)->first();
                                                @endphp
                                                @if ($rsd)
                                                    <span class="complete-percentage-hover-top">{{ __('global.finished') }}
                                                        <br>
                                                        {{ $rsd->score_percentage }}
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
                                            $zoom_report = $lecture->zoom
                                                ? $lecture->zoom
                                                    ->reports()
                                                    ->where('user_id', auth()->user()->id)
                                                    ->first()
                                                : null;
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
                                                @php
                                                    $ew = $lecture->quize->scores()->where('user_id', auth()->user()->id)->first();
                                                @endphp
                                                @if ($ew)
                                                    <span class="complete-percentage-hover-top">{{ __('global.finished') }}
                                                        <br>
                                                        {{ $ew->score_percentage }}
                                                        %</span>
                                                @endif
                                            </div>

                                            <p>{{ $lecture->title }}
                                                <br>
                                                {{ __('lms.can_repeat') }}
                                                {{-- {{ $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->repeat_times }} --}}
                                                {{ $lecture->quize->repeat_times }}

                                                {{ __('lms.times') }}

                                            </p>
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
            <div style="display: none" id="left-notes" class="order-xl-1 order-2 left-notes">
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
            <div class="col-12 order-xl-2 order-1 right-notes" id="right-notes">
                <h4 class="course_title on_large_screen mt-5">
                    {{ app()->getLocale() == 'en' ? $oneCourse->name_en : $oneCourse->name_ar }}
                </h4>
                <div class="progress_line_parent on_large_screen">
                    <div class="questionaire_button lms">
                        @if (isset($user_course) &&
                                //                                $oneCourse->success_percentage <= $user_course->completion_percentage &&
                                $oneCourse->questionaire)
                            @if (
                                (auth()->check() &&
                                    \App\Models\Review::where(['user_id' => auth()->user()->id, 'course_id' => $oneCourse->id])->first()) ||
                                    $user_questionaire_before)
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
                        <div class="accordion test" id="accordionPanelsStayOpenExample">
                            @foreach ($oneCourse->sections as $keySection => $section)
                                <div class="accordion-item accordion-btn">
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
                                        class="accordion-collapse collapse  {{ $section_id == $section->id ? 'in show' : '' }} "
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
                                                                    ->first()->repeat_times <
                                                                $lecture->quize->repeat_times
                                                                    ? true
                                                                    : false)
                                                                : true)
                                                                ? true
                                                                : false;
                                                        $depend_access = true;
                                                        if ($lecture->depends_on_id) {
                                                            switch ($lecture->dependsOn->type) {
                                                                case 'quize':
                                                                    $quiz_depends_score = $lecture->dependsOn->quize
                                                                        ? $lecture->dependsOn->quize
                                                                            ->scores()
                                                                            ->where('user_id', auth()->user()->id)
                                                                            ->first()
                                                                        : null;
                                                                    $depend_access =
                                                                        $quiz_depends_score &&
                                                                        $quiz_depends_score->score_percentage > 90
                                                                            ? true
                                                                            : false;
                                                                    break;
                                                                case 'zoom':
                                                                    $zoom_depend_score = $lecture->dependsOn->zoom
                                                                        ? $lecture->dependsOn->zoom
                                                                            ->reports()
                                                                            ->where('user_id', auth()->user()->id)
                                                                            ->first()
                                                                        : null;
                                                                    $depend_access = $lecture->dependsOn->zoom
                                                                        ? ($zoom_depend_score &&
                                                                        $zoom_depend_score->score_percentage > 90
                                                                            ? true
                                                                            : false)
                                                                        : false;
                                                                    break;
                                                                case 'video':
                                                                    $video_depend_score = $lecture->dependsOn
                                                                        ? $lecture->dependsOn
                                                                            ->videoScore()
                                                                            ->where('user_id', auth()->user()->id)
                                                                            ->first()
                                                                        : null;
                                                                    $depend_access = $lecture->dependsOn
                                                                        ? ($video_depend_score &&
                                                                        $video_depend_score->score_percentage > 90
                                                                            ? true
                                                                            : false)
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
                                                         @if (!$role && !$reserved && $lecture->accessing == 'private') disabled @endif
                                                         @if ($lecture->type == 'quize' && !$quize_repeate_access) disabled @endif
                                                          @if (!$depend_access) disabled @endif"
                                                        id="list-{{ $lecture->id }}-list"
                                                        href="{{ route('one-course-content', ['locale' => app()->getLocale(), 'course_id' => $oneCourse->id, 'section_id' => $section->id, 'lecture_id' => $lecture->id]) }}"
                                                        role="tab" aria-controls="list-{{ $lecture->id }}">
                                                        <!-- <span class="lecture_title_side_menu">
                                                                                                                                {{ $loop->index + 1 }}- {{ $lecture->title }}
                                                                                                                            </span> -->
                                                        @switch($lecture->type)
                                                            @case('video')
                                                                @php
                                                                    $le_score = $lecture->videoScore->where('user_id', auth()->user()->id)->first();
                                                                @endphp
                                                                @if ($le_score
                                                                     &&
                                                                        $le_score->score_percentage > 50)
                                                                    @php $class = 'completed' @endphp
                                                                @elseif (
                                                                    $le_score &&
                                                                        $le_score->score_percentage < 50)
                                                                    @php $class = 'not-completed' @endphp
                                                                @else
                                                                    @php $class = '' @endphp
                                                                @endif
                                                            @break

                                                            @case('zoom')
                                                                @php
                                                                    $zoom_report = $lecture->zoom
                                                                        ? $lecture->zoom
                                                                            ->reports()
                                                                            ->where('user_id', auth()->user()->id)
                                                                            ->first()
                                                                        : null;
                                                                @endphp
                                                                @if ($zoom_report && $zoom_report->join_percentage > 50)
                                                                    @php $class = 'completed' @endphp
                                                                @elseif ($zoom_report && $zoom_report->join_percentage < 50)
                                                                    @php $class = 'not-completed' @endphp
                                                                @else
                                                                    @php $class = '' @endphp
                                                                @endif
                                                            @break

                                                            @case('quize')
                                                                @php
                                                                    $qu_sco = $lecture->quize->scores()->where('user_id', auth()->user()->id)->first();
                                                                @endphp
                                                                @if (
                                                                    $qu_sco &&
                                                                        $qu_sco->score_percentage > $lecture->quize->success_percentage)
                                                                    @php $class = 'completed' @endphp
                                                                @elseif (
                                                                    $qu_sco &&
                                                                        $qu_sco->score_percentage < $lecture->quize->success_percentage)
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
                                                                            @php
                                                                                $l_score = $lecture->videoScore()->where('user_id', auth()->user()->id)->first();
                                                                            @endphp
                                                                            @if ($l_score)
                                                                                <span
                                                                                    class="complete-percentage-hover">{{ __('global.finished') }}
                                                                                    <br>
                                                                                    {{ $l_score->score_percentage }}
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
                                                                        $zoom_report = $lecture->zoom
                                                                            ? $lecture->zoom
                                                                                ->reports()
                                                                                ->where('user_id', auth()->user()->id)
                                                                                ->first()
                                                                            : null;
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
                                                                            @php
                                                                                $l_q_s = $lecture->quize->scores()->where('user_id', auth()->user()->id)->first();
                                                                            @endphp
                                                                            @if ($l_q_s)
                                                                                <span
                                                                                    class="complete-percentage-hover">{{ __('global.finished') }}
                                                                                    <br>
                                                                                    {{ $l_q_s->score_percentage }}
                                                                                    %</span>
                                                                            @endif
                                                                        </div>

                                                                        <p>{{ $lecture->title }}
                                                                            <br>
                                                                            {{ __('lms.can_repeat') }}
                                                                            {{--                                                                            {{ $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->repeat_times }} --}}
                                                                            {{ $lecture->quize->repeat_times }}

                                                                            {{ __('lms.times') }}

                                                                        </p>
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

                                                                @case('attendance_design')
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
                        <div class="tab-content " id="nav-tabContent">
                            @foreach ($oneCourse->sections as $key => $sect)
                                @foreach ($sect->lectures as $keyLec => $lect)
                                    @php
                                        if (isset($sect->lectures[$loop->index + 1])) {
                                            $nextId = $sect->lectures[$loop->index + 1]['id'];
                                            $nextType = $sect->lectures[$loop->index + 1]['type'];
                                        } else {
                                            if (isset($oneCourse->sections[$loop->parent->index + 1])) {
                                                $nextId = isset(
                                                    $oneCourse->sections[$loop->parent->index + 1]['lectures'][0],
                                                )
                                                    ? $oneCourse->sections[$loop->parent->index + 1]['lectures'][0][
                                                        'id'
                                                    ]
                                                    : null;
                                                $nextType = isset(
                                                    $oneCourse->sections[$loop->parent->index + 1]['lectures'][0],
                                                )
                                                    ? $oneCourse->sections[$loop->parent->index + 1]['lectures'][0][
                                                        'type'
                                                    ]
                                                    : null;
                                            } else {
                                                $nextId = null;
                                                $nextType = null;
                                            }
                                        }

                                        if (isset($sect->lectures[$loop->index - 1])) {
                                            $prevId = $sect->lectures[$loop->index - 1]['id'];
                                            $prevType = $sect->lectures[$loop->index - 1]['type'];
                                        } else {
                                            if (isset($oneCourse->sections[$loop->parent->index - 1])) {
                                                $prevId = isset(
                                                    $oneCourse->sections[$loop->parent->index - 1]['lectures'][0],
                                                )
                                                    ? $oneCourse->sections[$loop->parent->index - 1]['lectures'][0][
                                                        'id'
                                                    ]
                                                    : null;
                                                $prevType = isset(
                                                    $oneCourse->sections[$loop->parent->index - 1]['lectures'][0],
                                                )
                                                    ? $oneCourse->sections[$loop->parent->index - 1]['lectures'][0][
                                                        'type'
                                                    ]
                                                    : null;
                                            } else {
                                                $prevId = null;
                                                $prevType = null;
                                            }
                                        }
                                        $depend_access = false;
                                        if ($lecture->depends_on_id) {
                                switch ($lecture->dependsOn->type) {
                                    case 'quize':
                                        $quiz_depends_score = $lecture->dependsOn->quize
                                            ? $lecture->dependsOn->quize
                                                ->scores()
                                                ->where('user_id', auth()->user()->id)
                                                ->first()
                                            : null;
                                        $depend_access =
                                            $quiz_depends_score && $quiz_depends_score->score_percentage > 90
                                                ? true
                                                : false;
                                        break;
                                    case 'zoom':
                                        $zoom_depend_score = $lecture->dependsOn->zoom
                                            ? $lecture->dependsOn->zoom
                                                ->reports()
                                                ->where('user_id', auth()->user()->id)
                                                ->first()
                                            : null;
                                        $depend_access = $lecture->dependsOn->zoom
                                            ? ($zoom_depend_score && $zoom_depend_score->score_percentage > 90
                                                ? true
                                                : false)
                                            : false;
                                        break;
                                    case 'video':
                                        $video_depend_score = $lecture->dependsOn
                                            ? $lecture->dependsOn
                                                ->videoScore()
                                                ->where('user_id', auth()->user()->id)
                                                ->first()
                                            : null;
                                        $depend_access = $lecture->dependsOn
                                            ? ($video_depend_score && $video_depend_score->score_percentage > 90
                                                ? true
                                                : false)
                                            : false;
                                        break;
                                    default:
                                        $depend_access = true;
                                        # code...
                                        break;
                                }
                            }
                                    @endphp
                                    @if ($lect->id == $lecture_id)
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
                                                    @if (!is_null($lect->zoom))
                                                        @include('frontend.course-content.zoom-viewer', [
                                                            'lecture' => $lect,
                                                        ])
                                                    @endif
                                                @break

                                                @case('quize')
                                                    @include('frontend.course-content.quize-viewer', [
                                                        'quize' => $lect->quize,
                                                        'nextId' => $nextId,
                                                    ])
                                                @break

                                                @case('attendance_design')
                                                    @include('frontend.course-content.attendance-viewer', [
                                                        'attendance_design' => $lect->attendance_design,
                                                    ])
                                                @break

                                                @default
                                            @endswitch
                                            <div class="lectures_navigation_buttons">

                                                <a
                                                    class="previous btn @if (isset($sect->lectures[$loop->index + 1]) &&
                                                            ($sect->lectures[$loop->index + 1]['accessing'] == 'private' && !$reserved && !$role)) 'disabled' @endif"
                                                    @if ($depend_access) href="{{ route('one-course-content', ['locale' => app()->getLocale(), 'course_id' => $oneCourse->id, 'section_id' => $sect->id, 'lecture_id' => $prevId]) }}" @endif>{{ __('global.previous') }}</a>

                                                <a class="next btn text-light @if (isset($sect->lectures[$loop->index + 1]) &&
                                                        ($sect->lectures[$loop->index + 1]['accessing'] == 'private' && !$reserved && !$role)) 'disabled' @endif"
                                                    @if ($depend_access) href="{{ route('one-course-content', ['locale' => app()->getLocale(), 'course_id' => $oneCourse->id, 'section_id' => $sect->id, 'lecture_id' => $nextId]) }}" @endif>{{ __('global.next') }}</a>
                                            </div>
                                            @if ($lect->type != 'quize')
                                                <h4 class="lecture_main_title">
                                                    {{ $lect->title }}
                                                </h4>
                                                <p class="lecture_main_short_description">
                                                    {{ $lect->short_description }}
                                                </p>
                                                @if ($lect->type == 'video')
                                                    <div class="current-lec-note-{{ $lect->id }}">

                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    @if ($oneCourse->questionaire && !$user_questionaire_before)
        <div class="modal fade end-course-card" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="mt-1" id="questionnaire_form">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $oneCourse['id'] }}">
                        <input type="hidden" name="course_questionaire_id" value="{{ $oneCourse->questionaire->id }}">
                        <div class="modal-header">
                            {{-- <h5 class="modal-title" id="exampleModalLabel">{{ __('lms.course_questionaire') }}</h5> --}}
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="main-body  snw sml">

                                @foreach ($oneCourse->questionaire->questions as $key => $question)
                                    @if ($key == 0)
                                        <div class="tabes-qusetions first-div active">
                                            <input type="hidden" name="answer[{{ $question->id }}][type]"
                                                value="{{ $question->type }}">
                                            <div class="title-tape">
                                                <span>{{ __('lms.questions') }}<em>{{ $key + 1 }}</em> /
                                                    {{ count($oneCourse->questionaire->questions) }}</span>
                                            </div>
                                            <div class="all-qusetions">
                                                <h4>{{ app()->getLocale() == 'ar' ? $question->title_ar : $question->title_en }}
                                                </h4>
                                            </div>
                                            <div class="the-answer">
                                                @switch($question->type)
                                                    @case('true_false')
                                                        <span class="answer-option group">
                                                            <input type="radio" id="radio01"
                                                                name="answer[{{ $question->id }}][]" value="1">
                                                            <label for="radio01">True</label>
                                                        </span>
                                                        <span class="answer-option group">
                                                            <input type="radio" id="radio01"
                                                                name="answer[{{ $question->id }}][]" value="0">
                                                            <label for="radio01">False</label>
                                                        </span>
                                                    @break

                                                    @case('select')
                                                        @foreach ($question->answars as $answer)
                                                            <span class="answer-option group">
                                                                <input type="radio" id="radio01"
                                                                    name="answer[{{ $question->id }}][]"
                                                                    value="{{ app()->getLocale() == 'ar' ? $answer->title_ar : $answer->title_en }}">
                                                                <label
                                                                    for="radio01">{{ app()->getLocale() == 'ar' ? $answer->title_ar : $answer->title_en }}</label>
                                                            </span>
                                                        @endforeach
                                                    @break

                                                    @default
                                                        <input type="textarea" name="answer[{{ $question->id }}][]">
                                                @endswitch
                                            </div>
                                            <div class="subment-btn-nxt 2k">
                                                @if ($key + 1 == count($oneCourse->questionaire->questions))
                                                    <input class="btn-next " type="submit"
                                                        value="{{ __('lms.save') }}" onclick="take_questionnaire();" />
                                                @else
                                                    <span class="btn-back b-one-tabe">{{ __('lms.back') }}</span>
                                                    <span class="btn-next n-one-tabe">{{ __('lms.Next') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        @continue
                                    @endif

                                    <div class="tabes-qusetions next-div" style="display:none;">
                                        <input type="hidden" name="answer[{{ $question->id }}][type]"
                                            value="{{ $question->type }}">
                                        <div class="title-tape">
                                            <span>{{ __('lms.questions') }} <em>{{ $key + 1 }}</em> /
                                                {{ count($oneCourse->questionaire->questions) }}</span>
                                        </div>
                                        <div class="all-qusetions">
                                            <h4>{{ app()->getLocale() == 'ar' ? $question->title_ar : $question->title_en }}
                                            </h4>
                                        </div>
                                        <div class="the-answer">
                                            @switch($question->type)
                                                @case('true_false')
                                                    <span class="answer-option group">
                                                        <input type="radio" id="radio01"
                                                            name="answer[{{ $question->id }}][]" value="1">
                                                        <label for="radio01">True</label>
                                                    </span>
                                                    <span class="answer-option group">
                                                        <input type="radio" id="radio01"name="answer[{{ $question->id }}][]"
                                                            value="0">
                                                        <label for="radio01">False</label>
                                                    </span>
                                                @break

                                                @case('select')
                                                    @foreach ($question->answars as $answer)
                                                        <span class="answer-option group">
                                                            <input type="radio" id="radio01"
                                                                name="answer[{{ $question->id }}][]"
                                                                value="{{ app()->getLocale() == 'ar' ? $answer->title_ar : $answer->title_en }}">
                                                            <label for="radio01">{{ $answer->title_en }}</label>
                                                        </span>
                                                    @endforeach
                                                @break

                                                @default
                                                    <input type="textarea" name="answer[{{ $question->id }}][]">
                                            @endswitch
                                        </div>
                                        <div class="subment-btn-nxt 3k">
                                            <span class="btn-back b-one-tabe">{{ __('lms.back') }}</span>

                                            @if ($key + 1 == count($oneCourse->questionaire->questions))
                                                <input class="btn-next n-one-tabe 2-s" type="submit"
                                                    value="{{ __('lms.save') }}" onclick="take_questionnaire();" />
                                            @else
                                                <span class="btn-next n-one-tabe">{{ __('lms.Next') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="modal fade end-course-card" id="exampleModa2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="log-in-form">
                    <div class="login-main main-body successful-bopup">
                        <div class="close-form">
                            <a href=""><i class="fa-solid fa-xmark"></i></a>
                        </div>
                        <div class="main-b-successful">
                            <div class="img-popup">
                                <img src="{{ asset('afaq/imgs/Group 43499.svg') }}" class="successful-img"
                                    alt="">
                            </div>
                            <strong>{{ app()->getLocale() == 'ar' ? 'تم بنجاح' : 'Successful' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('frontend.course-content.scripts')

<script>
    function backLecture(lectureId, prevId, $type = null) {
        console.log($type);

        if ($('.course_content_right_sections .accordion-item').length) {
            console.log('1');
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
                console.log('22');
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
            console.log('2');
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

        if ($type != 'video') {
            //pause other video
            $(".video-js").each(function(index) {
                this.player.pause();
            });
        }
        // $(`#list-${prevId}`).addClass('show')
        // $(`#list-${prevId}`).addClass('active')
        setVideoNotes(prevId)

    }

    function nextLecture(lectureId, nextId, $type = null) {
        console.log($type);
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


            if (prevA.length > 0 && !$(prevA).hasClass('disabled')) {
                $('.course_content_right_sections_on_small_screen a.list-group-item.active').attr('aria-selected',
                    'false').removeClass('active')
                prevA.addClass('active')
                prevA.attr('aria-selected', 'true')

                $('div.tab-pane.active.show').removeClass('active').removeClass('show')
                prevDiv.addClass('active').addClass('show')
            }
        }
        if ($type != 'video') {
            console.log('dde');
            //pause other video
            $(".video-js").each(function(index) {
                this.player.pause();
            });
        }
        setVideoNotes(nextId)
    }




    function take_questionnaire() {
        // console.log('Here')
        // $('#exampleModal').modal('hide');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: "{{ route('questionaire.result', ['locale' => app()->getLocale()]) }}",
            data: $('#questionnaire_form').serialize(),
            success: function(data) {
                $('#exampleModa2').modal('show');
            }

        });
    }
</script>
{{-- @include('frontend.course-content.scripts') --}}
@section('scripts')
    @parent
    <script src="{{ asset('afaq/assests/js/video.js') }}"></script>

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
        $("#questionnaire_form").submit(function(e) {
            e.preventDefault();
        });
    </script>

    {{-- <script src="{{ asset('afaq/new-assets/jquery.steps.min.js') }}"></script>
     <script src="{{ asset('afaq/new-assets/jquery.steps.js') }}"></script> --}}
@endsection
