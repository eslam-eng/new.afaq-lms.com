<div class="card-activities ">
    <div class="card-img" onclick="location.href='{{ url('/' . app()->getLocale() . '/one-courses-new/' . $course->id) }}'">
        <picture>
            <img  src="{{ isset($course->image) ? $course->image->url : '' }}" alt="">
        </picture>
        <!-- <span class="Course-type-data the_Course">Course</span> -->
        @if ($course->courseTrack)
            <span class="Course-type-data the_Event"> {{ $course->courseTrack ? $course->courseTrack->title : '' }}
            </span>
        @endif
        <!-- <span class="Course-type-data the_Workshop">Workshop</span> -->
        @if ($course->coursePlace)
            <div class="cours-type-live">
                <img src="{{ $course->coursePlace ? $course->coursePlace->image_url : '' }}" alt="">
            </div>
        @endif

    </div>
    <div class="card-data">
        <div class="logo-data_ d-flex justify-content-between ">
            @if (count($course->sponsors))
                <div class="logo-partner">
                    <div class="partner-img_">
                        <picture>
                            <img 
                                src="{{ count($course->sponsors) ? $course->sponsors()->first()->image_url ?? '' : '' }}"
                                alt="">
                        </picture>
                    </div>
                </div>
            @endif

            <div>

                @if (auth()->check() && count(auth()->user()->memberships) && $course->member_price && $course->has_general_price)
                    <div class="cost-cours">
                        <span> {{ $course->today_price . ' ' . __('lms.SR') }}</span>
                        <del>{{ $course->price . ' ' . __('lms.SR') }}</del>
                    </div>
                @elseif ($course->today_price)
                    <div class="cost-cours">
                        <span> {{ $course->today_price . ' ' . __('lms.SR') }}</span>
                    </div>
                @elseif($course->has_general_price)
                    <span class="count-course_">
                        @if ($course->price == 0)
                            <div class="cost-cours-free">
                                <span>{{ __('lms.free') }}</span>
                            </div>
                        @else
                            <div class="cost-cours">
                                <span> {{ $course->price . ' ' . __('lms.SR') }}</span>
                            </div>
                        @endif
                    </span>
                @elseif(count($course->prices) && !$course->has_general_price)
                    <div class="cost-cours-Different-Price">
                        <span>
                            {{ __('lms.different_prices') }}
                        </span>
                    </div>
                @else
                @endif
            </div>
        </div>
        <div class="details_activities">
            <p>{{ app()->getLocale() == 'en' ? $course->name_en ?? '' : $course->name_ar ?? '' }}</p>
            <div class="activities_date">
                <span>
                    <i class="fa-solid fa-calendar-days"></i>
                    <em>{{ $course->start_date ? date('D d, M Y', strtotime($course->start_date)) : '' }}</em>
                </span>
            </div>
            <div class="type-course_ d-flex justify-content-between">
                <div class="online-coutse">
                    <span>
                        <i class="fa-solid fa-globe"></i>
                        <em>{{ $course->coursePlace ? $course->coursePlace->title : '' }}</em>
                    </span>
                    <span class="by-name">
                        <em>By AFAQ</em>
                    </span>
                </div>
                <div class="hours-course">
                    <div class="cme-hours">
                        <div class="cme-top d-flex">
                            <img  src="{{ asset('afaq/imgs/Groupkkkk.png') }}" alt="cme">
                            <h2 class="stroke-double" title="{{ $course->lecture_hours }}"> {{ $course->lecture_hours }}</h2>
                            <p>CME HOURS</p>
                        </div>
                        <div class="cme-bottom">
                            <p>{{ $course->accreditation_number }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
