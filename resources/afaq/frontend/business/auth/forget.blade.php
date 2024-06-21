@extends('frontend.business.layout.main')
@section('content')
<main class="home-page log-in-page">
    <section class="login-page">
        <div class="log-layer">
            <img  src="{{ asset('afaq/business/imgs/bs-backg.png') }}" alt="">
        </div>
        <div class="log-in-form">
            <form method="POST"  action="{{ route('password.request' , ['locale' => app()->getLocale()]) }}">
                @csrf
{{--                <input name="token" value="{{ $token }}" type="hidden">--}}

                <div class="login-main main-body">
                    <div class="close-form">
                        <a href="{{ route('business-home', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                    <div class="sm-log">
                        <div class="afaq-logo" href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                            <img  src="{{ asset('afaq\business/imgs/AFAQ.png') }}" alt="">
                        </div>
                        <div class="creat-acc-btn">
                            <a href="{{ url(app()->getLocale() . '/registration') }}">
                                <span>{{ __('lms.register') }}</span>
                            </a>
                        </div>
                    </div>
{{--                    <div class="type-login" >--}}
{{--                        <span>{{__('validator.confirm_newpassword')}}</span>--}}
{{--                        <div class="type-way">--}}
{{--                            <div class="social-log">--}}
{{--                                <button class="google-login">--}}
{{--                                    <div class="icon-img">--}}
{{--                                        <img  src="{{ asset('afaq\business/imgs/icon-gr-2.svg') }}" alt="">--}}
{{--                                    </div>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <span class="w-10-"></span>--}}
{{--                            <div class="social-log">--}}
{{--                                <button class="google-login">--}}
{{--                                    <div class="icon-img">--}}
{{--                                        <img  src="{{ asset('afaq\business/imgs/icon-gr-1.svg') }}" alt="">--}}
{{--                                    </div>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="log-form-details">
                        <div class="form-gr">
                            <input id="email" type="email" name="email"  required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" >

                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

{{--                        <div class="form-gr">--}}
{{--                            <input id="password" type="password" name="password"  required placeholder="{{ __('lms.create_new_password') }}">--}}

{{--                            @if($errors->has('password'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $errors->first('password') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>--}}
{{--                        </div>--}}

{{--                        <div class="form-gr">--}}
{{--                            <input type="password" placeholder="{{__('validator.confirm_newpassword')}}">--}}
{{--                            <input id="password-confirm" type="password" name="password_confirmation" required placeholder="{{__('validator.confirm_newpassword')}}">--}}

{{--                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>--}}
{{--                        </div>--}}

                    </div>
                    <div class="submit-log">
                        <button type="submit">{{ __('afaq.Save') }}</button>
                    </div>

                </div>
            </form>
        </div>
    </section>
</main>

@endsection
