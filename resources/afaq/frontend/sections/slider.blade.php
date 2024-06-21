<style>
    /* .bunner-home-page .owl-item .item {
    width: 80vw;
    text-align: center;
    margin: 0 20px;
}
.bunner-home-page .owl-item.center.active {
    position: relative;
    z-index: 9;
    opacity: 1;
}
.bunner-home-page .owl-item.active {
opacity: .3;
} */
</style>
<section class="slider elementor-section ">
    <div class="col-12">
        <div class="lg-bunner">
            <div class="bunner-home-page ">
                <div class="owl-carousel owl-theme bunner_slider">

                    @foreach ($sliders as $k1 => $v1)
                        <div class="item">
                            <a href="{{ app()->getLocale() == 'en' ? $v1->link_en ?? '' : $v1->link_ar ?? '' }}"
                                target="_blank">
                                <img 
                                    src="{{ asset(app()->getLocale() == 'en' ? $v1->image->url ?? '' : $v1->image_ar->url ?? '') }}"
                                    alt="First slide">

                                <div class="RegisterNow slider-btn ">
                                    <a href="{{ app()->getLocale() == 'en' ? $v1->link_en ?? '' : $v1->link_ar ?? '' }}"
                                        target="_blank">
                                        <span>
                                            <strong>{{ __('lms.register_now') }}</strong>
                                            <em></em>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>

                                </div>
                            </a>

                        </div>
                    @endforeach
                    {{--            <div class="item"> --}}
                    {{--                <img  src="/afaq/imgs/rtl-slide.jpg" alt=""> --}}
                    {{--                <div class="RegisterNow container"> --}}
                    {{--                    <a href="#"> --}}
                    {{--                <span> --}}
                    {{--                  <strong>Register Now</strong> --}}
                    {{--                  <em></em> --}}
                    {{--                  <i class="fa-solid fa-arrow-right"></i> --}}
                    {{--                </span> --}}
                    {{--                    </a> --}}
                    {{--                </div> --}}
                    {{--            </div> --}}
                    {{--            <div class="item"> --}}
                    {{--                <img  src="/afaq/imgs/course_image_106-scaled-272x161.jpg" alt=""> --}}
                    {{--                <div class="RegisterNow container"> --}}
                    {{--                    <a href="#"> --}}
                    {{--                <span> --}}
                    {{--                  <strong>Register Now</strong> --}}
                    {{--                  <em></em> --}}
                    {{--                  <i class="fa-solid fa-arrow-right"></i> --}}
                    {{--                </span> --}}
                    {{--                    </a> --}}
                    {{--                </div> --}}
                    {{--            </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- *********** end-slider ******************** -->
