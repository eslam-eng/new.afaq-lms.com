<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{asset('js/pushNotification.js')}}" ></script>
<!-- ******************** start footer ********************  -->
<footer class="footer {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="footer-section">
        <div class="col-12">
            <div class="col-10 offset-1">
                <div class="flex_footer_section row pt3">
                    <div class="col-xl-3 col-lg-3 col-md-6 data-foot">
                        <div class="all-logo-">
                            <div class="fir-logo">
                                <img src="{{ asset('/afaq/imgs/Logo-Type-1v-2.png') }}" alt="">
                            </div>
                            <div class="all-logo d-flex align-items-center">
                                <div class="two-logo">
                                    <img src="{{ asset('/afaq/imgs/VectornewSmart Object.png') }}" alt="">
                                </div>
                                <div class="third-logo">
                                    <img src="{{ asset('/afaq/imgs/VectoroldSmart Object.png') }}" alt="">
                                </div>
                            </div>
                            <div class="payment-img-lms">
                                {{-- <img src="{{ asset('/afaq/imgs/Payment-Icons-2 (1)_prev_ui.png') }}" alt=""> --}}
                                <img src="{{ asset('/afaq/imgs/payment@2x.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    @foreach ($content_categories as $content_category)
                        <div class="col-xl-2 data-foot col-lg-2 col-md-6 footer-sec">
                            <div class="afaq-section">
                                <span>{{ app()->getLocale() == 'en' ? $content_category->name : $content_category->name_ar }}</span>
                                <ul>
                                    @foreach ($content_category->contents as $content)
                                        @if($content->title == 'FAQs')
                                        <li>
                                            <a href="{{ url('/' . app()->getLocale() . '/faq') }}">
                                                {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                            </a>
                                        </li>
                                        @elseif($content->title == 'Blogs')
                                        <li>
                                            <a href="{{ url('/' . app()->getLocale() . '/all-blogs') }}">
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
                                        @else
                                        <li>
                                            <a href="{{ url('/' . app()->getLocale() . '/content/' . $content->title) }}">
                                                {{ app()->getLocale() == 'en' ? $content->title : $content->title_ar }}
                                            </a>
                                        </li>

                                        @endif

                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        @if($loop->index == 2)
                            @break
                        @endif
                    @endforeach
                    <div class="col-xl-3 data-foot col-lg-2 col-md-6 footer-sec">
                        <!-- <div class="afaq-section">
                            <span>Accredited By Medical Articles</span>
                            <ul>
                                <li>Saudi Commission for Health Specialties</li>
                                <li>National E-Learning Center</li>
                                <li>National eLearning Center</li>
                            </ul>
                        </div> -->
                        <div class="app-btn-dawn">
                            <span>{{__('afaq.Our_app')}}</span>
                            <div class="apps-dawnload_">
                                <a href="https://apps.apple.com/eg/app/afaq-%D8%A2%D9%81%D8%A7%D9%82/id6444857032" target="_blank">
                                    <img src="{{ asset('/afaq/imgs/Group loi41627.png') }}" alt="">
                                </a>
                            </div>
                            <div class="apps-dawnload_">
                                <a href="https://play.google.com/store/apps/details?id=com.afaq.application&pli=1" target="_blank">

                                    <img src="{{ asset('/afaq/imgs/Group 41626lkj.png') }}" alt="">
                                </a>
                            </div>
                            <div class="apps-dawnload_">
                                <a href="">
                                    <img src="{{ asset('/afaq/imgs/Groghup 41628.png') }}" alt="">
                                </a>
                            </div>
                            <div class="hotlone-num">
                                <bdi>
                                    <em><i class="fa-solid fa-phone"></i></em>
                                    <span>
                                        <a href="tel:{{ config('app.telephone') }}" >
                                            {{ config('app.telephone') }}
                                        </a>
                                    </span>
                                </bdi>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-img-lms small-screen">
                                {{-- <img src="{{ asset('/afaq/imgs/Payment-Icons-2 (1)_prev_ui.png') }}" alt=""> --}}
                                <img src="{{ asset('/afaq/imgs/Group 859685.png') }}" alt="">
                            </div>
                <div class="row pt3 align-items-center text-center">
                    <div class="col-xl-4 col-lg-4 col-md-12 on-larg-screen">
                        <div class="copy-right">
                            <span>{{__('afaq.Copyrights_Afaq')}}</span>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form method='post' action="{{ url(app()->getLocale() . '/newsletters/save') }}">
                            @csrf
                            <div class="input-box">
{{--                                <input type="text" placeholder="{{__('afaq.Notify_holder')}}">--}}
                                <input type="email" required name="email" placeholder="{{ __('lms.your_email') }}" >
                                <button>{{__('afaq.Notify')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 mt-1 d-flex justify-content-center">
                        <div class="social-icons">

                            <a href="https://www.facebook.com/AfaqLms">
                            <span><i class="fa-brands fa-facebook-f"></i>
                            </span>
                            </a>


                            <span style="width: 33px;"></span>

                            <a href="https://twitter.com/AfaqLms">
                            <span>
                                <i class="fa-brands fa-twitter"></i>
                            </span>
                            </a>

                            <span style="width: 33px;"></span>

                            <a href="https://www.instagram.com/AfaqLms/">
                            <span>
                                <i class="fa-brands fa-instagram"></i>
                            </span>
                            </a>

                            <span style="width: 33px;"></span>

                            <a href="https://www.linkedin.com/company/%D9%85%D8%B1%D9%83%D8%B2-%D8%A7%D9%81%D8%A7%D9%82-%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8-%D8%A7%D9%84%D8%B5%D8%AD%D9%8A/">
                            <span>
                                <i class="fa-brands fa-linkedin-in"></i>
                            </span>
                            </a>

                            {{-- <span style="width: 30px;"></span> --}}

{{--                            <a href="../../public/bassengweb/logout">--}}
{{--                            <span>--}}
{{--                                <i class="fa-brands fa-youtube"></i>--}}
{{--                            </span>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 on-small-screen">
                        <div class="copy-right">
                            <span>{{__('afaq.Copyrights_Afaq')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer-->


{{-- <!-- <div class="col-lg-2 col-6 footerLinks"> --}}
{{-- <h4>{{ __('lms.ElectronicLibrary') }}</h4> --}}
{{-- <ul> --}}
{{-- <li>{{ __('lms.ScientificSources') }}</li> --}}
{{-- <li>{{ __('lms.medicalForum') }}</li> --}}
{{-- <li>{{ __('lms.InstructorManual') }}</li> --}}
{{-- <li>{{ __('lms.TraineeManual') }}</li> --}}

{{-- </ul> --}}
{{-- </div> --> --}}
