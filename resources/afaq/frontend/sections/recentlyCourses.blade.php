@if (count($recently_viewed) > 0)
    <section class="Recently-Viewed-Courses">
        <div class="col-12">
            <div class="col-10 offset-1">
                <div class="Recently-Viewed-title">
                    <strong>{{ __('afaq.Recently_Viewed') }}</strong>
                    <!-- <span>Watch any time, register now! </span>
                    <p>Recorded health courses from our authorized partners</p> -->
                </div>
                <div class="d-flex justify-content-end dd">
                    <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                        <span class="show-all"> {{ __('afaq.Show_All') }} </span>
                    </a>
                </div>
                <div class="Recorded-carusel exsption-stutes">
                    <div class="owl-carousel owl-theme Recorded_slider ">
                        @foreach ($recently_viewed as $cour)
                        <div class="Recorded-cards">
                            @include('frontend.partials.topactivity-course-card', [
                                'course' => $cour,
                            ])
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="show-all- ">
                    <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                     <span class="show-all">{{ __('afaq.All_Events') }} </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- *********** end-Recorded-Courses ******************** -->
