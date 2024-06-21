@extends('layouts.front')
@section('content')
<style>
    .innerheader-nd {
        height: 45vh !important;
    }
    .precemp{
        display: none;
    }
    .forgotPasswordContainer{
        width: 30%;
        margin: 0 auto;
        padding-top: 150px;
        text-align: center;
    }
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
        <div class="logoImage mb-5">
            <img src="/afaq/imgs/AFAQ.png" alt="">
        </div>
        <div class="log-registration-nd">
            <!-- <span> {{ trans('panel.site_title') }} </span> -->
            <p class="text-muted">{{ trans('global.reset_password') }}</p>
        </div>
        <div class="onright-side register ">
            <div class="  p-5 ">

                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ '/'.app()->getLocale().'/password/email' }}">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                        @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" style="font-size: .9375rem;margin-top: 20px;width: 100%;text-align: center;border-radius: 4px; border: none;color: #fff;padding: 8px; background: #4f8288;" class="global-login button  btn-flat btn-block">
                                {{ trans('global.send_password') }}
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
