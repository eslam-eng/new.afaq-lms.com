@extends('layouts.static')
@section('content')
    <link href="{{ asset('afaq/assests/css/register.css') }}" rel="stylesheet">

    <style>
        .precemp {
            display: none;
        }
    </style>
    <section class="login-page_lms">
        <div class="col-12">
            <div class="col-10 offset-1">
                <div class="log-in-conteiner">
                    @if(isset($message))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


                    <div class="afaq-img-L">
                        <img  src="{{ asset('afaq/imgs/small-logo.png') }}" alt="">
                    </div>
                    <div class="login-title">
                        <strong> {{ __('lms.login') }}</strong>
                    </div>
                    @if ($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif
                    <form method="POST" action="{{ route('login', ['locale' => app()->getLocale()]) }}" class="form-login">
                        @csrf
                        <div class="log-in-input">
                            <label for="Email Address or Username">{{ __('lms.Email_address_username') }}</label>
                            <input type="text" name="email" placeholder="{{ __('lms.Username') }}">
                        </div>
                        <div class="log-in-input">
                            <label for="Password">{{ __('lms.Password') }}</label>
                            <input id="password-field" type="password" name="password" value="">
                            <i toggle="#password-field" class="fa-regular fa-eye toggle-password"></i>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="remember-afaq">
                                <input type="checkbox">
                                <u>{{ __('lms.Remember_Me') }}</u>
                            </span>

                            @if (Route::has('password.request'))
                                <em class="forget-pass">
                                    <a class="btn btn-link px-0"
                                        href="{{ route('password.request', ['locale' => app()->getLocale()]) }}">
                                        {{ trans('global.forgot_password') }}

                                    </a>
                                </em>
                            @endif
                        </div>
                        <div class="btn-log">
                            <button>{{ __('lms.login') }}</button>
                        </div>

                        <div class="new-account ">
                            <ul class="small-login_ p-0">
                                <li class="is-regester">
                                    <a href="{{ url(app()->getLocale() . '/register') }}">
                                        <span> {{ __('lms.register') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- <div class="another-way">
                                    {{-- <strong> {{__('lms.ContinueGuest')}} </strong> --}}
                                    <div class="d-flex justify-content-between">
                                    <span class="apple-icon">
                                        <img  src="/afaq/imgs/apple_(2).png" alt="">
                                    </span>
                                        <span style="width:20px ;"></span>
                                        <span class="google-icon">
                                        <img  src="/afaq/imgs/icons8-google_(1).png" alt="">
                                    </span>
                                    </div>
                                    <div class="creat-acc">
                                        <span> {{ __('lms.NewAFAQ') }} </span>
                                            <a class="btn btn-link px-0" href="{{ route('register', ['locale' => app()->getLocale()]) }}">
                                                {{ __('lms.Create_Account') }}
                                            </a>

                                    </div>
                                </div> -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
