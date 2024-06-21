<section class="next-afaq-statistics pxa">
    <div class="text-afaq-bs container">
        <strong>{{__('afaq.business_testimonials')}}</strong>
        <div class="slider-afaq-statistics ">
            <div class="slider-icons">
{{--                <div class="sm-in-icon">--}}
{{--                    <img src="{{ asset('afaq\business/imgs/685254b2b1031e08a5239ad1.png') }}" alt="">--}}

{{--                </div>--}}
{{--                <div class="sm-in-icon in-last">--}}
{{--                    <img src="{{ asset('afaq\business/imgs/a1a9368d61e4248658cdf8ee0eeff0b8.png') }}" alt="">--}}

{{--                </div>--}}
            </div>
            <div class="cart-slider afq-statistics">
                <div class="owl-carousel owl-theme afq-statistics-slider ">
                    @foreach($testimonials as $k1=>$v1)
                    <div class="uk-card uk-card-default">
                        <div class="top-icon">
                            <div class="quisten-mark">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                            <div class="star-icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <div class="decription-tag">
                            <p>
                                {{app()->getLocale() == 'en' ? $v1->description_en :$v1->description}}
                            </p>
                            <div class="tetcher-sec">
                                <div class="tech-img">
                                    <img
                                         src="{{asset($v1->image->url  ?? '')}}" alt="">
                                </div>
                                <div class="tech-name">
                                    <h3>{{app()->getLocale() == 'en' ? $v1->title_en :$v1->title}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
{{--            <div class="lst-sm-icon">--}}

{{--                <img src="{{ asset('afaq\business/imgs/9e0fbecb18f6e20b.png') }}" alt="">--}}
{{--            </div>--}}
        </div>
    </div>
</section>

{{--<section class="next-afaq-statistics pxa">--}}
{{--    <div class="text-afaq-bs container">--}}
{{--        <strong>What our partners in success say?</strong>--}}
{{--        <div class="slider-afaq-statistics ">--}}
{{--            <div class="slider-icons">--}}
{{--                <div class="sm-in-icon">--}}

{{--                    <img src="{{ asset('afaq/business/imgs/685254b2b1031e08a5239ad1.png') }}" alt="">--}}
{{--                </div>--}}
{{--                <div class="sm-in-icon in-last">--}}
{{--                    <img src="imgs/a1a9368d61e4248658cdf8ee0eeff0b8.png" alt="">--}}
{{--                    <img src="{{ asset('afaq/business/imgs/a1a9368d61e4248658cdf8ee0eeff0b8.png') }}" alt="">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="cart-slider afq-statistics">--}}
{{--                <div class="owl-carousel owl-theme afq-statistics-slider ">--}}
{{--                    <div class="uk-card uk-card-default">--}}
{{--                        <div class="top-icon">--}}
{{--                            <div class="quisten-mark">--}}
{{--                                <i class="fa-solid fa-quote-left"></i>--}}
{{--                            </div>--}}
{{--                            <div class="star-icon">--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="decription-tag">--}}
{{--                            <p>--}}
{{--                                Whether you’re teaching students or training employees, you need a learning platform that’s as--}}
{{--                                robust as it is intuitive. We provide flexible options for relevant content inside SKILLN as--}}
{{--                                well as supporting activities and resources.--}}
{{--                            </p>--}}
{{--                            <div class="tetcher-sec">--}}
{{--                                <div class="tech-img">--}}
{{--                                    <img src="imgs/MaskgfdsGroup 6.png" alt="">--}}
{{--                                    <img src="{{ asset('afaq/business/imgs/MaskgfdsGroup 6.png') }}" alt="">--}}

{{--                                </div>--}}
{{--                                <div class="tech-name">--}}
{{--                                    <h3>alina gomiz</h3>--}}
{{--                                    <span>dentist</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="uk-card uk-card-default">--}}
{{--                        <div class="top-icon">--}}
{{--                            <div class="quisten-mark">--}}
{{--                                <i class="fa-solid fa-quote-left"></i>--}}
{{--                            </div>--}}
{{--                            <div class="star-icon">--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="decription-tag">--}}
{{--                            <p>--}}
{{--                                Whether you’re teaching students or training employees, you need a learning platform that’s as--}}
{{--                                robust as it is intuitive. We provide flexible options for relevant content inside SKILLN as--}}
{{--                                well as supporting activities and resources.--}}
{{--                            </p>--}}
{{--                            <div class="tetcher-sec">--}}
{{--                                <div class="tech-img">--}}
{{--                                    <img src="{{ asset('afaq\business/imgs/MaskgfdsGroup 6.png') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="tech-name">--}}
{{--                                    <h3>alina gomiz</h3>--}}
{{--                                    <span>dentist</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="uk-card uk-card-default">--}}
{{--                        <div class="top-icon">--}}
{{--                            <div class="quisten-mark">--}}
{{--                                <i class="fa-solid fa-quote-left"></i>--}}
{{--                            </div>--}}
{{--                            <div class="star-icon">--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                                <i class="fa-solid fa-star"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="decription-tag">--}}
{{--                            <p>--}}
{{--                                Whether you’re teaching students or training employees, you need a learning platform that’s as--}}
{{--                                robust as it is intuitive. We provide flexible options for relevant content inside SKILLN as--}}
{{--                                well as supporting activities and resources.--}}
{{--                            </p>--}}
{{--                            <div class="tetcher-sec">--}}
{{--                                <div class="tech-img">--}}
{{--                                    <img src="{{ asset('afaq/business/imgs/MaskgfdsGroup 6.png') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="tech-name">--}}
{{--                                    <h3>alina gomiz</h3>--}}
{{--                                    <span>dentist</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="lst-sm-icon">--}}
{{--                <img src="imgs/9e0fbecb18f6e20b.png" alt="">--}}
{{--                <img src="{{ asset('afaq/business/imgs/9e0fbecb18f6e20b.png') }}" alt="">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
