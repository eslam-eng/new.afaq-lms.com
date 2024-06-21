@extends('layouts.front')
@section('content')
<style>
    .precemp {
        display: none;
    }
</style>
<div class="login-page container">

    <div class="the-larg-page">
        <div class="right-sidelogin">
            <div class="log-registration-nd">
                <span> {{__('lms.onLogin')}} </span>
            </div>
            <div class="onright-side register ">
                <div class="  p-3">
                    <div class="card-login login-page-nd">
                        <h1>{{__('lms.registernd')}}</h1>
                        <!-- <div class="img-logo-log-in  mb-3">
                        <img class="img-responsive logo_transparent_static visible" src="/nazil/imgs/logo.png" alt="الجمعية السعودية للتمريض المهني">
                    </div> -->
                        <span class="brdr-btm">
                            <span class="border-btm"></span>
                        </span>

                        <div class="form-login">
                            <!-- <p class="text-muted">{{ trans('global.login') }}</p> -->

                            @if(session('message'))
                            <div class="alert alert-info" role="alert">
                                {{ session('message') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('login' , ['locale' => app()->getLocale()]) }}">
                                @csrf
                                <div class="row mt-5">
                                    <div class="col-lg-12 col-md-12">
                                        <div class=" mb-3 form-group">
                                            <label class="required d-block" for="name">{{ trans('global.login_email') }}</label>
                                            <input id="email" name="email" type="text" class="input-login form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                                            @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class=" mb-3 form-group">
                                            <label class="required d-block" for="name">{{ trans('global.login_password') }}</label>
                                            <input id="password" name="password" type="password" class="input-login form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                                            @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="remember-me d-flex justify-content-between">
                                    <div class="remember-left-side ">
                                        <div class="input-group ">
                                            <div class="form-check checkbox">
                                                <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;border-radius: 50%;" />
                                                <div style="width: 20px;display: inline-block;"></div>
                                                <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                                    {{ trans('global.remember_me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="remember-right-side text-right">
                                        @if(Route::has('password.request'))
                                        <a class="btn btn-link px-0" href="{{ route('password.request' , ['locale' => app()->getLocale()] ) }}">
                                            {{ trans('global.forgot_password') }}
                                        </a><br>
                                        @endif

                                    </div>
                                </div>
                                <div class="login-btn">
                                    <div class="global-login">
                                        <button type="submit" class=" px-4">
                                            {{ trans('global.login') }}
                                        </button>
                                    </div>
                                    <div class="fowllow-us">
                                        <h5>{{ trans('frontend.follow_usnow') }}</h5>

                                    </div>
                                    <div class="apply-now">
                                        <div class="apply-now-btn">
                                            <a class="btn btn-link px-0" href="{{ route('register',['locale'=> app()->getLocale()]) }}">
                                                {{ trans('global.register') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-sidelogin">
            <h3> {{ trans('global.e_learning_platform') }} </h3>
            <p> {{ trans('global.nursing_leading_edifice') }}</p>
            <div class="sna-support-example">
                <div class="sna-support-example-img">
                    <div class="example-img-lms">
                        <img src="/nazil/imgs/new-page/Group 4.png" alt="">
                    </div>
                    <span>{{ trans('global.professional_programs' )}}</span>
                </div>
                <div class="sna-support-example-img">
                    <div class="example-img-lms">
                        <img src="/nazil/imgs/new-page/Group 3.png" alt="">
                    </div>
                    <span>{{ trans('global.live_lectures' )}}</span>
                </div>
                <div class="sna-support-example-img">
                    <div class="example-img-lms">
                        <img src="/nazil/imgs/new-page/Group 5.png" alt="">
                    </div>
                    <span>{{ trans('global.training_courses' )}}</span>
                </div>
                <div class="sna-support-example-img">
                    <div class="example-img-lms">
                        <img src="/nazil/imgs/new-page/Group 6.png" alt="">
                    </div>
                    <span>{{ trans('global.conferences' )}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection