@extends('layouts.admin')
@section('content')
    <style>
        /*** CUSTOM FILE INPUT STYE ***/
        .wrap-custom-file {
            position: relative;
            display: inline-block;
            width: 150px;
            height: 150px;
            margin: 0 0.5rem 1rem;
            text-align: center;
        }

        .wrap-custom-file input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 2px;
            height: 2px;
            overflow: hidden;
            opacity: 0;
        }

        .wrap-custom-file label {
            z-index: 1;
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            overflow: hidden;
            padding: 0 0.5rem;
            cursor: pointer;
            background-color: #fff;
            border-radius: 4px;
            -webkit-transition: -webkit-transform 0.4s;
            transition: -webkit-transform 0.4s;
            transition: transform 0.4s;
            transition: transform 0.4s, -webkit-transform 0.4s;
        }

        .wrap-custom-file label span {
            display: block;
            margin-top: 2rem;
            font-size: 1.4rem;
            color: #777;
            -webkit-transition: color 0.4s;
            transition: color 0.4s;
        }

        .wrap-custom-file label .fa {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            -webkit-transform: translatex(-50%);
            transform: translatex(-50%);
            font-size: 1.5rem;
            color: lightcoral;
            -webkit-transition: color 0.4s;
            transition: color 0.4s;
        }

        .wrap-custom-file label:hover {
            -webkit-transform: translateY(-1rem);
            transform: translateY(-1rem);
        }

        .wrap-custom-file label:hover span,
        .wrap-custom-file label:hover .fa {
            color: #333;
        }

        .wrap-custom-file label.file-ok {
            background-size: cover;
            background-position: center;
        }

        .wrap-custom-file label.file-ok span {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 0.3rem;
            font-size: 1.1rem;
            color: #000;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .wrap-custom-file label.file-ok .fa {
            display: none;
        }
    </style>
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="required" for="full_name_ar">{{ trans('frontend.register.Full Name Arabic') }}</label>
                            <input type="hidden" name="type" value="{{request('type', 'users')}}">
                            <input class="form-control {{ $errors->has('full_name_ar') ? 'is-invalid' : '' }}" type="text" name="full_name_ar" id="full_name_ar" value="{{ old('full_name_ar', '') }}" placeholder="{{ trans('frontend.register.Full Name Arabic') }}" required>
                            <div class="invalid-feedback"></div>
                            @if($errors->has('full_name_ar'))

                                <div class="invalid-feedback">
                                    "{{ $errors->first('full_name_ar') }}"
                                </div>

                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="required" for="full_name_en">{{ trans('frontend.register.Full Name English') }}</label>
                            <input class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}" type="text" name="full_name_en" id="full_name_en" minlength="3" maxlength="50" value="{{ old('full_name_en', '') }}" required placeholder="{{ trans('frontend.register.Full Name English') }}">
                            <div class="invalid-feedback"></div>

                            @if($errors->has('full_name_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('full_name_en') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">

                            <label class="required" for="name">{{ trans('frontend.register.Title') }}</label>
                            <select class="form-control col-auto d-inline {{ $errors->has('name_title') ? 'is-invalid' : '' }}" id="title" name="name_title" required>
                                <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                <option value="Mr." {{ old('name_title', '') == 'Mr.' ? 'selected' : ''}}>Mr.</option>
                                <option value="Ms." {{ old('name_title', '') == 'Ms.' ? 'selected' : ''}}>Ms.</option>
                                <option value="Dr." {{ old('name_title', '') == 'Dr.' ? 'selected' : ''}}>Dr.</option>
                                <option value="Prof." {{ old('name_title', '') == 'Prof.' ? 'selected' : ''}}>Prof.</option>
                            </select>
                            <div class="invalid-feedback"></div>

                            @if($errors->has('name_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_title') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="required" for="gender">{{ trans('frontend.register.gender') }}</label>
                            <select class="form-control col-auto d-inline {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender" name="gender" required>
                                <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                <option value="male" {{ old('gender', '') == 'male' ? 'selected' : ''}}>{{app()->getLocale()=='ar'?'ذكر':'Male'}} </option>
                                <option value="female" {{ old('gender', '') == 'female' ? 'selected' : ''}}>{{app()->getLocale()=='ar'?'أنثي':'Female'}}</option>
                            </select>
                            <div class="invalid-feedback"></div>

                            @if($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="required" for="nationality_id">{{ trans('frontend.register.nationality') }}</label>
                            <select class="form-control col-auto d-inline {{ $errors->has('nationality_id') ? 'is-invalid' : '' }}" id="nationality_id" name="nationality_id" required>
                                <option value=""> {{ trans('global.pleaseSelect') }}</option>

                                @foreach($countries as $item)
                                    <option value="{{$item->id}}" data-code="{{$item->country_code}}" {{ $item->id == old('nationality_id', '') ? 'selected' : ''}}>{{$item->nationality}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>

                            @if($errors->has('nationality_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nationality_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="required " for="name">{{ trans('frontend.register.identity_type') }}</label>
                            <select class="form-control col-auto d-inline  {{ $errors->has('identity_type') ? 'is-invalid' : '' }}" id="identity_type" name="identity_type" required>
                                <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                <option value="national_id" {{ old('identity_type', '') == 'national_id' ? 'selected' : '' }}>{{__('frontend.national_id')}}</option>
                                <option value="resident_id" {{ old('identity_type', '') == 'resident_id' ? 'selected' : '' }}>{{__('frontend.resident_id')}}</option>
                                <option value="passport" {{ old('identity_type', '') == 'passport' ? 'selected' : '' }}>{{__('frontend.passport')}}</option>
                                <option value="non_resident" {{ old('identity_type', '') == 'non_resident' ? 'selected' : '' }}>{{__('frontend.non_resident')}}</option>
                            </select>
                            <div class="invalid-feedback"></div>

                            @if($errors->has('identity_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('identity_type') }}
                                </div>
                            @endif
                        </div> --}}



                    {{-- </div> --}}
                    {{-- <div class="col-lg-6 col-md-12" id="identity_number_form">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('frontend.register.identity_number') }}</label>
                            <input type="number" id="identity_number" required name="identity_number" class="form-control{{ $errors->has('identity_number') ? ' is-invalid' : '' }}" placeholder="{{ trans('frontend.register.identity_number') }}" value="{{ old('identity_number', null) }}">
                            <div class="invalid-feedback"></div>

                            @if($errors->has('identity_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('identity_number') }}
                                </div>
                            @endif
                        </div>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="required">{{ trans('frontend.register.Field of your specialist study') }}</label>
                            <select onchange="get_sub_specialists()" class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id" required>
                                <option value disabled {{ old('specialty_id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach($specialists as $key => $label)
                                    <option value="{{ $key }}" {{ old('specialty_id', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>

                            @if($errors->has('specialty_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('specialty_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12" style="display: none;" id="sub">
                        <div class="form-group">
                            <label class="required">{{ trans('frontend.register.Field of your sub specialist study') }}</label>
                            <div id="subs"></div>
                            <div class="invalid-feedback"></div>

                            @if($errors->has('sub_specialty_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_specialty_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 occupational_classification_number">
                        <div class="form-group">
                            <label class=" d-block" for="occupational_classification_number">{{ trans('frontend.register.occupational_classification_number') }}</label>
                            <input class="form-control {{ $errors->has('occupational_classification_number') ? 'is-invalid' : '' }}" type="text" name="occupational_classification_number" id="occupational_classification_number" value="{{ old('occupational_classification_number', '') }}" placeholder="{{ trans('frontend.register.hint_helper') }}">
                            <div class="invalid-feedback"></div>

                            @if($errors->has('occupational_classification_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('occupational_classification_number') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class=" mb-3 form-group">
                            <label class="required d-block" for="name">{{ trans('frontend.register.Email') }}</label>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('frontend.register.Email') }}" value="{{ old('email', null) }}">
                            <div class="invalid-feedback"></div>

                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="required d-block" for="phone">{{ trans('frontend.register.Phone Number') }}</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                            <div class="invalid-feedback"></div>

                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group ">
                            <label class="required d-block" for="name">{{ trans('frontend.register.Password') }}</label>
                            <div class="d-flex justify-content-between align-items-center required">
                                <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required minlength="8" maxlength="50" placeholder="{{ trans('frontend.register.Password') }}">
                            </div>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                    <select style="width: 100%;" class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                        @foreach($roles as $id => $roles)
                            <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('roles'))
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                </div>

                <div class="form-group wrap-custom-file">
                    <label class="required" for="personal_photo">{{ trans('cruds.user.fields.personal_photo') }}</label>
                    <input type="file" name="personal_photo" id="personal_photo01" accept=".gif, .jpg, .png" />
                    <label for="personal_photo01">
                        <span>{{ trans('cruds.user.fields.personal_photo') }} </span>
                        <i class="fa fa-plus-circle"></i>
                    </label>
                    @if($errors->has('personal_photo'))
                        <span class="text-danger">{{ $errors->first('personal_photo') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.personal_photo_helper') }}</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $('input[type="file"]').each(function() {
            // Refs
            var $file = $(this),
                $label = $file.next('label'),
                $labelText = $label.find('span'),
                labelDefault = $labelText.text();

            // When a new file is selected
            $file.on('change', function(event) {
                var fileName = $file.val().split('\\').pop(),
                    tmppath = URL.createObjectURL(event.target.files[0]);
                //Check successfully selection
                if (fileName) {
                    $label
                        .addClass('file-ok')
                        .css('background-image', 'url(' + tmppath + ')');
                    $labelText.text(fileName);
                } else {
                    $label.removeClass('file-ok');
                    $labelText.text(labelDefault);
                }
            });

            // End loop of file input elements
        });
    </script>
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
                    $('#identity_type').append(`<option value="national_id">` + "{{__('frontend.national_id')}}" + `</option>`);

                    $("#identity_number_form").show();
                    $("#identity_type").val('national_id');
                    $("#identity_type").select2().select2('text', 'national_id');
                }
            }

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
                        $('#identity_type').append(`<option value="national_id">` + "{{__('frontend.national_id')}}" + `</option>`);

                        $("#identity_number_form").show();
                        $("#identity_type").val('national_id');
                        $("#identity_type").select2().select2('text', 'national_id');
                    }
                } else {
                    if ($("#identity_type option[value='resident_id']").length <= 0) {
                        $('#identity_type').append(`<option value="resident_id">` + "{{__('frontend.resident_id')}}" + `</option>`);
                    }

                    if ($("#identity_type option[value='passport']").length <= 0) {
                        $('#identity_type').append(`<option value="passport">` + "{{__('frontend.passport')}}" + `</option>`);
                    }

                    if ($("#identity_type option[value='non_resident']").length <= 0) {
                        $('#identity_type').append(`<option value="non_resident">` + "{{__('frontend.non_resident')}}" + `</option>`);
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
                    $("#identity_number_label").html("{{ app()->getLocale() == 'en' ? 'Passport Number' : 'رقم جواز السفر' }}");
                    $("#identity_number").prop('placeholder', "{{ app()->getLocale() == 'en' ? 'Passport Number' : 'رقم جواز السفر' }}");
                } else {
                    $("#identity_number_label").html("{{ app()->getLocale() == 'en' ? 'Identify Number' : 'رقم الهوية' }}");
                    $("#identity_number").prop('placeholder', "{{ app()->getLocale() == 'en' ? 'Identify Number' : 'رقم الهوية' }}");
                }
            });
        });

        function get_sub_specialists() {
            var id = $('#specialty_id').val();
            if (id) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/{{app()->getLocale()}}/get_specialty/' + id,
                    success: function(data) {
                        var subuser = `
                <select class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}" name="sub_specialty_id" id="sub_specialty_id" required>
                `;
                        for (let index = 0; index < data.length; index++) {
                            const element = data[index];
                            subuser += `<option value="` + element.id + `">` + element.name + `</option>`
                        }

                        subuser += `</select>`;

                        $('#subs').html(subuser);
                        $('#sub').show();

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
    </script>
@endsection
