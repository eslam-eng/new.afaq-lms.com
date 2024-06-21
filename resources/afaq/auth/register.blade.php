@php
    $lang = app()->getLocale();
    $ContentCategory = \App\Models\ContentCategory::get();

    if ($lang == 'ar') {
        $specialists = App\Models\Specialty::pluck('name_ar', 'id');
        $degree_select = App\Models\User::DEGREE_SELECT;
        $arabic_class = 'ar-form';
        $countries = App\Models\Country::select('id', 'country_arName as country', 'country_arNationality as national', 'country_code', 'order')
            ->whereNull('parent_id')
            ->whereNotIn('id', [106])
            ->get()
            ->sortBy('order');
    } else {
        $specialists = App\Models\Specialty::pluck('name_en', 'id');
        $degree_select = App\Models\User::DEGREE_SELECT;
        $arabic_class = '';
        $countries = App\Models\Country::select('id', 'country_enName as country', 'country_enNationality as national', 'country_code', 'order')
            ->whereNull('parent_id')
            ->whereNotIn('id', [106])
            ->get()
            ->sortBy('order');
    }
@endphp

@extends(!empty($_GET['NewStyle']) ? 'layouts.static' : 'layouts.static', [$ContentCategory])
@section('styles')
    <link href="{{ asset('afaq/assests/css/register.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        .precemp {
            display: none;
        }

        .iti--separate-dial-code .iti__selected-flag {
            direction: ltr !important;
        }
    </style>
@endsection
@section('content')
    <section class="register-page login-page_lms">
        <div class="col-12">
            <div class="col-10 offset-1">
                <div class="register-page-afaq">
                    <div class="afaq-img-L">
                        <img  src="/afaq/imgs/small-logo.png" alt="">
                    </div>
                    <div class="login-title">
                        <strong>{{ __('lms.Create_Account') }}</strong>
                    </div>
                    <div class="details-type ">
                        <span class="active Personaldata">
                            <i class="fa-solid fa-circle-check"></i>
                            <em>{{ __('lms.Personaldata') }} </em>
                        </span>
                        <span class="Account_details">
                            <i class="fa-solid fa-circle-check"></i>
                            <em>{{ __('lms.Account_details') }} </em>
                        </span>
                    </div>
                    @if ($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif
                    <form method="POST" id="formABC" action="{{ route('register', ['locale' => $lang]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="user" id="user" value="1" >

                        <section class="Personaldata-details-account">
                            <div class="d-flex justify-content-between fg-details">
                                <div class="rg-afaq log-in-input required">
                                    <label for="full_name_ar">{{ trans('frontend.register.Full Name Arabic') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('full_name_ar') ? 'is-invalid' : '' }}"
                                         type="text" name="full_name_ar" id="full_name_ar" minlength="3"
                                           maxlength="50"
                                        value="{{ old('full_name_ar', '') }}"
                                        placeholder="{{ trans('frontend.register.Full Name Arabic') }}" required>
                                </div>
                                <div class="rg-afaq log-in-input">
                                    <label for="full_name_en">{{ trans('frontend.register.Full Name English') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}"
                                         type="text" name="full_name_en" id="full_name_en" minlength="3"
                                        maxlength="50" value="{{ old('full_name_en', '') }}" required
                                        placeholder="{{ trans('frontend.register.Full Name English') }}">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between fg-details">
                                <div class="rg-afaq log-in-input">
                                    <label class="required" for="name">{{ trans('frontend.register.Title') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="selectContainer">
                                        <select
                                            class="form-control col-auto d-inline {{ $errors->has('name_title') ? 'is-invalid' : '' }}"
                                            id="title" name="name_title" required>
                                            <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                            <option value="Mr." {{ old('name_title', '') == 'Mr.' ? 'selected' : '' }}>
                                                Mr.</option>
                                            <option value="Ms." {{ old('name_title', '') == 'Ms.' ? 'selected' : '' }}>
                                                Ms.</option>
                                            <option value="Dr." {{ old('name_title', '') == 'Dr.' ? 'selected' : '' }}>
                                                Dr.</option>
                                            <option value="Prof."
                                                {{ old('name_title', '') == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="rg-afaq log-in-input">
                                    <label class="required" for="gender">{{ trans('frontend.register.gender') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="selectContainer">
                                        <select
                                            class="form-control col-auto d-inline {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                            id="gender" name="gender" required>
                                            <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                            <option value="male" {{ old('gender', '') == 'male' ? 'selected' : '' }}>
                                                {{ app()->getLocale() == 'ar' ? 'ذكر' : 'Male' }} </option>
                                            <option value="female" {{ old('gender', '') == 'female' ? 'selected' : '' }}>
                                                {{ app()->getLocale() == 'ar' ? 'أنثي' : 'Female' }}</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('gender') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="d-flex justify-content-between fg-details">
{{--                                                            {{dd($countries->toArray())}}--}}
                                <div class="rg-afaq log-in-input">
                                    <label class="required"
                                        for="nationality_id">{{ trans('frontend.register.nationality') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="selectContainer">
{{--                                        <select onchange="get_cities()"--}}
                                        <select
                                            class="form-control col-auto d-inline {{ $errors->has('nationality_id') ? 'is-invalid' : '' }}"
                                            id="nationality_id" name="nationality_id" required  >
                                            <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}" data-code="{{ $item->country_code }}"
                                                    {{ $item->id == old('nationality_id', '') ? 'selected' : '' }}>
                                                    {{ $item->national }}</option>
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
{{--                                Get City--}}
{{--                                <div class="rg-afaq log-in-input">--}}
{{--                                    <div id="city" style="display: none;" >--}}
{{--                                        <label--}}
{{--                                            >{{ trans('frontend.register.city') }}</label>--}}

{{--                                    </div>--}}
{{--                                    <div class="invalid-feedback"></div>--}}

{{--                                    @if ($errors->has('city_id'))--}}
{{--                                        <div class="invalid-feedback">--}}
{{--                                            {{ $errors->first('city_id') }}--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                Till here --}}



                                {{-- <div class="rg-afaq log-in-input">
                                    <label class="required " for="name">{{ trans('frontend.register.identity_type') }}
                                        <span class="text-danger">*</span></label>
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
                                </div> --}}
                            </div>
                            {{-- <div class="d-flex justify-content-between fg-details" >
                                <div class="rg-afaq log-in-input " id="identity_number_form">
                                    <label class="required"
                                        for="name">{{ trans('frontend.register.identity_number') }}</label>
                                    <input type="number" id="identity_number" required name="identity_number"
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

                            </div> --}}
                            <div class="another-way-afaq">
                                <div class="btn-log next_btn_">
                                    <button onclick="$('#formABC').validate()">{{ __('lms.Next') }} </button>
                                </div>
                            </div>
                        </section>
                        <section class="details-account-register not-now">

                            <div class="d-flex justify-content-between fg-details ">

                                <div class="rg-afaq log-in-input">
                                    <label class="required d-block" for="name">{{ trans('frontend.register.Email') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                                           placeholder="{{ trans('frontend.register.Email') }}"
                                           value="{{ old('email', null) }}">
                                    <div class="invalid-feedback"></div>

                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="rg-afaq log-in-input ">
                                    <label class="required d-block"
                                           for="phone">{{ trans('frontend.register.Phone Number') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                           type="tel" name="phone[full]" id="phone" maxlength="14" aria-valuemax="14"
                                           value="{{ old('full_number', '') }}" required>

                                    <div class="invalid-feedback"></div>

                                    @if ($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif

                                </div>


                            </div>
                            {{--Pecialy ,sub --}}
                            <div class="d-flex justify-content-between fg-details">
                                <div class="rg-afaq log-in-input">
                                    <label
                                        class="required">{{ trans('frontend.register.Field of your specialist study') }}
                                        <span class="text-danger">*</span></label>
                                    <select onchange="get_sub_specialists()"
                                            class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}"
                                            name="specialty_id" id="specialty_id" >
                                        <option value disabled {{ old('specialty_id', null) === null ? 'selected' : '' }}>
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
                                <div class="rg-afaq log-in-input">
                                    <div id="subs" style="display: none;">
                                        <label
                                            class="required">{{ trans('frontend.register.Field of your sub specialist study') }}</label>

                                    </div>
                                    <div class="invalid-feedback"></div>

                                    @if ($errors->has('sub_specialty_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('sub_specialty_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between fg-details">
                                <div class="rg-afaq log-in-input occupational_classification_number">
                                    <label class=" d-block"
                                           for="occupational_classification_number">{{ trans('frontend.register.occupational_classification_number') }}</label>
                                    <input
                                        class="form-control {{ $errors->has('occupational_classification_number') ? 'is-invalid' : '' }}"
                                        type="text" name="occupational_classification_number"
                                        id="occupational_classification_number"
                                        value="{{ old('occupational_classification_number', '') }}"
                                        placeholder="{{ trans('frontend.register.occupational_classification_number') }}">
                                    <div class="invalid-feedback"></div>

                                    @if ($errors->has('occupational_classification_number'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('occupational_classification_number') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('frontend.register.hint_helper') }}</span>
                                </div>

                                <div class="rg-afaq log-in-input">
                                    <label for="Password">{{ trans('frontend.register.Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="d-flex justify-content-between align-items-center required">
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
                            <div class="d-flex justify-content-between fg-details">

                                <div class="rg-afaq log-in-input confirmation-input">
                                    <label for="Password">{{ trans('frontend.register.Password confirmation') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="d-flex justify-content-between align-items-center required">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" minlength="8" maxlength="50" required
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
                        </section>
                        <div class="another-way-afaq">
                            <div class="not-now termis-line">
                                <div class="accept-termis d-flex align-items-center ">
                                    <input type="checkbox" name="terms" value="{{ old('terms', true) }}" required>
                                    <input type="hidden" name="privacy" value="1">
                                    <input type="hidden" name="attend" value="1">
                                    <input type="hidden" name="contract" value="1">

                                    <span class="the-span">{{ __('lms.Accept') }}
                                        {{--                                    <a href="" onclick="getPageContent('terms')">{{__('lms.Terms')}}</a> --}}

                                        <a id="terms" class="open-termis" href="#"
                                            onclick="getPageContent('Terms and Conditions');return false;">{{ __('lms.Terms') }}</a>

                                        <div class="modal-Checkout-lms condations-nd">
                                            <div class="close-icons">X</div>
                                            <!-- <span id="loading_div" style="color:#fff;">
                                        <img src="{{ asset('/nazil/imgs/gear_loading.svg') }}" alt="loading..">
                                    </span> -->
                                            <div class="termis-data"></div>
                                        </div>

                                        {{ __('lms.and') }}
                                        <a id="privacy" class="open-termistwo" href="#"
                                            onclick="getPageContent('Privacy Policy');return false;">{{ __('lms.PrivacyStatements') }}</a>

                                        <div class="modal-Checkout-lmss condations-nd">
                                            <div class="close-icons">X</div>
                                            {{--    <!-- <span id="loading_div" style="color:#fff;"> --}}
                                            {{--        <img src="{{ asset('/nazil/imgs/gear_loading.svg') }}" alt="loading.."> --}}
                                            {{--    </span> --> --}}
                                            <div class="termis-data"></div>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="btn-log not-now creat-new-acc">
                                <button>{{ __('lms.Create_Account') }}</button>
                            </div>
                            <!-- <div class="another-way">
                                {{-- <strong>{{__('lms.ContinueGuest')}}</strong> --}}
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
                                    <span> {{ __('lms.AlreadyhaveAccount') }}</span>
                                    <a href="{{ url('login') }}">
                                        {{ __('lms.login') }}
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // jQuery("#identity_type").select2().select2('text', 'national_id');
            // if ($('#nationality_id').val() == 194) {
            //     if ($("#identity_type option[value='resident_id']").length > 0) {
            //         $("#identity_type option[value='resident_id']").remove();
            //     }
            //     if ($("#identity_type option[value='passport']").length > 0) {
            //         $("#identity_type option[value='passport']").remove();
            //     }
            //     if ($("#identity_type option[value='non_resident']").length > 0) {
            //         $("#identity_type option[value='non_resident']").remove();
            //     }
            //     if ($("#identity_type option[value='national_id']").length <= 0) {
            //         $('#identity_type').append(`<option value="national_id">` +
            //             "{{ __('frontend.national_id') }}" + `</option>`);

            //         $("#identity_number_form").show();
            //         $("#identity_type").val('national_id');
            //         $("#identity_type").select2().select2('text', 'national_id');
            //     }
            // }

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

            // $('#nationality_id').change(function(event) {
            //     if ($('#nationality_id').val() == 194) {
            //         if ($("#identity_type option[value='resident_id']").length > 0) {
            //             $("#identity_type option[value='resident_id']").remove();
            //         }
            //         if ($("#identity_type option[value='passport']").length > 0) {
            //             $("#identity_type option[value='passport']").remove();
            //         }
            //         if ($("#identity_type option[value='non_resident']").length > 0) {
            //             $("#identity_type option[value='non_resident']").remove();
            //         }
            //         if ($("#identity_type option[value='national_id']").length <= 0) {
            //             $('#identity_type').append(`<option value="national_id">` +
            //                 "{{ __('frontend.national_id') }}" + `</option>`);

            //             $("#identity_number_form").show();
            //             $("#identity_type").val('national_id');
            //             $("#identity_type").select2().select2('text', 'national_id');
            //         }
            //     } else {
            //         if ($("#identity_type option[value='resident_id']").length <= 0) {
            //             $('#identity_type').append(`<option value="resident_id">` +
            //                 "{{ __('frontend.resident_id') }}" + `</option>`);
            //         }

            //         if ($("#identity_type option[value='passport']").length <= 0) {
            //             $('#identity_type').append(`<option value="passport">` +
            //                 "{{ __('frontend.passport') }}" + `</option>`);
            //         }

            //         if ($("#identity_type option[value='non_resident']").length <= 0) {
            //             $('#identity_type').append(`<option value="non_resident">` +
            //                 "{{ __('frontend.non_resident') }}" + `</option>`);
            //         }

            //         if ($("#identity_type option[value='national_id']").length > 0) {
            //             $("#identity_type option[value='national_id']").remove();
            //         }
            //     }
            // });

            // $(document).on('change','#identity_type',function(event) {
            //     console.log('sss');
            //     if ($('#identity_type').val() == 'non_resident') {
            //         $('#identity_number').prop('required', false);
            //         $("#identity_number_form").hide();
            //     } else {
            //         $('#identity_number').prop('required', true);
            //         $("#identity_number_form").show();

            //     }


            //     if ($('#identity_type').val() == 'passport') {
            //         $("#identity_number_label").html(
            //             "{{ app()->getLocale() == 'en' ? 'Passport Number' : 'رقم جواز السفر' }}");
            //         $("#identity_number").prop('placeholder',
            //             "{{ app()->getLocale() == 'en' ? 'Passport Number' : 'رقم جواز السفر' }}");
            //     } else {
            //         $("#identity_number_label").html(
            //             "{{ app()->getLocale() == 'en' ? 'Identify Number' : 'رقم الهوية' }}");
            //         $("#identity_number").prop('placeholder',
            //             "{{ app()->getLocale() == 'en' ? 'Identify Number' : 'رقم الهوية' }}");
            //     }
            // });
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
                <select class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }} sub_specialty_id"  name="sub_specialty_id" id="sub_specialty_id" required>
                `;
                        for (let index = 0; index < data.length; index++) {
                            const element = data[index];
                            subuser += `<option value="` + element.id +
                                `" ${selected == element.id ? 'selected' : ''}>` + element.name + `</option>`
                        }

                        subuser += `</select>`;
                        $('.sub_specialty_id').remove();
                        $('#subs').append(subuser);
                        $('#subs').show();

                    }
                });
            }

            switch (id) {
                case '9':
                    $('.occupational_classification_number').hide();
                    $('#occupational_classification_number').val('');
                    $('#occupational_classification_number').prop('required', false);
                    break;
                case '10':
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
{{--    <script>--}}
{{--        function get_cities(selected = null) {--}}
{{--            var id = $('#nationality_id').val();--}}

{{--            if (id) {--}}
{{--                $.ajax({--}}
{{--                    type: "GET",--}}
{{--                    dataType: "json",--}}
{{--                    url: '/{{ app()->getLocale() }}/get_city/' + id,--}}
{{--                    success: function(data) {--}}
{{--                        var subcountry = `--}}
{{--                <select class="form-control {{ $errors->has('nationality_id') ? 'is-invalid' : '' }} city_id"  name="city" id="city_id" >--}}
{{--                `;--}}
{{--                        for (let index = 0; index < data.length; index++) {--}}
{{--                            const element = data[index];--}}
{{--                            subcountry += `<option value="` + element.id +--}}
{{--                                `" ${selected == element.id ? 'selected' : ''}>` + element.name + `</option>`--}}
{{--                        }--}}

{{--                        subcountry += `</select>`;--}}
{{--                        $('.city_id').remove();--}}
{{--                        $('#city').append(subcountry);--}}
{{--                        $('#city').show();--}}

{{--                    }--}}
{{--                });--}}
{{--            }--}}


{{--        }--}}

{{--        @if (old('nationality_id'))--}}
{{--        get_cities({{ old('city_id') ?? null }})--}}
{{--        @endif--}}
{{--    </script>--}}
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
                            $('.termis-data').html(data.data.page_text_ar ? data.data.page_text_ar :
                                "there is no data check the admin");
                            $('.andcondations-nd').show();
                        @else
                            $('.termis-data').html(data.data.page_text ? data.data.page_text :
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
    <script>
        function removeSpecialCharacters(input) {
            // Use a regular expression to match all non-alphanumeric characters
            const regex = /[^a-zA-Z0-9]/g;

            // Use the replace method to remove all matches
            const result = input.replace(regex, '');

            return result;
        }
        $('#occupational_classification_number').keyup(function (){
            var value = $(this).val();
            var new_value= removeSpecialCharacters(value);
            $(this).val(new_value)
        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
@endsection
