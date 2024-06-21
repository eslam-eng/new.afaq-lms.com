<div class="latestcourse-card px-0 mx-3">
    <div onclick="window.open('{{url('/'.app()->getLocale().'/one-courses/'.$course->id)}}')"
    onmouseover="show_card_details(this)" onmouseleave="hide_card_details(this)">
        <div class="latestcourse-card-data">
            <div class="latestcourse-card-img">
                @if($course->courseTrack)
                    <div class="course-track"> {{ $course->courseTrack ? $course->courseTrack->title : '' }} </div>
                @endif
                @if($course->coursePlace)
                    <img class="venue-type" src="{{ $course->coursePlace ? $course->coursePlace->image_url :'' }}" alt="">
                @endif
                    <img class="course-image" src="{{ isset($course->image) ? $course->image->url :'https://sna.org.sa/wp-content/uploads/2021/05/logo.png'}}"  @if(!$course->image) style="object-fit: none;" @endif>

                @if(count($course->sponsors))
                    <img class="provider-logo" src="{{ count($course->sponsors) ? $course->sponsors()->first()->image_url ?? 'https://sna.org.sa/wp-content/uploads/2021/05/logo.png' : ''}}" alt="">
                @endif
                @include('frontend.sections.cme_hours')

            </div>
            <div class="latestcourse-card-all-details">
                <span>
                    {{app()->getLocale()=='en' ? $course->name_en ?? '' : $course->name_ar ?? ''}}
                </span>
            </div>
            <div class="latestcourse-card-time ">
                <div>
                <p>
                    {{ $course->courseAvailability ? $course->courseAvailability->title : '' }}
                </p>
                    <div class="latestcourse-date">
                    <i class="fa-regular fa-calendar"></i>
                        {{$course->start_date ? date('D d, M Y' , strtotime($course->start_date)) : ''}}
                    </div>
                </div>

                <div class="the-latestcourse-btn-type">
                    @if(auth()->check() && count(auth()->user()->memberships) && $course->member_price && $course->has_general_price)
                        <del class="old-price">{{ $course->price }}</del>
                    @endif
                    @if($course->today_price)
                    <button class="latestcourse-btn-type price-on-card">
                        {{ $course->today_price ." ". __('lms.SR') }}
                    </button>
                    @elseif($course->has_general_price)
                    <button class="latestcourse-btn-type price-on-card">
                        @if($course->price == 0)
                            {{__('lms.free')}}
                        @else
                            {{ $course->price ." ". __('lms.SR') }}
                        @endif
                    </button>
                    @elseif(count($course->prices) && !$course->has_general_price)
                    <button class="latestcourse-btn-type price-on-card">
                        {{__('lms.different_prices')}}
                    </button>
                    @else
                    {{-- <button class="latestcourse-btn-type price-on-card">
                        {{__('lms.free')}}
                    </button> --}}
                    @endif

                </div>

            </div>
            <div class="latestcourse-card-hover">
                <div class="hover-top d-flex flex-row">
                    @if(count($course->sponsors))
                        <img class="provider-logo" src="{{ count($course->sponsors) ? $course->sponsors()->first()->image_url : ''}}" alt="">
                    @endif
                    <img class="venue-type" src="{{ $course->coursePlace ? $course->coursePlace->image_url: '' }}" alt="">
                </div>
                <br>

                <h2>{{app()->getLocale()=='en' ? $course->name_en ?? '' : $course->name_ar ?? ''}}</h2>
                <p>{!!  app()->getLocale()=='en' ? str_replace('&nbsp;',' ',strip_tags(($course->introduction_to_course_en ? \Str::limit($course->introduction_to_course_en,255) : '')))  : str_replace('&nbsp;',' ',strip_tags(($course->introduction_to_course_ar ? \Str::limit($course->introduction_to_course_ar,255) : ''))) !!}</p>
                <ul class="target-customers d-flex flex-row">
                    @foreach ($course->course_target as $target )
                    <li>{{app()->getLocale()=='en' ? $target->name_en  : $target->name_ar}}</li>
                    <div style="width: 10px;"></div>
                    @endforeach

                </ul>
                <ul class="course-info d-flex flex-row">
                    <li>
                        <span class="material-symbols-outlined">
                            language
                        </span>
                        <div style="width: 5px;"></div>
                        <span>{{ $course->coursePlace ? $course->coursePlace->title : '' }}</span>
                    </li>
                    <li>
                        <span class="material-symbols-outlined">
                            list
                        </span>
                        <div style="width: 5px;"></div>
                        <span>{{ __('cruds.lecture.title_singular') }}</span>
                    </li>
                    <li>
                        <span class="material-symbols-outlined">
                            schedule
                        </span>
                        <div style="width: 5px;"></div>
                        <span> {{ $course->lecture_hours }} {{ __('lms.hours') }}</span>
                    </li>
                </ul>
                <button class="join-now" onclick="{{url('/'.app()->getLocale().'/one-courses/'.$course->id)}}">
                    <span>{{ __('frontend.join') }}</span>
                    <div style="width: 10px; display: inline-block;"></div>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <!-- @if($course->course_place == 'onsite')
            <small>{{$course->location ?? ''}}</small>
            @endif -->
        </div>
    </div>
    @if(Route::currentRouteName() == 'admin.my_courses')
    @if (strtotime($course->start_date) > strtotime(now()))
        <button onclick='item_data("{{ $course->id }}","{{ $course->payment_details_accepted->payment_id ?? null }}")' class="cancel-btn-sna">{{ __('global.cancel_booking') }}</button>
    @else
        <div class='go_content_or_cancel_course'>
            <button class="goToContent">{{ __('global.go_to_content') }}</button>

        </div>
    @endif
    @endif
</div>
