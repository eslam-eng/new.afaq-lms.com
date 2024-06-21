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
                    @include('frontend.oneCoursePage.partials.prices')
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
                {{-- <div class="reservation_action w-100 p-0">
                    <button onclick="$('#course_content-tab').click()">
                        {{ __('global.go_course_detials') }} </button>
                </div> --}}


                @if ($oneCourse->lectures()->count() > 0)
                    <div class="reservation_action w-100 p-0">
                        <a class="btn btn-primary"
                            href="{{ route('one-course-content', ['locale' => app()->getLocale(), 'course_id' => $oneCourse->id, 'lecture_id' => $oneCourse->lectures()->first()->id, 'section_id' => $oneCourse->lectures()->first()->course_section_id]) }}">
                            {{ __('global.go_course_detials') }} </a>
                    </div>
                @endif
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
                        <img src="{{ $instructor->image ? $instructor->image->url : '' }}" alt="instructor image">
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
                        <img src="{{ $sponsor->image_url ?? '' }}" alt="{{ $sponsor->title }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
