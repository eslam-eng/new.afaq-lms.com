@php
    $lang = app()->getLocale();
    $ContentCategory = \App\Models\ContentCategory::get();

    if ($lang == 'ar') {
        $specialists = App\Models\Specialty::pluck('name_ar', 'id');
        $degree_select = App\Models\User::DEGREE_SELECT;
        $arabic_class = 'ar-form';
        $countries = App\Models\Country::select('id', 'country_arName as country', 'country_arNationality as national', 'country_code', 'order')
            ->whereNull('parent_id')
            ->get()
            ->sortBy('order');
    } else {
        $specialists = App\Models\Specialty::pluck('name_en', 'id');
        $degree_select = App\Models\User::DEGREE_SELECT;
        $arabic_class = '';
        $countries = App\Models\Country::select('id', 'country_enName as country', 'country_enNationality as national', 'country_code', 'order')
            ->whereNull('parent_id')
            ->get()
            ->sortBy('order');
    }
@endphp
@extends('frontend.business.layout.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <main class="home-page log-in-page">
        <section class="login-page">
            <div class="log-layer">
                <img  src="{{ asset('afaq/business/imgs/bs-backg.png') }}" alt="">
            </div>
            <div class="log-in-form">

                <form method="POST"  action="{{ route('register', ['locale' => $lang]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="1" name="type">
                    <div class="login-main main-body register-page">
                        <div class="close-form">
                            <a href="{{ route('business-home', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                        <div class="sm-log">
                            <div class="afaq-logo" href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                                <img  src="{{ asset('afaq\business/imgs/AFAQ.png') }}" alt="">
                            </div>
                            <div class="creat-acc-btn">
                                <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                    <span> {{ __('lms.login') }}</span>
                                </a>

                            </div>
                        </div>
                        <div class="type-login">
                            <span>{{ __('afaq.create_business_account') }}</span>
                            <div class="type-way">
                                <div class="social-log">
                                    <button class="google-login">
                                        <div class="icon-img">
                                            <img  src="{{ asset('afaq\business/imgs/icon-gr-2.svg') }}"
                                                alt="">
                                        </div>
                                    </button>
                                </div>
                                <span class="w-10-"></span>
                                <div class="social-log">
                                    <button class="google-login">
                                        <div class="icon-img">
                                            <img  src="{{ asset('afaq\business/imgs/icon-gr-1.svg') }}"
                                                alt="">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="log-form-details">
                            <div class="frst-step active tabes-step">
                                <div class="register-group">
                                    <div class="form-gr register-gr">

                                        <input
                                               type="text" name="full_name_ar" id="full_name_ar" minlength="3"
                                               maxlength="50"
                                               value="{{ old('full_name_ar', '') }}"
                                               placeholder="{{ trans('frontend.register.Full Name Arabic') }}" required>
                                    </div>
                                    <div class="form-gr register-gr">

                                        <input
                                               type="text" name="full_name_en" id="full_name_en" minlength="3"
                                               maxlength="50" value="{{ old('full_name_en', '') }}" required
                                               placeholder="{{ trans('frontend.register.Full Name English') }}">
                                    </div>
                                    <div class="form-gr register-gr">
{{--                                        <input type="text" placeholder="{{ trans('frontend.register.Title') }}">--}}


                                        <select

                                                id="title" name="name_title" required>
                                            <option value=""> {{ trans('frontend.register.Title') }}</option>
                                            <option value="Mr." {{ old('name_title', '') == 'Mr.' ? 'selected' : '' }}>
                                                Mr.</option>
                                            <option value="Ms." {{ old('name_title', '') == 'Ms.' ? 'selected' : '' }}>
                                                Ms.</option>
                                            <option value="Dr." {{ old('name_title', '') == 'Dr.' ? 'selected' : '' }}>
                                                Dr.</option>

{{--                                            <option value="Dr." {{ old('name_title', '') == 'Dr.' ? 'selected' : '' }}>--}}
{{--                                                {{ app()->getLocale() == 'ar' ? 'دك' : 'Dr.' }} </option>--}}
                                            <option value="Prof."
                                                    {{ old('name_title', '') == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                                        </select>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </div>
                                    <div class="form-gr register-gr grnder-select">
                                        <!-- <input type="text" placeholder="Gender"> -->

                                        <select
                                                id="gender" name="gender" required>
                                            <option value=""> {{ trans('frontend.register.gender') }}</option>
                                            <option value="male" {{ old('gender', '') == 'male' ? 'selected' : '' }}>
                                                {{ app()->getLocale() == 'ar' ? 'ذكر' : 'Male' }} </option>
                                            <option value="female" {{ old('gender', '') == 'female' ? 'selected' : '' }}>
                                                {{ app()->getLocale() == 'ar' ? 'أنثي' : 'Female' }}</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('gender') }}
                                            </div>
                                        @endif
                                        <i class="fa-solid fa-angle-down"></i>
                                    </div>

                                    <div class="form-gr ">
                                        {{-- <input class="form-control tel" type="tel" name="leyka_donor_phone" inputmode="tel" value=""/> --}}
{{--                                        <input id="phone" class="form-control tel" type="tel" name="phone" />--}}

                                        <input class="form-control tel"
                                               type="tel" name="phone[full]" id="mobile_code" maxlength="14" aria-valuemax="14"
                                               value="{{ old('full_number', '') }}" required>
                                    </div>
                                    <div class="form-gr ">

                                        <input type="email" name="email"
                                                required
                                               placeholder="{{ trans('frontend.register.Email') }}"
                                               value="{{ old('email', null) }}">
                                    </div>
                                    <div class="form-gr ">
{{--                                        <input type="password" placeholder="Create Password">--}}
                                        <input type="password" id="password" name="password"

                                               required minlength="8" maxlength="50"
                                               placeholder="{{ trans('frontend.register.Password') }}">
                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                    </div>
                                </div>


                                <div class="termis-condtion">
                                    <input type="checkbox" name="terms" value="{{ old('terms', true) }}" required>
                                    <em>{{ __('lms.Accept') }}
                                        <a href="#" onclick="getPageContent('Terms and Conditions');return false;"  class="open-termis termos-popup" >
                                            {{ __('lms.Terms') }}
                                        </a>
                                        {{ __('lms.and') }}
                                        <a href="#" onclick="getPageContent('Privacy Policy');return false;" class="open-termistwo condation-popup">
                                            {{ __('lms.PrivacyStatements') }}
                                        </a>
                                    </em>
                                </div>
                                <div class="submit-log">
                                    <button>{{ __('lms.Create_Account') }}</button>
                                </div>
                            </div>

                            @if ($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                            @endif
                        </div>

                        <div class="creat-new-acc">
                            <span>{{ __('lms.AlreadyhaveAccount') }}?
                                <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                    {{ __('lms.login') }}</a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <div class="termis-popup-window">
    <div class="card-window">
        <div class="close-window">
            <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="body-window"></div>
    </div>
</div>
<div class="condations-popup-window">
    <div class="card-window">
        <div class="close-window">
            <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="body-window"></div>
    </div>
</div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
          utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
      </script>

@endsection
@section('scripts')
    <script>
        function getPageContent(title) {
            if (title) {

                $('.loading_div').addClass('animated')
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/api/v1/page-content/' + title,
                    success: function(data) {
                        @if (app()->getLocale() == 'ar')
                        $('.body-window').html(data.data.page_text_ar ? data.data.page_text_ar :
                            "there is no data check the admin");
                        $('.andcondations-nd').show();
                        @else
                        $('.body-window').html(data.data.page_text ? data.data.page_text :
                            "there is no data check the admin");
                        $('.andcondations-nd').show();
                        @endif
                        $('.loading_div').removeClass('animated');
                    }
                });
            }
        }
    </script>

@endsection
