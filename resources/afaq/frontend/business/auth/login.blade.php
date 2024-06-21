@extends('frontend.business.layout.main')
@section('content')

<main class="home-page log-in-page">
    <section class="login-page">
        <div class="log-layer">

            <img  src="{{ asset('afaq/business/imgs/bs-backg.png') }}" alt="">
        </div>
        @if (session('message'))
            <div class="alert alert-info" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="log-in-form">
            <form method="POST" action="{{ route('login', ['locale' => app()->getLocale()]) }}" class="form-login">
                @csrf
                <div class="login-main main-body">
                    <div class="close-form">
                        <a href="{{ url()->previous() }}"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                    <div class="sm-log">
                        <div class="afaq-logo" href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                            <img  src="{{ asset('afaq\business/imgs/AFAQ.png') }}" alt="">
                        </div>
                        <div class="creat-acc-btn">
                            <a href="{{ url(app()->getLocale() . '/registration') }}">
                                <span>{{ __('lms.Create_Account') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="type-login">
                        {{-- <span>{{ __('lms.AlreadyhaveAccount') }}?
                                <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                    {{ __('lms.login') }}</a>
                            </span> --}}
                        <div class="type-way">
                            <div class="social-log">
                                <button class="google-login">
                                    <div class="icon-img">
                                        <img  src="{{ asset('afaq\business/imgs/icon-gr-2.svg') }}" alt="">
                                    </div>
                                </button>
                            </div>
                            <span class="w-10-"></span>
                            <div class="social-log">
                                <button class="google-login">
                                    <div class="icon-img">
                                        <img  src="{{ asset('afaq\business/imgs/icon-gr-1.svg') }}" alt="">
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="log-form-details">
                        <div class="form-gr">
{{--                            <input type="email" placeholder="Email Address">--}}
                            <input type="text" name="email" placeholder="{{ __('lms.Username') }}">
                        </div>
                        <div class="form-gr">
{{--                            <input type="password" placeholder="Password">--}}
                            <input id="password-field" placeholder="{{ __('lms.Password') }}" type="password" name="password" value="">
                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        </div>
                        <div class="forget-rememder-pass">
                            <div class="Remember-box">
                                <input type="checkbox">
                                <em>{{ __('lms.Remember_Me') }}</em>
                            </div>

                            @if (Route::has('password.request'))
                            <div class="forget-pass">
{{--                                <a href="{{ url(app()->getLocale() . '/forget') }}">--}}
{{--                                    {{ trans('global.forgot_password') }}--}}
{{--                                </a>--}}
                                <a
                                   href="{{ route('password.request', ['locale' => app()->getLocale()]) }}">
                                    {{ trans('global.forgot_password') }}

                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="submit-log">
                        <button>{{ __('lms.login') }}</button>
                    </div>
                    <div class="creat-new-acc">
                        <span>{{ __('lms.dont_have_account') }}

                             <a href="{{ url(app()->getLocale() . '/registration') }}">
                                        <span> {{ __('lms.register') }}</span>
                                    </a>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        @if ($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
        @endif
    </section>
</main>

@endsection
