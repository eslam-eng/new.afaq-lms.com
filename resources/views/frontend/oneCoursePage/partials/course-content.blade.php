<div class="right_side_info col-lg-9 order-lg-1 order-2">
    <p>
        {{ $oneCourse->name }}
    </p>
    <div style="padding-top: 13px; height: 72px; content: '';" class="course_condition_images d-flex">
        @if ($oneCourse->coursePlace)
            <img src="{{ $oneCourse->coursePlace->image_url ?? '' }}" alt="course type">
        @endif
        @include('frontend.sections.cme_hours', ['course' => $oneCourse])
    </div>
    <nav class="content-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="course_intro-tab" data-bs-toggle="tab" data-bs-target="#course_intro"
                type="button" role="tab" aria-controls="course_intro" aria-selected="true">
                <h4>{{ __('lms.description') }}</h4>
            </button>
            <button class="nav-link" id="course_content-tab" data-bs-toggle="tab" data-bs-target="#course_content"
                type="button" role="tab" aria-controls="course_content" aria-selected="false">
                <h4>{{ __('lms.content') }}</h4>
            </button>
        </div>
    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        <div class="tab-pane fade show active" id="course_intro" role="tabpanel" aria-labelledby="course_intro-tab">
            <div class="course_intro">
                <h3>{{ __('global.introduction') }}</h3>
                <p>{!! app()->getLocale() == 'en' ? $oneCourse->introduction_to_course_en : $oneCourse->introduction_to_course_ar !!}</p>
            </div>
            <div class="course_description">
                <h3>{{ __('global.description') }}</h3>
                <p>{!! app()->getLocale() == 'en' ? $oneCourse->description_en : $oneCourse->description_ar !!}</p>
            </div>
        </div>
        <div class="tab-pane fade" id="course_content" role="tabpanel" aria-labelledby="course_content-tab">
            @if ($user_course)
                <div class="progress_bar">
                    <span class="percentage_progress">
                        {{ $user_course->completion_percentage }}%</span>
                    <div class="first_progress_arrow" style="width: {{ 100 - $user_course->completion_percentage }}%;">
                    </div>
                    @for ($i = 0; $i < $count_attended_zooms + $count_quizes_answered+ $video_scores; $i++)
                        <div class="progress_arrow" style="width: {{ $all_count > 0 ? (1 / $all_count) * 100 : 0 }}%;">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    @endfor
                </div>
            @endif
            @if ($oneCourse->sections()->count())
                <!-- <div class="row mx-0 course-content-header mb-3">
                    <span class="col-6 text-black">{{ __('lms.content') }}</span>
                    <span class="col-6  text-black">{{ __('global.time') }}</span>
                </div> -->
            @endif
            <div id="accordion">
                @if ($oneCourse->sections()->count())
                    @foreach ($oneCourse->sections as $section)
                        <div class="card">
                            <div class="card-header px-0" id="heading-{{ $section->id }}"
                                onclick="collaseTabs('collapse-{{ $section->id }}')">
                                <div class="content_header_text d-flex">
                                    <div>
                                        <span class="type_header_icon">
                                            <i class="fa-solid fa-circle-plus"></i>
                                        </span>
                                        <span class="type_header_icon hide_icon">
                                            <i class="fa-solid fa-circle-minus"></i>
                                        </span>
                                        <span class="m-2">
                                            {{ app()->getLocale() == 'en' ? $section->title_en : $section->title_ar }}
                                        </span>
                                    </div>
                                    {{-- <span>
                                        {{ date('Y-m-d', strtotime($key)) }}
                                    </span> --}}
                                </div>
                            </div>

                            <div id="collapse-{{ $section->id }}"
                                class="{{ $collapse_config ? 'collapsed' : 'collapse' }}"
                                aria-labelledby="heading-{{ $section->id }}" data-parent="#accordion">
                                <div class="card-body">
                                    @foreach ($section->lectures as $lecture)
                                        @if ($lecture->type == 'zoom')
                                            @include('frontend.oneCoursePage.partials.zoom-card', [
                                                'lecture' => $lecture,
                                            ])
                                        @elseif($lecture->type == 'quize')
                                            @include('frontend.oneCoursePage.partials.quize-card', [
                                                'lecture' => $lecture,
                                            ])
                                        @elseif($lecture->type == 'video')
                                            @include('frontend.oneCoursePage.partials.video-card', [
                                                'lecture' => $lecture,
                                            ])
                                        @elseif($lecture->type == 'file')
                                            @include('frontend.oneCoursePage.partials.file-card', [
                                                'lecture' => $lecture,
                                            ])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
