<div class="shared-card card-activities  @if (isset($recorded)) card-activities-recorded @endif"
    onmouseover="show_card_details(this)" onmouseleave="hide_card_details(this)">
    <div class="card-img "  onclick="location.href='{{ url('/' . app()->getLocale() . '/one-courses-new/' . $course->id) }}'">
        <picture>
            <img  src="{{ isset($course->image) ? $course->image->url : '' }}" alt="">
        </picture>
        @if ($course->courseTrack)
            @switch($course->courseTrack->title_en)
                @case('Course')
                    <span
                        class="Course-type-data the_Course">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                @break

                @case('Workshop')
                    <span
                        class="Course-type-data the_Workshop">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                @break

                @case('Conference')
                    <span
                        class="Course-type-data the_Event">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                @break

                @case('live')
                    <span
                        class="Course-type-data the_Event">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
                @break

                @default
                    <span class="Course-type-data defult-Event">{{ $course->courseTrack ? $course->courseTrack->title : '' }}</span>
            @endswitch
        @endif
        <!-- <span class="Course-type-data the_Event">Event</span> -->
        <!-- <span class="Course-type-data the_Workshop">Workshop</span> -->
        <div class="cours-type-live">
            @if ($course->coursePlace)
                <img src="{{ $course->coursePlace ? $course->coursePlace->image_url : '' }}" alt="">
            @endif
        </div>
    </div>
    <div class="card-data"  onclick="location.href='{{ url('/' . app()->getLocale() . '/one-courses-new/' . $course->id) }}'">
        <div class="logo-data_ d-flex justify-content-between ">
            @if (count($course->sponsors))
                <div class="logo-partner">
                    <div class="partner-img_">
                        <picture>
                            <img 
                                src="{{ count($course->sponsors) ? $course->sponsors()->first()->image_url ?? 'https://sna.org.sa/wp-content/uploads/2021/05/logo.png' : '' }}"
                                alt="">
                        </picture>
                    </div>
                </div>
            @else
                {{-- <div class="logo-partner">
                <div class="partner-img_">
                    <picture>
                        <img 
                            src="{{ asset('afaq/logo.png') }}"
                            alt="">
                    </picture>
                </div>
            </div> --}}
            @endif
            <div>

                @if (auth()->check() && count(auth()->user()->memberships) && $course->member_price && $course->has_general_price)
                    <del class="old-price">{{ $course->price }}</del>
                @endif
                @if ($course->today_price)
                    <div class="cost-cours">
                        <span>{{ $course->today_price . ' ' . __('lms.SR') }}</span>
                    </div>
                @elseif($course->has_general_price)
                    @if ($course->price == 0)
                        <div class="cost-cours-free">
                            <span>{{ __('lms.free') }}</span>
                        </div>
                    @else
                        <div class="cost-cours">
                            @if (auth()->check() && count(auth()->user()->memberships) && $course->member_price && $course->has_general_price)
                                <span>{{ $course->member_price . ' ' . __('lms.SR') }}</span>
                                <del>{{ $course->price . ' ' . __('lms.SR') }}</del>
                            @else
                                <span>{{ $course->price . ' ' . __('lms.SR') }}</span>
                            @endif
                        </div>
                    @endif
                @elseif(count($course->prices) && !$course->has_general_price)
                    <div class="cost-cours-Different-Price">
                        <span>{{ __('lms.different_prices') }}</span>
                    </div>
                @else
                    {{-- <div class="cost-cours-free">
                        <span>{{ __('lms.free') }}</span>
                    </div> --}}
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
                @if (isset($spec))
                    <div class="hours-course">
                        @include('frontend.sections.cme_hours')
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="setails-section-card on-right">
        @if (count($course->sponsors))
            <div class="logo-new_">
                <picture>
                    <img 
                        src="{{ count($course->sponsors) ? $course->sponsors()->first()->image_url ?? 'https://sna.org.sa/wp-content/uploads/2021/05/logo.png' : '' }}"
                        alt="">
                </picture>
            </div>
        @else
            {{-- <div class="logo-new_">
                <picture>
                    <img 
                    src="{{ asset('afaq/logo.png') }}"
                    alt="">
                </picture>
            </div> --}}
        @endif
        <div class="all-details_">
            <span class="title-details">
                {{ app()->getLocale() == 'en' ? $course->name_en ?? '' : $course->name_ar ?? ''  }}
            </span>
            <p>
                {!! app()->getLocale() == 'en'
                    ? str_replace(
                        '&nbsp;',
                        ' ',
                        strip_tags($course->introduction_to_course_en ? \Str::limit($course->introduction_to_course_en, 255) : ''),
                    )
                    : str_replace(
                        '&nbsp;',
                        ' ',
                        strip_tags($course->introduction_to_course_ar ? \Str::limit($course->introduction_to_course_ar, 255) : ''),
                    ) !!}
            </p>
            <div class="about-course-details d-flex align-items-center">
                <span>
                    <i class="fa-solid fa-globe"></i>
                    <em>{{ $course->coursePlace ? $course->coursePlace->title : '' }}</em>
                </span>
                <span style="width:10px ;"></span>
                {{-- <span>
                    <i class="fa-solid fa-bars"></i>
                    <em> 8 Lectures</em>
                </span> --}}
                <span style="width:10px ;"></span>
                <span>
                    <i class="fa-solid fa-clock"></i>
                    <em>{{ $course->lecture_hours }} {{ __('lms.hours') }}</em>
                </span>
            </div>
            <div class="wishlist-count d-flex justify-content-between align-items-center">
                {{-- <div class="wish-list">
                    @if(auth()->check() && $course->is_in_wishlist() )
                        <em class="wish-list"  onclick="rm_fav(this)" data-course = "{{$course->id}}" data-lang = "{{ app()->getLocale()}}">
                            <i class="fa-solid fa-heart fav"></i>
                        </em>
                        <span>{{ __('lms.rmFromWishlist') }}</span>
                    @else
                        <em class="wishlist-active"  onclick="add_fav(this)" data-course = "{{$course->id}}" data-lang = "{{ app()->getLocale()}}">
                            <i class="fa-regular fa-heart fav"></i>
                        </em>
                        <span>{{ __('lms.addtowishlist') }}</span>
                    @endif
                </div> --}}
                <div class="countt_">
                    @if ($course->today_price)
                        <span>{{ $course->today_price . ' ' . __('lms.SR') }}</span>
                    @elseif($course->has_general_price)
                        @if ($course->price == 0)
                            <span>{{ __('lms.free') }}</span>
                        @else
                            <span>{{ $course->price . ' ' . __('lms.SR') }}</span>
                        @endif
                    @elseif(count($course->prices) && !$course->has_general_price)
                        <span>{{ __('lms.different_prices') }}</span>
                    @else
                        {{-- <span>{{ __('lms.free') }}</span> --}}
                    @endif
                </div>
            </div>
            <div class="join-btn"  onclick="location.href='{{ url('/' . app()->getLocale() . '/one-courses-new/' . $course->id) }}'">
                <button>
                    {{ __('lms.join') }}
                    <span style="width:20px ; display: inline-block;"></span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>

</div>
<script>


    function add_fav(card){

        let course_id = card.dataset.course;
        let url = '/'+ card.dataset.lang +'/add_fav';
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                "course_id": course_id },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error(error);
            }

        });

    }

    function rm_fav(card){
        let course_id = card.dataset.course;
        let url = '/'+ card.dataset.lang +'/rm_fav';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    "course_id": course_id },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }

            });
    }
</script>
