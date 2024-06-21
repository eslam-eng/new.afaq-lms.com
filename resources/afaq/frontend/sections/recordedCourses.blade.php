@php
    $recorded = collect($courses)->filter(function ($item) {
    return $item->coursePlace ? $item->coursePlace->slug == 'recorded' : null;
    });
@endphp
@if(count($recorded))
<section class="Recorded-Courses ">
    <div class="col-12">
        <div class="col-10 offset-1">
            <div class="Recorded-Courses-title">
                <strong>{{__('afaq.Recorded_Courses')}}</strong>
                <span>{{__('afaq.Watch_anytime')}} </span>
                <p>{{__('afaq.Recorded_health')}}</p>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                    <span class="show-all"> {{__('afaq.Show_All')}} </span>
                </a>
            </div>
            <div class="Recorded-carusel exsption-stutes">
                <div class="owl-carousel owl-theme Recorded_slider ">
                    @foreach ($recorded as $cour)
                        @if ($cour->coursePlace && $cour->coursePlace->slug == 'recorded')
                                @include('frontend.partials.topactivity-course-card', [
                                    'course' => $cour,
                                    'recorded' => 1,
                                ])
                        @endif
                    @endforeach
                    {{-- <div class="card-activities-recorded">
                            <div class="card-img">
                                <picture>
                                    <img src="/afaq/imgs/MaskactiveGroup 23.png" alt="">
                                </picture>
                                <span class="Course-type-data the_Course">Course</span>
                                <!-- <span class="Course-type-data the_Event">Event</span> -->
                                <!-- <span class="Course-type-data the_Workshop">Workshop</span> -->
                                <div class="cours-type-live">
                                    <img src="/afaq/imgs/Live.png" alt="">
                                </div>
                            </div>
                            <div class="card-data">
                                <div class="logo-data_ d-flex justify-content-between ">
                                    <div class="logo-partner">
                                        <div class="partner-img_">
                                            <picture>
                                                <img src="/afaq//afaq/imgs/NoPath - Copy.png" alt="">
                                            </picture>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="cost-cours">
                                            <span>350 SAR</span>
                                            <del>350 SAR</del>
                                        </div>
                                        <!-- <div class="cost-cours-free">
                                          <span>Free</span>
                                        </div> -->
                                        <!-- <div class="cost-cours-Different-Price">
                                          <span>Different Price</span>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="details_activities">
                                    <p>ICD 10 Australian - Upgrading From
                                        6th Edition To 10th Edition</p>
                                    <div class="activities_date">
                                        <span>
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <em>11 September 2022</em>
                                        </span>
                                    </div>
                                    <div class="type-course_ d-flex justify-content-between">
                                        <div class="online-coutse">
                                            <span>
                                                <i class="fa-solid fa-globe"></i>
                                                <em>Online</em>
                                            </span>
                                            <span class="by-name">
                                                <em>By AFAQ</em>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- *********** end-Recorded-Courses ******************** -->
