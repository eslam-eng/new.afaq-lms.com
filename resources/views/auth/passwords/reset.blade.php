@extends('layouts.front')
@section('content')
    <div class="row justify-content-end h-100">
        <div class="right-sidelogin reset-password-page forgotPasswordContainer">
            <div class="log-registration-nd">
                <span> {{ trans('panel.site_title') }} </span>
                <p class="text-muted">{{ trans('global.reset_password') }}</p>
            </div>
            <div class="onright-side register">
                <div class="p-5 ">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.request', ['locale' => app()->getLocale()]) }}">
                        @csrf

                        <input name="token" value="{{ $token }}" type="hidden">

                        <div class="form-group">
                            <input id="email" type="email" name="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                                autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                                value="{{ $email ?? old('email') }}">

                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" name="password" class="form-control" required
                                placeholder="{{ trans('global.login_password') }}">

                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" name="password_confirmation" class="form-control"
                                required placeholder="{{ trans('global.login_password_confirmation') }}">
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    {{ trans('global.reset_password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="left-sidelogin"></div>
    </div>
@endsection

@section('head')
    <meta property="og:site_name" content="AFAQ|آفاق">
    <meta property="og:type" content="website">

    <meta property="fb:app_id" content="269713445111381">
    <meta property="al:ios:url" content="afaq://reset-password?email={{ $email }}&token={{ $token }}">
    <meta property="al:ios:app_store_id" content="com.afaq.afaq">
    <meta property="al:ios:app_name" content="AFAQ|آفاق">
    <meta property="al:android:url" content="afaq://reset-password?email={{ $email }}&token={{ $token }}">
    <meta property="al:android:app_name" content="afaq">
    <meta property="al:android:package" content="com.afaq.devewest">
    <meta property="al:web:should_fallback" content="false">
@endsection

@section('scripts')
    <script>
        window.location = 'afaq://reset-password?email={{ $email }}&token={{ $token }}';
    </script>
@endsection
