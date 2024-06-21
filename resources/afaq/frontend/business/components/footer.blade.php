<footer class="footer-sec pxa">
    <section class="footer-page">
        <div class="container">
            <div class="logo- f-on-mob">
                <div class="fir-logo">
                    <img src="{{ asset('/afaq/imgs/Logo-Type-1v-2.png') }}" alt="">
                </div>
            </div>
            <div class="footer-details">

                @foreach ($ContentCategory as $content_category)
                    @if($content_category->type =='Business')
                <div class="footer-conatnet">
                    <strong>{{ app()->getLocale() == 'en' ? $content_category->name : $content_category->name_ar }}</strong>
                    <ul>
                        @foreach ($content_category->contents as $content)
                            @if($content->title == 'FAQs')
                        <li><a href="{{ url('/' . app()->getLocale() . '/faq?type=business') }}">
                                {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                            </a> </li>
                            @elseif($content->title == 'Blogs')
                                <li>
                                    <a href="{{ url('/' . app()->getLocale() . '/all-blogs?type=business') }}">
                                        {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                    </a>
                                </li>
                                {{--                                            {{dd($content->toArray())}}--}}
                            @elseif($content->title == 'Courses & Events')
                                <li>
                                    <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                                        {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                    </a>
                                </li>
                            @elseif($content->title == 'Join Us')
                                <li>
                                    <a href="{{ url('/' . app()->getLocale() . '/join-us') }}">
                                        {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                    </a>
                                </li>
                            @elseif($content->title =='about_business')
                                <li>
                                    <a href="{{ url('/' . app()->getLocale() . '/business-content/' . 'about_business') }}">
                                        {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                    </a>
                                </li>
                            @elseif($content->title == 'Contact Us')
                            <li>
                                <a href="{{ url(app()->getLocale() . '/business-contact-us') }}">
                                    {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                </a>
                            </li>

                            @else
                                <li>
                                    <a href="{{ url('/' . app()->getLocale() . '/business-content/' . $content->title) }}">
                                        {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                    </a>
                                </li>

                            @endif

                        @endforeach
                    </ul>
                </div>
                    @endif
                        @if($loop->index == 2)
                        @break

                    @endif
                @endforeach
                <div class="footer-conatnet footer-connect f-on-web">
                    <div class="connect-details">
                        <div class="connect-img">
                            <img src="{{ asset('afaq\business/imgs/headset-regulahjr.svg') }}" alt="">

                        </div>
                        <div class="conetct-details-num">
                            <span>{{__('afaq.hotline')}}</span>
                            <a href="tel:{{ config('app.telephone') }}" >
                                {{ config('app.telephone') }}
                            </a>
                        </div>
                    </div>
                    <form method='post' action="{{ url(app()->getLocale() . '/business_news/save') }}">
                        @csrf
                        <div class="input-notify">
                            <input type="email" name="email"  placeholder="{{ __('lms.your_email') }}" >
                            <button class="col-md-3 ">{{ __('afaq.Notify') }}</button>
                        </div>
                    </form>
{{--                    <div class="input-notify">--}}
{{--                        <input type="text" name="" id="" placeholder="keep up with the latest and events">--}}
{{--                        <button>notofy me</button>--}}
{{--                        --}}
{{--                    </div>--}}
                    <div class="paymet-way">
                        <img src="{{ asset('afaq\business/imgs/payment@2x.png') }}" alt="">

                    </div>
                </div>
            </div>
            <div class="f-on-mob ">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form method='post' action="{{ url(app()->getLocale() . '/newsletters/save') }}">
                    @csrf
                    <div class="input-notify">
                        {{--                                <input type="text" placeholder="{{__('afaq.Notify_holder')}}">--}}
                        <input type="email" required name="email" placeholder="{{ __('lms.your_email') }}" >
                        <button>{{__('afaq.Notify')}}</button>
                    </div>
                </form>



            </div>
            <div class="f-on-mob">
                <div class="footer-connect-details">
                    <div class="connect-details">
                        <div class="connect-img">

                            <img src="{{ asset('afaq\business/imgs/headset-regulahjr.svg') }}" alt="">

                        </div>
                        <div class="conetct-details-num">
                            <span>{{__('afaq.hotline')}}</span>
                            <a href="tel:{{ config('app.telephone') }}" >
                                {{ config('app.telephone') }}
                            </a>
                        </div>
                    </div>
                    <div class="footer-payment-way">
                    <img src="{{ asset('afaq\business/imgs/payment@2x.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="f-on-web">
                <div class="footer-data ">
                    <div class="footer-logo">
                        <img src="{{ asset('afaq\business/imgs/AFAQsm.png') }}" alt="">

                    </div>
                    <div class="afaq-apps ">
                        <div class="get-app-afaq">
                            <div class="get-app-img">
                                <a href="https://apps.apple.com/eg/app/afaq-%D8%A2%D9%81%D8%A7%D9%82/id6444857032" target="_blank">
                                <img src="{{ asset('afaq\business/imgs/Group loi41627.png') }}" alt="">
                                </a>
                            </div>
                            <div class="get-app-img">
                                <a href="https://play.google.com/store/apps/details?id=com.afaq.application&pli=1" target="_blank">

                                    <img src="{{ asset('afaq\business/imgs/Group 41626lkj.png') }}" alt="">

                                </a>
                            </div>
                            <div class="get-app-img">
                                <a href="#" target="_blank">
                                    <img src="{{ asset('afaq\business/imgs/Groghup 41628.png') }}" alt="">

                                </a>
                            </div>
                        </div>
                        <div class="copt-write-text">
                            <span>{{__('afaq.Copyrights_Afaq')}}</span>
                        </div>
                    </div>
                    <div class=" ">
                        <div class="afaq-social">
                            <span> <a href="https://www.facebook.com/AfaqLms"> <i class="fa-brands fa-facebook-f"></i></a></span>
                            <span> <a href="https://twitter.com/AfaqLms"><i class="fa-brands fa-twitter"></i></a></span>
                            <span><a href="https://www.instagram.com/AfaqLms/"><i class="fa-brands fa-instagram"></i></a></span>
                            <span><a href="https://www.linkedin.com/company/%D9%85%D8%B1%D9%83%D8%B2-%D8%A7%D9%81%D8%A7%D9%82-%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8-%D8%A7%D9%84%D8%B5%D8%AD%D9%8A/"><i class="fa-brands fa-linkedin-in"></i></a></span>
                            <!-- <span><i class="fa-brands fa-youtube"></i></span> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="f-on-mob">
                <div class="seical-afaq-bsn">
                    <div class="afaq-social">
                        <span> <a href="https://www.facebook.com/AfaqLms"> <i class="fa-brands fa-facebook-f"></i></a></span>
                        <span> <a href="https://twitter.com/AfaqLms"><i class="fa-brands fa-twitter"></i></a></span>
                        <span><a href="https://www.instagram.com/AfaqLms/"><i class="fa-brands fa-instagram"></i></a></span>
                        <span><a href="https://www.linkedin.com/company/%D9%85%D8%B1%D9%83%D8%B2-%D8%A7%D9%81%D8%A7%D9%82-%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8-%D8%A7%D9%84%D8%B5%D8%AD%D9%8A/"><i class="fa-brands fa-linkedin-in"></i></a></span>
                        <!-- <span><i class="fa-brands fa-youtube"></i></span> -->
                    </div>
                    <div class="get-app-afaq">
                        <div class="get-app-img">
                            <a href="https://apps.apple.com/eg/app/afaq-%D8%A2%D9%81%D8%A7%D9%82/id6444857032" target="_blank">

                                <img src="{{ asset('afaq\business/imgs/Group loi41627.png') }}" alt="">

                            </a>
                        </div>
                        <div class="get-app-img">
                            <a href="https://play.google.com/store/apps/details?id=com.afaq.application&pli=1" target="_blank">

                                <img src="{{ asset('afaq\business/imgs/Group 41626lkj.png') }}" alt="">

                            </a>
                        </div>
                        <div class="get-app-img">
                            <a href="#" target="_blank">

                                <img src="{{ asset('afaq\business/imgs/Groghup 41628.png') }}" alt="">

                            </a>
                        </div>
                    </div>
                </div>
                <div class="get-copy-write">
                    <div class="copt-write-text">
                        <span>Copyright @2023 All Rights Reserved by AFAQ</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
