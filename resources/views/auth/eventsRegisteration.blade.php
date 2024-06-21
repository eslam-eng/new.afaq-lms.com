@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-9">

        <div class="card mx-4">
            <div class="card-body p-4">
                @include('flash-message')
                @if(session('message'))
                <div class="alert alert-info" role="alert">
                    {{ session('message') }}
                </div>
                @endif
                <form method="POST" id="formABC" action="{{ route('eventsRegisterationSave') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="is_event_registeration" value="1">
                    <img src="{{ asset('new-logo.jpg') }}" class="col-lg-2 offset-5">
                    <h2 class="main-ltitle"> ‘How the great Pyramid oh KHUFU was built’</br>
                        By Dr. Zahi Hawass </br>
                        Registration form</h2>
                    <p class="text-muted">Kindly fill in and submit this registration form </p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required minlength="8" maxlength="50" placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" maxlength="50" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <div class="form-group">
                        <label class="required d-block" for="name">{{ trans('global.user_name')  }}</label>
                        <select class="form-control col-auto d-inline" id="title" name="name_title">
                            <option value="">Title</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Prof.">Prof.</option>
                        </select>

                        <input type="text" name="name" id="myUsername" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} col-auto d-inline" required autofocus placeholder="{{ trans('global.first_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @endif

                    </div>


                    <div class="form-group">
                        <label class="required d-block" for="birth_date">{{ trans('cruds.user.fields.birth_date') }}</label>
                        <select class="form-control col-auto d-inline" id="day" name="birth_day" onchange="onChoose()" required>
                            <option value="">Day</option>
                            @for($k=1;$k<32;$k++) <option value="{{$k}}" {{ old('birth_day', '')==$k?'selected':'' }}>{{$k}}</option>
                                @endfor
                        </select>

                        <select class="form-control col-auto d-inline" id="month" name="birth_month" onchange="onChoose()" required>
                            <option value="">Month</option>
                            <option value="01" {{ old('birth_month', '')=='01'?'selected':'' }}>January</option>
                            <option value="02" {{ old('birth_month', '')=='02'?'selected':'' }}>February</option>
                            <option value="03" {{ old('birth_month', '')=='03'?'selected':'' }}>March</option>
                            <option value="04" {{ old('birth_month', '')=='04'?'selected':'' }}>April</option>
                            <option value="05" {{ old('birth_month', '')=='05'?'selected':'' }}>May</option>
                            <option value="06" {{ old('birth_month', '')=='06'?'selected':'' }}>June</option>
                            <option value="07" {{ old('birth_month', '')=='07'?'selected':'' }}>July</option>
                            <option value="08" {{ old('birth_month', '')=='08'?'selected':'' }}>August</option>
                            <option value="09" {{ old('birth_month', '')=='09'?'selected':'' }}>September</option>
                            <option value="10" {{ old('birth_month', '')=='10'?'selected':'' }}>October</option>
                            <option value="11" {{ old('birth_month', '')=='11'?'selected':'' }}>November</option>
                            <option value="12" {{ old('birth_month', '')=='12'?'selected':'' }}>December</option>
                        </select>
                        <select class="form-control col-auto d-inline" name="birth_year" id="year" onchange="onChoose()" required>
                            <option value="">Year</option>
                            @for($i=1940;$i<2008;$i++) <option value="{{$i}}" {{ old('birth_year', '')==$i?'selected':'' }}>{{$i}}</option>
                                @endfor
                        </select>
                        <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" hidden>
                        @if($errors->has('birth_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('birth_date') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.birth_date_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                        @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                        @endif
                    </div>



                    <div class="form-group">
                        <label class="required" for="country">{{ trans('cruds.user.fields.country') }}</label>
                        <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country" required>
                            @foreach($all_countries as $ccode => $acountry)
                            <option value="{{ $ccode }}">{{ $acountry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                        @endif
                    </div>


                    <button id="btnSubmit" class="btn btn-block btn-primary">
                        Register Now
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')


<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("password_confirmation");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
<script>
    $(document).ready(function() {

        $("#formABC").submit(function(e) {

            //disable the submit button
            $("#btnSubmit").attr("disabled", true);

            return true;

        });
    });
</script>
<script>
    function onChoose() {
        var date = document.getElementById("birth_date"),
            day = document.getElementById("day"),
            month = document.getElementById("month"),
            year = document.getElementById("year");
        date.value = day.value + '-' + month.value + '-' + year.value;
    }
</script>
@endsection