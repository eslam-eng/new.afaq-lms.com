@extends('layouts.front')
@section('content')
<style>
    .forgotPasswordContainer {
    padding-top: 150px;
    width: 50%;
    margin: 0 auto;
    text-align: center;
}

.forgotPasswordContainer button.btn.btn-primary.btn-block.btn-flat {
    width: 50%;
    margin: 0 auto;
}
@media only screen and (max-width: 830px){
        .forgotPasswordContainer {
        width: 80%;
        margin-bottom: 20px;
        padding-top: 50px;
        }

        .forgotPasswordContainer .p-5 {
        padding: 0 !important;
        }
    }
</style>
<div class="row justify-content-end h-100">
    <div class="right-sidelogin reset-password-page forgotPasswordContainer">
        <div class="log-registration-nd">
            <span> {{ trans('panel.site_title') }} </span>
            <p class="text-muted">{{ trans('global.reset_password') }}</p>
        </div>
        <div class="onright-side register ">
            <div class="p-5 ">

                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.request' , ['locale' => app()->getLocale()]) }}">
                    @csrf

                    <input name="token" value="{{ $token }}" type="hidden">

                    <div class="form-group">
                        <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ $email ?? old('email') }}">

                        @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" name="password" class="form-control" required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
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
