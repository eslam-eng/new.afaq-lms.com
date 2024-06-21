<!-- ******************** start footer ********************  -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/aa91594180.js" crossorigin="anonymous"></script>

<style>
    .container {
        /* width: auto; */
        max-width: 1366px;
    }
</style>

<!-- ************** -->
<footer class="footer {{app()->getLocale() == 'ar' ?  'rtl': 'ltr'}}">
    <div class="first-footer">
        <div class="container-md">
            <div class="row footer-subscribe align-items-center">
                <div class="col-lg-4">
                    <div class="subscribe-txt">
                        <h3>
                            {{ __('frontend.contact') }}
                        </h3>
                        <p>
                            {{ __('frontend.contact_sub') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form method='post' action="{{ url(app()->getLocale() . '/newsletters/save') }}">
                        @csrf
                        <div class="row justify-content-center email-subscribe">
                            <input type="email" name="email" placeholder="{{ __('lms.your_email') }}" class="col-md-8 mt-3">
                            <button class="col-md-3 mt-3">{{ __('lms.SUBSCRIBE') }}</button>
                        </div>
                    </form>
                    <div class="row justify-content-center text-center mt-3 footer-socila">
                        <p class="col-md-2 mb-5">{{ __('frontend.follow_me') }}</p>
                        <ul class="social-icons col-md-12 col-lg-5 mb-5">
                            <li><a href="https://www.facebook.com/saudinursing">
                                    <i class="fab fa-facebook-f"></i>
                                </a></li>
                            <li><a href="https://twitter.com/Saudi_Nurses">
                                    <i class="fab fa-twitter"></i>
                                </a></li>
                            <li><a href="https://www.instagram.com/add/Saudi_Nurses">
                                    <i class="fab fa-instagram"></i>
                                </a></li>
                            <li><a href="https://www.youtube.com/channel/UCSfj5r6YjItuB0Ltfslm6dA">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row lastRow">
            <div class="col-lg-4 px-lg-5 justify-content-center">
                <div class="text-center logo-footer">
                    <a class="align-items-end" href="{{url('/'.app()->getLocale() . '/homepage')}}">
                    <img src="/nazil/imgs/logo.png" width="130" height="130" style="min-width: auto;" alt="Footer logo">
                    </a>
                    <h4 class="mt-4">{{ __('lms.logo_name') }}</h4>
                    <h4 class="mt-4">{{ __('lms.logo_des') }}</h4>

                </div>
                <div class="partners row align-items-baseline justify-content-evenly">
{{--                    <div class="col-6">--}}
{{--                        <img src="{{ asset('frontend/img/partner2.png') }}">--}}
{{--                    </div>--}}
                    <div class="col-6">
                        <img src="{{ asset('frontend/img/partner1.png') }}">
                    </div>
                </div>

            </div>
            <div class="col-lg-2 col-6 footerLinks">
                <h4>{{ __('lms.platform') }}</h4>
                <ul>
                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/about-us') }}">
                            {{ __('lms.aboutAssociation') }}
                        </a>
                    </li>
                    <li>
                        <a class="align-items-end" href="{{url('/'.app()->getLocale() . '/all-courses')}}">

                            {{ __('lms.new_activity') }}
                        </a>
                    </li>
                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/membership') }}">
                            {{ __('lms.membership') }}
                        </a>

                    </li>
                    <li>
                        <a class="align-items-end" href="https://forms.gle/5b2MBo6w6AD59gwf7" target="_blank">
                            {{ __('lms.Volunteer') }}
                        </a>

                    </li>

{{--                    <li>--}}
{{--                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/about-us') }}">--}}
{{--                            {{ __('lms.AssociationHistory') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/about-us') }}">--}}
{{--                            {{ __('lms.vision-message') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/about-us') }}">--}}
{{--                            {{ __('lms.Associations-President') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
                {{-- <h4>{{__('lms.contact')}}</h4> --}}
                {{-- <p>{{__('lms.address')}}</p> --}}
                {{-- <p class="tel">{{config('app.telephone')}}</p> --}}
                {{-- <a href="mailto:INFO@SNA.ORG.SA" class="info">{{config('app.email')}}</a> --}}
            </div>
{{--            <div class="col-lg-2 col-6 footerLinks">--}}
{{--                <h4>{{ __('lms.platformJoin') }}</h4>--}}
{{--                <ul>--}}
{{--                    <li>--}}
{{--                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/register') }}">--}}
{{--                            {{ __('lms.JoinUs') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/contact-us') }}">{{ __('lms.contact') }}</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="align-items-end" href="#">--}}
{{--                            {{ __('lms.support&share') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/membership') }}">--}}
{{--                            {{ __('lms.Membership') }}--}}
{{--                        </a>--}}

{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/available-exams') }}">--}}
{{--                            {{ __('lms.availableExam') }}--}}
{{--                        </a>--}}

{{--                    </li>--}}
{{--                </ul>--}}
{{--                --}}{{-- <h4>{{__('lms.pages')}}</h4> --}}
{{--                --}}{{-- <ul> --}}
{{--                --}}{{-- @foreach (\App\Models\ContentPage::orderBy('show_in_menu', 'desc')->take(6)->get() as $page) --}}
{{--                --}}{{-- <li> --}}
{{--                --}}{{-- <a href="{{url('/'.app()->getLocale() . '/content/'.\Illuminate\Support\Str::slug($page->title))}}"> --}}
{{--                --}}{{-- {{$page->title}} --}}
{{--                --}}{{-- </a> --}}
{{--                --}}{{-- </li> --}}
{{--                --}}{{-- @endforeach --}}
{{--                --}}{{-- </ul> --}}
{{--            </div>--}}
                {{-- Terms &Condition Section--}}
            <div class="col-lg-2 col-6 footerLinks">
                <h4>{{ __('lms.rights&politics') }}</h4>
                <ul>
                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/terms') }}">
                            {{ __('lms.Terms&Conditions') }} </a>
                    </li>
                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/privacy') }}">
                            {{ __('lms.PrivacyPolicy') }}
                        </a>
                    </li>

                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/place-methaq') }}">
                            {{ __('lms.place_methaq') }} </a>
                    </li>
                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/document-the-roles-and-responsibilities-of-technicians-administrators-and-technicians	') }}">
                            {{ __('lms.responsibilities') }} </a>
                    </li>
                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/content/attend_Police') }}">
                            {{ __('frontend.register.attend_footer') }}</a>
                    </li>

                </ul>
                {{-- <h4>{{__('lms.pages')}}</h4> --}}
                {{-- <ul> --}}
                {{-- @foreach (\App\Models\ContentPage::orderBy('show_in_menu', 'desc')->take(6)->get() as $page) --}}
                {{-- <li> --}}
                {{-- <a href="{{url('/'.app()->getLocale() . '/content/'.\Illuminate\Support\Str::slug($page->title))}}"> --}}
                {{-- {{$page->title}} --}}
                {{-- </a> --}}
                {{-- </li> --}}
                {{-- @endforeach --}}
                {{-- </ul> --}}
            </div>
{{-- ////////           First Section in Footer  /////////////////--}}
            <div class="col-lg-2 col-6 footerLinks">
                <h4>{{ __('lms.ElectronicLibrary') }}</h4>
                <ul>
                    <li>
                        <a class="align-items-end" href="#">
                            {{ __('lms.InstructorManual') }}
                        </a>
                    </li>
                    <li>
                        <a class="align-items-end" href="#">

                            {{ __('lms.TraineeManual') }}
                        </a>
                    </li>
                    <li>
                        <a class="align-items-end" href="{{ url('/' . app()->getLocale() . '/faq') }}">

                            {{ __('lms.faq') }}
                        </a>
                    </li>
                    <li>

                            <a class="align-items-end" href="{{url('/'.app()->getLocale() . '/contact-us')}}">
                            {{ __('lms.contact') }}
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <div class="row p-4 justify-content-center align-items-center copyright">
            <div class="clearfix col-lg-4 text-center mt-5">
                <div class="copyright_text">
                    {{ __('lms.copyright') }}
                </div>
            </div>
            <div class="copyright_socials col-lg-4 mt-5">
                <ul class="footerB-social text-center">
                    <li><a href="https://www.facebook.com/saudinursing">
                            <i class="fab fa-facebook-f"></i>
                        </a></li>
                    <li><a href="https://twitter.com/Saudi_Nurses">
                            <i class="fab fa-twitter"></i>
                        </a></li>
                    <li><a href="https://www.instagram.com/add/Saudi_Nurses">
                            <i class="fab fa-instagram"></i>
                        </a></li>
                    <li><a href="https://www.youtube.com/channel/UCSfj5r6YjItuB0Ltfslm6dA">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer-->


{{--<!-- <div class="col-lg-2 col-6 footerLinks">--}}
{{--                <h4>{{ __('lms.ElectronicLibrary') }}</h4>--}}
{{--                <ul>--}}
{{--                    <li>{{ __('lms.ScientificSources') }}</li>--}}
{{--                    <li>{{ __('lms.medicalForum') }}</li>--}}
{{--                    <li>{{ __('lms.InstructorManual') }}</li>--}}
{{--                    <li>{{ __('lms.TraineeManual') }}</li>--}}

{{--                </ul>--}}
{{--            </div> -->--}}
