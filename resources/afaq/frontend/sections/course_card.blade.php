<style>
    .cme-hours>.cme-top {
        width: 100px !important;
    }

    .cme-hours>.cme-top>.stroke-double {
        font-size: 2rem;
        width: auto;
        bottom: 0.7rem;
        right: 8px;
    }

    .specifications {
        display: none;
    }


    /* .section-activities-cards {
        display: block;
    } */

    /* .section-filtter-activities {
        flex-wrap: wrap;
    } */
    .swiper {
        width: 83%;
        height: 100%;
        overflow: hidden !important;
    }

    .rtl .swiper {
        width: 76%;
    }
    .swiper-wrapper {
    display: flex !important;
}
    .swiper-backface-hidden .swiper-slide:first-child {
        margin: 0 10px;
    }

    .swiper-slide {
        text-align: center;
        /* font-size: 18px; */
        /* background: #fff; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide,
    swiper-slide {
        width: auto !important;
    }

    .btn-filter-activities {
        width: max-content;
    }

    /* .swiper-wrapper{
        align-content: center
    } */
    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.css" integrity="sha512-zar81H5lVN36QFsq/da1hxpOLODXK4/oFwBGOFrvdWX6SBe3NWriWTQS6YQDVfW5fDeb2Vry41YQCELOe8cHww==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="">
        <div class="col-10 offset-1">
            <h1>{{ __('afaq.top_activities') }}</h1>
            <div class="filtter-activities">
                <em>{{ __('afaq.Filter_Specialties') }}</em>
                {{-- <div class="section-filtter-activities ">
                    @foreach ($specialties as $specialty)
                        <div class="btn-filter-activities {{ $loop->index == 0 ? 'active' : '' }} filter my-1"
                data-filter=".spec-{{ $specialty->id }}">
                <span>{{$specialty->name }}</span>
            </div>
            @endforeach
        </div> --}}
                <div class="d-flex align-items-center  filtter-all-evnt">
                    <div class="btn-filter-activities active all-btn-" data-vcontainer="spec-container-all"
                        onclick="containerControl(this,'all')">
                        <span>{{ __('afaq.all') }}</span>
                    </div>

                    <div class="swiper mySwiper slider-filtter-activities">
                        <div class="swiper-wrapper">
                            @foreach ($specialties as $spec)
                                <div class="swiper-slide">
                                    <div class="btn-filter-activities"
                                        data-vcontainer="spec-container-{{ $spec->id }}"
                                        onclick="containerControl(this,'{{ $spec->id }}')">
                                        <span>{{ $spec->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="swiper-pagination"></div> --}}
                    </div>
                    <div class="d-flex justify-content-end dd">
                        <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                            <span class="show-all">{{ __('afaq.All_Events') }} </span>
                        </a>
                    </div>
                </div>
                <!-- ************************************** -->
                {{-- <div class="section-activities-cards" id="detailscardactivities"> --}}
                <div class="web-view">
                    <div class="spec-container-all section-activities-cards v-containers ">
                        @php
                            $courses_array = [];
                        @endphp
                        @foreach ($specialties as $spec)
                            @foreach ($spec->courses as $cour)
                                @if (!in_array($cour->id, $courses_array))
                                    @include('frontend.partials.topactivity-course-card', [
                                        'course' => $cour,
                                        'spec' => $spec,
                                    ])

                                    @php
                                        array_push($courses_array, $cour->id);
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                    @foreach ($specialties as $special)
                        <div class="spec-container-{{ $special->id }} specifications v-containers">
                            @foreach ($special->courses as $course)
                                @include('frontend.partials.topactivity-course-card', [
                                    'course' => $course,
                                    'spec' => $special,
                                ])
                                @if ($loop->index == 2)
                                @break
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="mob-view">
                <div class="spec-container-all section-activities-cards v-containers ">
                    <div class="slider-section-activities owl-carousel owl-theme">
                        @php
                            $courses_array = [];
                        @endphp
                        @foreach ($specialties as $spec)
                            @foreach ($spec->courses as $cour)
                                @if (!in_array($cour->id, $courses_array))
                                    @include('frontend.partials.topactivity-course-card', [
                                        'course' => $cour,
                                        'spec' => $spec,
                                    ])

                                    @php
                                        array_push($courses_array, $cour->id);
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                </div>
                @foreach ($specialties as $special)
                <div class="spec-container-{{ $special->id }} specifications v-containers">
                    <div class="nex-slider filtr-slider owl-carousel owl-theme">
                            @foreach ($special->courses as $course)
                                @include('frontend.partials.topactivity-course-card', [
                                    'course' => $course,
                                    'spec' => $special,
                                ])
                                @if ($loop->index == 2)
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
        <div class="show-all- ">
            <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                <span class="show-all">{{ __('afaq.All_Events') }} </span>
            </a>
        </div>

    </div>
</div>
</section>
<!-- *********** end-Top-activities ******************** -->

@section('scripts')
@parent
<script>
    function containerControl(ele, id) {
        if (id == 'all') {
            $('.btn-filter-activities').removeClass('active')
        } else {
            $('.all-btn-').removeClass('active');
        }
        var container = $(ele).attr('data-vcontainer');
        $('.v-containers').each(function(index, value) {
            if (!$(value).hasClass(`${container}`)) {
                if ($(value).hasClass('section-activities-cards')) {
                    $(value).removeClass('section-activities-cards')
                    $(value).addClass('specifications')
                }
            }
        });
        $(`.${container}`).addClass('section-activities-cards')
        $(`.${container}`).removeClass('specifications')
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.min.js" integrity="sha512-+z66PuMP/eeemN2MgRhPvI3G15FOBbsp5NcCJBojg6dZBEFL0Zoi0PEGkhjubEcQF7N1EpTX15LZvfuw+Ej95Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        //   breakpoints: {
        //     640: {
        //       slidesPerView: 2,
        //       spaceBetween: 20,
        //     },
        //     768: {
        //       slidesPerView: 2,
        //       spaceBetween: 20,
        //     },
        //     1024: {
        //       slidesPerView: 3,
        //       spaceBetween: 30,
        //     },
        //   },
    });
</script>
@endsection
