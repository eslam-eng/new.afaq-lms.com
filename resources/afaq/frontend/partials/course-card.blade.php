<div class="all-data-courses-lms_">

    <div class="Brought-img"
        onclick="location.href='{{ url('/' . app()->getLocale() . '/one-courses-new/' . $course->id) }}'">
        <img src="{{ isset($course->image) ? $course->image->url : asset('afaq/imgs/AFAQ.png') }}"
            @if (!$course->image) style="object-fit: none;" @endif>
        @if ($course->coursePlace)
            <div class="type-Brought-img">
                <img src="{{ $course->coursePlace ? $course->coursePlace->image_url : '' }}" alt="">
            </div>
        @endif

    </div>
    <div class="Brought-details_">
        @if ($course->courseTrack)
            {{-- <div class="course-track"> {{ $course->courseTrack ? $course->courseTrack->title : '' }} </div> --}}
            <div class="d-flex justify-content-between afaq-All-specialties_">
            @switch($course->courseTrack->title_en)
                @case('Course')
                        <span class="Course-type-data the_Course">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                    @break
                @case('Workshop')
                    <span class="Course-type-data the_Workshop">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                    @break
                @case('Conference')
                    <span class="Course-type-data the_Event">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                    @break
                @case('live')
                    <span class="Course-type-data the_Event">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                    @break
                @default
                <span>{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>

            @endswitch
                <em> {{ $course->courseAvailability ? $course->courseAvailability->title : '' }}</em>
            </div>
        @endif

        <p>
            {{ app()->getLocale() == 'en' ? $course->name_en ?? '' : $course->name_ar ?? '' }}
        </p>
        <div class="details-cours-lms d-flex align-items-center">
            <span>
                <i class="fa-solid fa-clock"></i>
                <em> {{ $course->start_date ? date('D d, M Y', strtotime($course->start_date)) : '' }}</em>
            </span>
            <span>
                <i class="fa-solid fa-bars"></i>

                <em> {{ $course->lecture_hours }} Lecture Hours</em>
            </span>
        </div>
        <div class="wish-list-row d-flex justify-content-between">
            <div class="wish-list">
                <!-- <i class="fa-solid fa-heart"></i> -->
                {{-- <em class="wishlist-active"> --}}
                {{-- <img src="/afaq/imgs/Groupwishlist.png" alt=""> --}}
                {{-- </em> --}}
                {{-- <em class="wishlist-add"> --}}
                {{-- <i class="fa-regular fa-heart"></i> --}}
                {{-- </em> --}}

                {{-- <span>add to wish list</span> --}}
            </div>
            <span class="count-course_">
                @if (auth()->check() && count(auth()->user()->memberships) && $course->member_price && $course->has_general_price)
                    <del class="old-price">{{ $course->price }}</del>
                @endif
            </span>
            @if ($course->today_price)
                <span class="count-course_">
                    {{ $course->today_price . ' ' . __('lms.SR') }}
                </span>
            @elseif($course->has_general_price)
                <span class="count-course_">
                    @if ($course->price == 0)
                        {{ __('lms.free') }}
                    @else
                        {{ $course->price . ' ' . __('lms.SR') }}
                    @endif
                </span>
            @elseif(count($course->prices) && !$course->has_general_price)
                <span class="count-course_">
                    {{ __('lms.different_prices') }}
                </span>
            @else
                {{-- <button class="latestcourse-btn-type price-on-card">
                {{__('lms.free')}}
        </button> --}}
            @endif
        </div>
    </div>
</div>
