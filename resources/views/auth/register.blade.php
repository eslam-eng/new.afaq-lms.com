@php
    $lang = app()->getLocale();
    $ContentCategory = \App\Models\ContentCategory::get();
    $countries = App\Models\Country::select('id', 'country_arName', 'country_arNationality','country_enName', 'country_enNationality', 'country_code', 'order')
            ->whereNull('parent_id')
            ->get()
            ->sortBy('order');
    if ($lang == 'ar') {
        $specialists = App\Models\Specialty::pluck('name_ar', 'id');
        $degree_select = App\Models\User::DEGREE_SELECT;
        $arabic_class = 'ar-form';

    } else {
        $specialists = App\Models\Specialty::pluck('name_en', 'id');
        $degree_select = App\Models\User::DEGREE_SELECT;
        $arabic_class = '';
        // $countries = App\Models\Country::select('id', 'country_enName', 'country_enNationality', 'country_code', 'order')
        //     ->whereNull('parent_id')
        //     ->get()->sortBy('order');


    }
@endphp

@extends(!empty($_GET['NewStyle']) ? 'layouts.front' : 'layouts.front', [$ContentCategory])
@section('styles')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="{{ asset('frontend/css/responsive.css ') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/register.css') }}" rel="stylesheet">
    <style>
        .innerheader-nd {
            height: 50vh !important;
        }

        .precemp {
            display: none;
        }

        @media screen and (max-width: 1200px) {
            .innerheader-nd {
                height: 60vh !important;
            }
        }

        /* loading start */
        .loading_div.hide {
            display: none;
        }

        .loading_div {
            width: 150px;
            margin: 200px auto;
            display: block;
            text-align: center;
        }

        @keyframes loading {
            from {
                transform: rotateZ(0deg);
            }

            to {
                transform: rotateZ(1000deg);
            }
        }

        .animated {
            animation-name: loading;
            animation-duration: 10s;
        }

        /* loading end */
    </style>
@endsection
@section('content')
    <section class="register {{ $arabic_class }}">
        <div class="larg-page">

            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <div class="log-registration-nd">
                        <span> {{ __('lms.onLogin') }} </span>
                    </div>
                    <div class="row justify-content-center">
                        <div class=" login-card-nd mb-5">
                            <div class="card-body" @if ($lang == 'ar') style="text-align: right" @endif>
                                <form method="POST" id="formABC" action="{{ route('register', ['locale' => $lang]) }}">
                                    {{ csrf_field() }}

                                    <h1>{{ __('lms.registernd') }}</h1>

                                    @if (count($errors) > 0)
                                        <div class="custom_register_failed_msg">
                                            <p>
                                                {{ trans('frontend.register.failed_msg') }}
                                            </p>
                                        </div>
                                    @endif

                                    <div class="login-form-nd mt-4">
                                        <h2>{{ __('lms.Personaldata') }}</h2>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="full_name_ar">{{ trans('frontend.register.Full Name Arabic') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('full_name_ar') ? 'is-invalid' : '' }}"
                                                        type="text" name="full_name_ar" id="full_name_ar"
                                                        value="{{ old('full_name_ar', '') }}"
                                                        placeholder="{{ trans('frontend.register.Full Name Arabic') }}"
                                                        required>
                                                    <div class="invalid-feedback"></div>
                                                    @if ($errors->has('full_name_ar'))
                                                        <div class="invalid-feedback">
                                                            "{{ $errors->first('full_name_ar') }}"
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="full_name_en">{{ trans('frontend.register.Full Name English') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}"
                                                        type="text" name="full_name_en" id="full_name_en" minlength="3"
                                                        maxlength="50" value="{{ old('full_name_en', '') }}" required
                                                        placeholder="{{ trans('frontend.register.Full Name English') }}">
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('full_name_en'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('full_name_en') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">

                                                    <label class="required"
                                                        for="name">{{ trans('frontend.register.Title') }}</label>
                                                    <div class="selectContainer">
                                                        <select
                                                            class="form-control col-auto d-inline {{ $errors->has('name_title') ? 'is-invalid' : '' }}"
                                                            id="title" name="name_title" required>
                                                            <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                                            <option value="Mr."
                                                                {{ old('name_title', '') == 'Mr.' ? 'selected' : '' }}>Mr.
                                                            </option>
                                                            <option value="Ms."
                                                                {{ old('name_title', '') == 'Ms.' ? 'selected' : '' }}>Ms.
                                                            </option>
                                                            <option value="Dr."
                                                                {{ old('name_title', '') == 'Dr.' ? 'selected' : '' }}>Dr.
                                                            </option>
                                                            <option value="Prof."
                                                                {{ old('name_title', '') == 'Prof.' ? 'selected' : '' }}>Prof.
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('name_title'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name_title') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="gender">{{ trans('frontend.register.gender') }}</label>
                                                    <div class="selectContainer">
                                                        <select
                                                            class="form-control col-auto d-inline {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                                            id="gender" name="gender" required>
                                                            <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                                            <option value="male"
                                                                {{ old('gender', '') == 'male' ? 'selected' : '' }}>
                                                                {{ app()->getLocale() == 'ar' ? 'ذكر' : 'Male' }} </option>
                                                            <option value="female"
                                                                {{ old('gender', '') == 'female' ? 'selected' : '' }}>
                                                                {{ app()->getLocale() == 'ar' ? 'أنثي' : 'Female' }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('gender'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('gender') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="nationality_id">{{ trans('frontend.register.nationality') }}</label>
                                                    <div class="selectContainer">
                                                        <select
                                                            class="form-control col-auto d-inline {{ $errors->has('nationality_id') ? 'is-invalid' : '' }}"
                                                            id="nationality_id" name="nationality_id" required>
                                                            <option value=""> {{ trans('global.pleaseSelect') }}</option>

                                                            @foreach ($countries as $item)
                                                                <option value="{{ $item->id }}"
                                                                    data-code="{{ $item->country_code }}"
                                                                    {{ $item->id == old('nationality_id', '') ? 'selected' : '' }}>
                                                                    {{ $item->nationality }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('nationality_id'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('nationality_id') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label class="required "
                                                        for="name">{{ trans('frontend.register.identity_type') }}</label>
                                                    <div class="selectContainer">
                                                        <select
                                                            class="form-control col-auto d-inline  {{ $errors->has('identity_type') ? 'is-invalid' : '' }}"
                                                            id="identity_type" name="identity_type" required>
                                                            <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                                            <option value="national_id"
                                                                {{ old('identity_type', '') == 'national_id' ? 'selected' : '' }}>
                                                                {{ __('frontend.national_id') }}</option>
                                                            <option value="resident_id"
                                                                {{ old('identity_type', '') == 'resident_id' ? 'selected' : '' }}>
                                                                {{ __('frontend.resident_id') }}</option>
                                                            <option value="passport"
                                                                {{ old('identity_type', '') == 'passport' ? 'selected' : '' }}>
                                                                {{ __('frontend.passport') }}</option>
                                                            <option value="non_resident"
                                                                {{ old('identity_type', '') == 'non_resident' ? 'selected' : '' }}>
                                                                {{ __('frontend.non_resident') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('identity_type'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('identity_type') }}
                                                        </div>
                                                    @endif
                                                </div>



                                            </div>
                                            <div class="col-lg-6 col-md-12" id="identity_number_form">
                                                <div class="form-group">
                                                    <label class="required"
                                                        for="name">{{ trans('frontend.register.identity_number') }}</label>
                                                    <input type="number" id="identity_number" required
                                                        name="identity_number"
                                                        onKeyPress="if(this.value.length==25) return false;"
                                                        class="form-control{{ $errors->has('identity_number') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ trans('frontend.register.identity_number') }}"
                                                        value="{{ old('identity_number', null) }}">
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('identity_number'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('identity_number') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="login-form-nd mt-4">
                                        <h2>{{ __('lms.Account_details') }}</h2>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label
                                                        class="required">{{ trans('frontend.register.Field of your specialist study') }}</label>
                                                    <select onchange="get_sub_specialists()"
                                                        class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}"
                                                        name="specialty_id" id="specialty_id" required>
                                                        <option value disabled
                                                            {{ old('specialty_id', null) === null ? 'selected' : '' }}>
                                                            {{ trans('global.pleaseSelect') }}</option>
                                                        @foreach ($specialists as $key => $label)
                                                            <option value="{{ $key }}"
                                                                {{ old('specialty_id', '') === (string) $key ? 'selected' : '' }}>
                                                                {{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('specialty_id'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('specialty_id') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12" style="display: none;" id="sub">
                                                <div class="form-group">
                                                    <label
                                                        class="required">{{ trans('frontend.register.Field of your sub specialist study') }}</label>
                                                    <div id="subs"></div>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('sub_specialty_id'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('sub_specialty_id') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 occupational_classification_number">
                                                <div class="form-group">
                                                    <label class=" d-block"
                                                        for="occupational_classification_number">{{ trans('frontend.register.occupational_classification_number') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('occupational_classification_number') ? 'is-invalid' : '' }}"
                                                        type="text" name="occupational_classification_number"
                                                        id="occupational_classification_number"
                                                        value="{{ old('occupational_classification_number', '') }}"
                                                        placeholder="{{ trans('frontend.register.hint_helper') }}">
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('occupational_classification_number'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('occupational_classification_number') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class=" mb-3 form-group">
                                                    <label class="required d-block"
                                                        for="name">{{ trans('frontend.register.Email') }}</label>
                                                    <input type="email" name="email"
                                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                        required placeholder="{{ trans('frontend.register.Email') }}"
                                                        value="{{ old('email', null) }}">
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('email'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">

                                                <div class="form-group" style="overflow: visible;">
                                                    <label class="required d-block"
                                                        for="phone">{{ trans('frontend.register.Phone Number') }}</label>
                                                    <input
                                                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                        type="text" name="phone" id="phone"
                                                        value="{{ old('phone', '') }}" required>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('phone'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('phone') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group mb-3">
                                                    <label class="required d-block"
                                                        for="name">{{ trans('frontend.register.Password') }}</label>
                                                    <div class="d-flex justify-content-between align-items-center required"
                                                        style="padding: 0 10px;">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            required minlength="8" maxlength="50"
                                                            placeholder="{{ trans('frontend.register.Password') }}">
                                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                    </div>
                                                    <div class="invalid-feedback"></div>

                                                    @if ($errors->has('password'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group mb-4">
                                                    <label class="required d-block"
                                                        for="name">{{ trans('frontend.register.Password confirmation') }}</label>
                                                    <div class="d-flex justify-content-between align-items-center required"
                                                        style="padding: 0 10px;">
                                                        <input type="password" id="password_confirmation"
                                                            name="password_confirmation" class="form-control"
                                                            minlength="8" maxlength="50" required
                                                            placeholder="{{ trans('frontend.register.Password confirmation') }}">
                                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                    @if ($errors->has('password_confirmation'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('password_confirmation') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group checkbox-nd">
                                                <input type="checkbox" name="terms" id="terms"
                                                    value="{{ old('terms', true) }}" required>
                                                <label class="required open-termis" for="terms"
                                                    onclick="getPageContent('terms')">
                                                    {{ trans('frontend.register.terms') }}</label>
                                                <div class="all-termis condations-nd">
                                                    <div class="all-termis-andcondations">
                                                        <div class="andcondations-nd">

                                                            <span class="loading_div" style="color:#fff;">
                                                                <img src="{{ asset('/nazil/imgs/gear_loading_dark.svg') }}"
                                                                    alt="loading..">
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group checkbox-nd">
                                                <input type="checkbox" name="privacy" id="privacy"
                                                    value="{{ old('privacy', true) }}" required>
                                                <label class="required open-termis" for="privacy"
                                                    onclick="getPageContent('privacy')">
                                                    {{ trans('frontend.register.privacy') }}</label>
                                                <div class="all-termis condations-nd">
                                                    <div class="all-termis-andcondations">

                                                        <div class="andcondations-nd">

                                                            <span class="loading_div" style="color:#fff;">
                                                                <img src="{{ asset('/nazil/imgs/gear_loading_dark.svg') }}"
                                                                    alt="loading..">
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group checkbox-nd">
                                                <input type="checkbox" name="attend" id="attend"
                                                    value="{{ old('attend', true) }}" required>
                                                <label class="required open-termis"
                                                    onclick="getPageContent('attend_Police')"
                                                    for="attend">{{ trans('frontend.register.attend') }}</label>
                                                <div class="all-termis condations-nd">
                                                    <div class="all-termis-andcondations">
                                                        <div class="andcondations-nd">

                                                            <span class="loading_div" style="color:#fff;">
                                                                <img src="{{ asset('/nazil/imgs/gear_loading_dark.svg') }}"
                                                                    alt="loading..">
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group checkbox-nd">
                                                <input type="checkbox" name="contract" id="contract"
                                                    value="{{ old('contract', true) }}" required>
                                                <label class="required open-termis"
                                                    onclick="getPageContent('place_methaq')"
                                                    for="contract">{{ trans('frontend.register.contract') }}</label>
                                                <div class="all-termis condations-nd">
                                                    <div class="all-termis-andcondations">
                                                        <div class="andcondations-nd">

                                                            <span class="loading_div" style="color:#fff;">
                                                                <img src="{{ asset('/nazil/imgs/gear_loading_dark.svg') }}"
                                                                    alt="loading..">
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group checkbox-nd">
                                                <input type="checkbox" name="all_terms" id="all_terms"
                                                    value="{{ old('all_terms', true) }}">
                                                <label class="required " style="font-weight: bold;"
                                                    for="all_terms">{{ trans('frontend.register.all_terms') }}</label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row justify-content-center my-3">
                                        <button id="btnSubmit" class="btn btn-block act-btn">
                                            {{ trans('frontend.register.Apply Now button') }}
                                        </button>
                                        <button type="reset" class="btn btn-block cancel-btn">
                                            {{ __('lms.cancel') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            if ($('#nationality_id').val() == 194) {
                if ($("#identity_type option[value='resident_id']").length > 0) {
                    $("#identity_type option[value='resident_id']").remove();
                }
                if ($("#identity_type option[value='passport']").length > 0) {
                    $("#identity_type option[value='passport']").remove();
                }
                if ($("#identity_type option[value='non_resident']").length > 0) {
                    $("#identity_type option[value='non_resident']").remove();
                }
                if ($("#identity_type option[value='national_id']").length <= 0) {
                    $('#identity_type').append(`<option value="national_id">` +
                        "{{ __('frontend.national_id') }}" + `</option>`);

                    $("#identity_number_form").show();
                    $("#identity_type").val('national_id');
                    $("#identity_type").select2().select2('text', 'national_id');
                }
            }

            $('#all_terms').click(function(event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });

            $('#nationality_id').change(function(event) {
                if ($('#nationality_id').val() == 194) {
                    if ($("#identity_type option[value='resident_id']").length > 0) {
                        $("#identity_type option[value='resident_id']").remove();
                    }
                    if ($("#identity_type option[value='passport']").length > 0) {
                        $("#identity_type option[value='passport']").remove();
                    }
                    if ($("#identity_type option[value='non_resident']").length > 0) {
                        $("#identity_type option[value='non_resident']").remove();
                    }
                    if ($("#identity_type option[value='national_id']").length <= 0) {
                        $('#identity_type').append(`<option value="national_id">` +
                            "{{ __('frontend.national_id') }}" + `</option>`);

                        $("#identity_number_form").show();
                        $("#identity_type").val('national_id');
                        $("#identity_type").select2().select2('text', 'national_id');
                    }
                } else {
                    if ($("#identity_type option[value='resident_id']").length <= 0) {
                        $('#identity_type').append(`<option value="resident_id">` +
                            "{{ __('frontend.resident_id') }}" + `</option>`);
                    }

                    if ($("#identity_type option[value='passport']").length <= 0) {
                        $('#identity_type').append(`<option value="passport">` +
                            "{{ __('frontend.passport') }}" + `</option>`);
                    }

                    if ($("#identity_type option[value='non_resident']").length <= 0) {
                        $('#identity_type').append(`<option value="non_resident">` +
                            "{{ __('frontend.non_resident') }}" + `</option>`);
                    }

                    if ($("#identity_type option[value='national_id']").length > 0) {
                        $("#identity_type option[value='national_id']").remove();
                    }
                }
            });

            $('#identity_type').change(function(event) {
                if ($('#identity_type').val() == 'non_resident') {
                    $('#identity_number').prop('required', false);
                    $("#identity_number_form").hide();
                } else {
                    $('#identity_number').prop('required', true);
                    $("#identity_number_form").show();

                }


                if ($('#identity_type').val() == 'passport') {
                    $("#identity_number_label").html(
                        "{{ app()->getLocale() == 'en' ? 'Passport Number' : 'رقم جواز السفر' }}");
                    $("#identity_number").prop('placeholder',
                        "{{ app()->getLocale() == 'en' ? 'Passport Number' : 'رقم جواز السفر' }}");
                } else {
                    $("#identity_number_label").html(
                        "{{ app()->getLocale() == 'en' ? 'Identify Number' : 'رقم الهوية' }}");
                    $("#identity_number").prop('placeholder',
                        "{{ app()->getLocale() == 'en' ? 'Identify Number' : 'رقم الهوية' }}");
                }
            });
        });
    </script>
    <script>
        function get_sub_specialists(selected = null) {
            var id = $('#specialty_id').val();
            if (id) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/{{ app()->getLocale() }}/get_specialty/' + id,
                    success: function(data) {
                        var subuser = `
                <select class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}"  name="sub_specialty_id" id="sub_specialty_id" required>
                `;
                        for (let index = 0; index < data.length; index++) {
                            const element = data[index];
                            subuser += `<option value="` + element.id +
                                `" ${selected == element.id ? 'selected' : ''}>` + element.name + `</option>`
                        }

                        subuser += `</select>`;

                        $('#subs').html(subuser);
                        $('#sub').show();

                    }
                });
            }

            switch (id) {
                case '3':
                    $('.occupational_classification_number').hide();
                    $('#occupational_classification_number').val('');
                    $('#occupational_classification_number').prop('required', false);
                    break;
                case '5':
                    $('.occupational_classification_number').hide();
                    $('#occupational_classification_number').val('');
                    $('#occupational_classification_number').prop('required', false);
                    break;

                default:
                    $('.occupational_classification_number').show();
                    $('#occupational_classification_number').prop('required', true);
                    break;
            }
        }

        @if (old('specialty_id'))
            get_sub_specialists({{ old('sub_specialty_id') ?? null }})
        @endif
    </script>
    {{-- script for get page content html ya Ahmed --}}
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
                            $('.andcondations-nd').html(data.data.page_text_ar ? data.data.page_text_ar :
                                "there is no data check the admin");
                            $('.andcondations-nd').show();
                        @else
                            $('.andcondations-nd').html(data.data.page_text ? data.data.page_text :
                                "there is no data check the admin");
                            $('.andcondations-nd').show();
                        @endif
                        $('.loading_div').removeClass('animated');
                    }
                });
            }
        }
    </script>

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
        $('input , select').on('change invalid', function() {
            var textfield = $(this).get(0);
            // 'setCustomValidity not only sets the message, but also marks
            // the field as invalid. In order to see whether the field really is
            // invalid, we have to remove the message first
            textfield.setCustomValidity('');
            if (!textfield.validity.valid) {
                textfield.setCustomValidity(
                    "{{ app()->getLocale() == 'ar' ? 'من فضلك ادخل هذا الحقل' : 'please fill this field' }}");
            }
        });
        // $('input').blur(function(){
        //     let value = $(this).val();
        //     if(value == ''){
        //         $(this).prop('class' , 'is-invalid')
        //         $(this).next('.invalid-feedback').html('هذا الحقل مطلوب')
        //     }else{
        //         $(this).removeClass('class' , 'is-invalid')
        //         $(this).next('.invalid-feedback').html('')
        //     }
        // })

        // $('select').change(function(){
        //     let value = $(this).val();
        //     if(value == ''){
        //         $(this).addClass('class' , 'is-invalid')
        //         $(this).next('.invalid-feedback').html('هذا الحقل مطلوب')
        //     }else{
        //         $(this).removeClass('class' , 'is-invalid')
        //         $(this).next('.invalid-feedback').html('')
        //     }
        // })
    </script>
@endsection
