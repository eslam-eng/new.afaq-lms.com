<section class="our-Courses-for-your-career ">
    <div class="details-for-your-career">
        <div class="Coursesfor-your-career d-flex">
            <div class="Coursesfor-left-side">
                <div class="details_Coursesfor">
                    <span>{{__('afaq.We_provide')}}</span>
                    <strong>{{__('afaq.Courses_career')}}</strong>
                </div>
                <div class="all-data-in-Courses d-flex flex-wrap align-items-center">
                    <div class="details_Courses_">
                        <div class="Courses_icon">
                            <img src="/afaq/imgs/certificate-outline-badged.png" alt="">
                        </div>
                        <span>
                            {{__('afaq.Certificate_attendanc')}}
                </span>
                    </div>
                    <div class="details_Courses_">
                        <div class="Courses_icon">
                            <img src="/afaq/imgs/noun_quality_1078235jjh.png" alt="">
                        </div>
                        <span>
             {{__('afaq.seat_reservation')}}
                </span>
                    </div>
                    <div class="details_Courses_">
                        <div class="Courses_icon">
                            <img src="/afaq/imgs/noun_quality_1078235.png" alt="">
                        </div>
                        <span>
                             {{__('afaq.CME_Hours')}}

                </span>
                    </div>
                    <div class="details_Courses_">
                        <div class="Courses_icon">
                            <img src="/afaq/imgs/noun_protect_2632608.png" alt="">
                        </div>
                        <span>
                             {{__('afaq.Secure_Payment')}}

                </span>
                    </div>
                    <div class="details_Courses_">
                        <div class="Courses_icon">
                            <img src="/afaq/imgs/Layerff3.png" alt="">
                        </div>
                        <span>
                             {{__('afaq.Various_courses')}}

                </span>
                    </div>
                    <div class="details_Courses_">
                        <div class="Courses_icon">
                            <img src="/afaq/imgs/easel.png" alt="">
                        </div>
                        <span>
                            {{__('afaq.Ease_use')}}

                </span>
                    </div>
                </div>
                <div class="goto-registeration">
                    <div class="RegisterNow container ">
                        @if (!auth()->check())
                        <a href="{{ url(app()->getLocale() . '/register') }}">

                  <span>
                    <strong> {{__('afaq.register_now')}}</strong>
                    <em></em>
                    <i class="fa-solid fa-arrow-right"></i>
                  </span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="Coursesfor-right-side">
                <div class="img-part_">
                    <img src="/afaq/imgs/Website-Display-v2.png" alt="">
                </div>
                <div class="check-mark_">
                    <img src="/afaq/imgs/tyhbf.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- *********** end-Courses-for-your-career ******************** -->
