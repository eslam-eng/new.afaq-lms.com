<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_lang" content="{{ app()->getLocale() }}">

    <title>{{ trans('panel.site_title') }}</title>

    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('afaq\logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- END: Vendor CSS-->
    @if(app()->getLocale() == 'ar')
    @php($css = 'css-rtl')
    @else
    @php($css = 'css')
    @endif

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/'.$css.'/plugins/forms/wizard.css')}}">


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
    <style>
        .navbar-header {
            padding-right: 2px !important;
            padding-left: 2px !important;
        }

        fieldset {
            height: 400px;
        }

        /*** GENERAL STYLES ***/
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        #page h1 {
            margin-bottom: 4rem;
            font-family: 'Lemonada', cursive;
            text-transform: uppercase;
            font-weight: normal;
            color: #fff;
            font-size: 2rem;
        }

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
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static {{app()->getLocale() =='en' ? 'ltr' : 'rtl'}} " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    @include('partials.nav')
    @include('partials.menu')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <main class="c-main">


                    <div class="container-fluid">
                        @if(session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                            </div>
                        </div>
                        @endif

                        @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @yield('content')

                    </div>


                </main>
                <!-- Form wizard with number tabs section start -->
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ trans('global.create') }} {{ trans('cruds.course.title_singular') }}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="course_form" method="POST" class="number-tab-steps wizard-circle" action="{{ route("admin.courses.store") }}" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Step 1 -->
                                            <h6>Step 1</h6>
                                            <fieldset>
                                                <div class="row col-11">
                                                    <div class="form-group col-12">
                                                        <label class="required label-waves-effect required" style="position:relative; top:0;" for="category_id">{{ trans('cruds.course.fields.category') }}</label>
                                                        <i>*</i>

                                                        <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"  name="category_id" id="category_id" required>
                                                            @foreach($categories as $id => $entry)
                                                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('category'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('category') }}
                                                        </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.course.fields.category_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="required label-waves-effect" style="position:relative; top:0;" for="name_en">{{ trans('cruds.course.fields.name_en') }}</label>
                                                        <i>*</i>
                                                        <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                                                        @if($errors->has('name_en'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name_en') }}
                                                        </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.course.fields.name_en_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label class="required label-waves-effect" style="position:relative; top:0;" for="name_ar">{{ trans('cruds.course.fields.name_ar') }}</label>
                                                        <i>*</i>
                                                        <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                                                        @if($errors->has('name_ar'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name_ar') }}
                                                        </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.course.fields.name_ar_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label class="label-waves-effect" style="position:relative; top:0;" for="certificate_id ">{{ trans('cruds.course.fields.certificate') }}</label>
                                                        <select class="form-control select2 {{ $errors->has('certificate') ? 'is-invalid' : '' }}" multiple name="certificate_id[]" id="certificate_id">
                                                            @foreach($certificates as $cert)
                                                            <option value="{{ $cert->id }}" {{ old('certificate_id') == $cert->id ? 'selected' : '' }}>{{ $cert->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('certificate'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('certificate') }}
                                                        </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.course.fields.certificate_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label class="label-waves-effect" style="position:relative; top:0;" for="instructor_id ">{{ trans('cruds.course.fields.instructor') }}</label>
                                                        <!-- <div style="padding-bottom: 4px">
                                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                                            </div> -->

                                                        <select style="width: 100%;" class="form-control select2 {{ $errors->has('instructor') ? 'is-invalid' : '' }}" name="instructor_id[]" id="instructor_id[]" multiple>
                                                            @foreach($course_instructor as $id => $entry)
                                                            <option value="{{ $id }}" {{ old('instructor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('instructor'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('instructor') }}
                                                        </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.course.fields.instructor_helper') }}</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- Step 2 -->
                                            <h6>Step 2</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="required label-waves-effect" style="position:relative; top:0;">{{ trans('cruds.course.fields.accreditation') }}</label>
                                                            <i>*</i>
                                                            @foreach(App\Models\Course::ACCREDITATION_RADIO as $key => $label)
                                                            <div class="form-check {{ $errors->has('accreditation') ? 'is-invalid' : '' }}">
                                                                <input class="form-check-input" type="radio" id="accreditation_{{ $key }}" name="accreditation" value="{{ $key }}" {{ old('accreditation', '') === (string) $key ? 'checked' : '' }} required>
                                                                <label class="form-check-label" for="accreditation_{{ $key }}">{{ trans('cruds.course.fields.'.$label)  }}</label>

                                                            </div>
                                                            @endforeach
                                                            @if($errors->has('accreditation'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('accreditation') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.accreditation_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label-waves-effect" style="position:relative; top:0;" for="accreditation_number ">{{ trans('cruds.course.fields.accreditation_number') }}</label>
                                                            <input class="form-control {{ $errors->has('accreditation_number') ? 'is-invalid' : '' }}" type="number" name="accreditation_number" id="accreditation_number" value="{{ old('accreditation_number', '') }}" step="1">
                                                            @if($errors->has('accreditation_number'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('accreditation_number') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.accreditation_number_helper') }}</span>
                                                        </div>
                                                        <div style="display: none;" id="show-me" class="form-group">
                                                            <label class="label-waves-effect" style="position:relative; top:0;" for="course_sub_specialty_id ">{{ trans('cruds.course.fields.course_sub_specialty') }}</label>
                                                            <div style="padding-bottom: 4px">
                                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                                            </div>
                                                            <select class="form-control select2 {{ $errors->has('course_sub_specialty') ? 'is-invalid' : '' }}" name="course_sub_specialty_id[]" id="course_sub_specialty_id" multiple>
                                                                @foreach($course_sub_specialties as $id => $entry)
                                                                <option value="{{ $id }}" {{ old('course_sub_specialty_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('course_sub_specialty'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('course_sub_specialty') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.course_sub_specialty_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="required label-waves-effect" style="position:relative; top:0;" for="price">{{ trans('cruds.course.fields.price') }}</label>
                                                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="1">
                                                            @if($errors->has('price'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('price') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.price_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- Step 3 -->
                                            <h6>Step 3</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label class="label-waves-effect" style="position:relative; top:0;" class="required " for="description_en">{{ trans('cruds.course.fields.description_en') }}</label>
                                                                <i>*</i>
                                                                <textarea class="form-control ckeditor {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en" id="description_en">{{ old('description_en') }}</textarea>
                                                                @if($errors->has('description_en'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('description_en') }}
                                                                </div>
                                                                @endif
                                                                <span class="help-block">{{ trans('cruds.course.fields.description_en_helper') }}</span>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label class="required label-waves-effect" style="position:relative; top:0;" for="description_ar">{{ trans('cruds.course.fields.description_ar') }}</label>
                                                               <i>*</i>
                                                                <textarea class="form-control ckeditor {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" id="description_ar">{{ old('description_ar') }}</textarea>
                                                                @if($errors->has('description_ar'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('description_ar') }}
                                                                </div>
                                                                @endif
                                                                <span class="help-block">{{ trans('cruds.course.fields.description_ar_helper') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <h6>Step 4</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="required label-waves-effect" style="position:relative; top:0;" for="image_title_en">{{ trans('cruds.course.fields.image_title_en') }}</label>
                                                            <input class="form-control {{ $errors->has('image_title_en') ? 'is-invalid' : '' }}" type="text" name="image_title_en" id="image_title_en" value="{{ old('image_title_en', '') }}" required>
                                                            @if($errors->has('image_title_en'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('image_title_en') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.image_title_en_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label-waves-effect" style="position:relative; top:0;" for="image_title_ar ">{{ trans('cruds.course.fields.image_title_ar') }}</label>
                                                            <i>*</i>
                                                            <input class="form-control {{ $errors->has('image_title_ar') ? 'is-invalid' : '' }}" type="text" name="image_title_ar" id="image_title_ar" value="{{ old('image_title_ar', '') }}">
                                                            @if($errors->has('image_title_ar'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('image_title_ar') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.image_title_ar_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label-waves-effect" style="position:relative; top:0;" for="introduction_to_course_en ">{{ trans('cruds.course.fields.introduction_to_course_en') }}</label>
                                                            <textarea class="form-control  {{ $errors->has('introduction_to_course_en') ? 'is-invalid' : '' }}" name="introduction_to_course_en" id="introduction_to_course_en">{!! old('introduction_to_course_en') !!}</textarea>
                                                            @if($errors->has('introduction_to_course_en'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('introduction_to_course_en') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.introduction_to_course_en_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label-waves-effect" style="position:relative; top:0;" for="introduction_to_course_ar ">{{ trans('cruds.course.fields.introduction_to_course_ar') }}</label>
                                                            <textarea class="form-control  {{ $errors->has('introduction_to_course_ar') ? 'is-invalid' : '' }}" name="introduction_to_course_ar" id="introduction_to_course_ar">{!! old('introduction_to_course_ar') !!}</textarea>
                                                            @if($errors->has('introduction_to_course_ar'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('introduction_to_course_ar') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.introduction_to_course_ar_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <h6>Step 5</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row col-12">
                                                            <div class="form-group col-6">
                                                                <label class="required label-waves-effect" style="position:relative; top:0;" for="start_date">{{ trans('cruds.course.fields.start_date') }}</label>
                                                              <i>*</i>
                                                                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                                                                @if($errors->has('start_date'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('start_date') }}
                                                                </div>
                                                                @endif
                                                                <span class="help-block">{{ trans('cruds.course.fields.start_date_helper') }}</span>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label class="required label-waves-effect" style="position:relative; top:0;" for="end_date">{{ trans('cruds.course.fields.end_date') }}</label>
                                                                <i>*</i>
                                                                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                                                                @if($errors->has('end_date'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('end_date') }}
                                                                </div>
                                                                @endif
                                                                <span class="help-block">{{ trans('cruds.course.fields.end_date_helper') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row col-12">
                                                            <div class="form-group col-6">
                                                                <label class="required label-waves-effect" style="position:relative; top:0;" for="start_register_date">{{ trans('cruds.course.fields.start_register_date') }}</label>
                                                                <i>*</i>
                                                                <input class="form-control date {{ $errors->has('start_register_date') ? 'is-invalid' : '' }}" type="date" name="start_register_date" id="start_register_date" value="{{ old('start_register_date') }}" required>
                                                                @if($errors->has('start_register_date'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('start_register_date') }}
                                                                </div>
                                                                @endif
                                                                <span class="help-block">{{ trans('cruds.course.fields.start_register_date_helper') }}</span>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label class="required label-waves-effect" style="position:relative; top:0;" for="end_register_date">{{ trans('cruds.course.fields.end_register_date') }}</label>
                                                                <i>*</i>
                                                                <input class="form-control date {{ $errors->has('end_register_date') ? 'is-invalid' : '' }}" type="date" name="end_register_date" id="end_register_date" value="{{ old('end_register_date') }}" required>
                                                                @if($errors->has('end_register_date'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('end_register_date') }}
                                                                </div>
                                                                @endif
                                                                <span class="help-block">{{ trans('cruds.course.fields.end_register_date_helper') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row col-12">

                                                            <div class="form-group col-12">
                                                                <label class="required label-waves-effect" style="position:relative; top:0;" for="early_register_date">{{ trans('cruds.course.fields.early_register_date') }}</label>
                                                                <i>*</i>
                                                                <input class="form-control date {{ $errors->has('early_register_date') ? 'is-invalid' : '' }}" type="date" name="early_register_date" id="early_register_date" value="{{ old('early_register_date') }}" required>
                                                                @if($errors->has('early_register_date'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('early_register_date') }}
                                                                </div>
                                                                @endif
                                                                <span class="help-block">{{ trans('cruds.course.fields.end_date_helper') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <h6>Step 6</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="required label-waves-effect" style="position:relative; top:0;" for="certificate_price">{{ trans('cruds.course.fields.certificate_price') }}</label>
                                                            <input class="form-control {{ $errors->has('certificate_price') ? 'is-invalid' : '' }}" type="number" name="certificate_price" id="certificate_price" value="{{ old('certificate_price', '') }}" step="1" required>
                                                            @if($errors->has('certificate_price'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('certificate_price') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.certificate_price_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{ trans('cruds.course.fields.course_place') }}</label>
                                                            <select class="form-control {{ $errors->has('course_place') ? 'is-invalid' : '' }}" name="course_place" id="course_place" onchange="showfield(this.options[this.selectedIndex].value)">
                                                                <option value disabled {{ old('course_place', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                                @foreach(App\Models\Course::COURSE_PLACE_SELECT as $key => $label)
                                                                <option value="{{ $key }}" {{ old('course_place', '') === (string) $key ? 'selected' : '' }}>{{ trans('cruds.course.fields.'.$label)  }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('course_place'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('course_place') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.course_place_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="required label-waves-effect" style="position:relative; top:0;">{{ trans('cruds.course.fields.training_type') }}</label>
                                                           <i>*</i>
                                                            @foreach(App\Models\Course::TRAINING_TYPE_RADIO as $key => $label)
                                                            <div class="form-check {{ $errors->has('training_type') ? 'is-invalid' : '' }}">
                                                                <input class="form-check-input" type="radio" id="training_type_{{ $key }}" name="training_type" value="{{ $key }}" {{ old('training_type', '') === (string) $key ? 'checked' : '' }} required>
                                                                <label class="form-check-label" for="training_type_{{ $key }}">{{ trans('cruds.course.fields.'.$label)  }}</label>
                                                            </div>
                                                            @endforeach
                                                            @if($errors->has('training_type'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('training_type') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.training_type_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <h6>Step 7</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="required label-waves-effect" style="position:relative; top:0;" for="lecture_hours">{{ trans('cruds.course.fields.lecture_hours') }}</label>
                                                            <i>*</i>
                                                            <input class="form-control {{ $errors->has('lecture_hours') ? 'is-invalid' : '' }}" type="number" name="lecture_hours" id="lecture_hours" value="{{ old('lecture_hours', '') }}" step="1" required>
                                                            @if($errors->has('lecture_hours'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('lecture_hours') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.lecture_hours_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="required label-waves-effect" style="position:relative; top:0;" for="seating_number">{{ trans('cruds.course.fields.seating_number') }}</label>
                                                           <i>*</i>
                                                            <input class="form-control {{ $errors->has('seating_number') ? 'is-invalid' : '' }}" type="number" name="seating_number" id="seating_number" value="{{ old('seating_number', '') }}" step="1" required>
                                                            @if($errors->has('seating_number'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('seating_number') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.seating_number_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label-waves-effect" style="position:relative; top:0;" for="target_group_id ">{{ trans('cruds.course.fields.target_group') }}</label>
                                                            <!-- <div style="padding-bottom: 4px">
                                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                                            </div> -->
                                                            <select style="width: 100%;" class="form-control select2 {{ $errors->has('target_group') ? 'is-invalid' : '' }}" name="target_group_id[]" multiple id="target_group_id">
                                                                @foreach($target_groups as $id => $entry)
                                                                <option value="{{ $id }}" {{ old('target_group_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('target_group'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('target_group') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.target_group_helper') }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label-waves-effect" style="position:relative; top:0;">{{ trans('cruds.course.fields.course_accreditation_sponsor') }}</label>
                                                            <!-- <div style="padding-bottom: 4px">
                                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                                            </div> -->
                                                            <select style="width: 100%;" class="form-control select2 {{ $errors->has('course_accreditation_sponsor') ? 'is-invalid' : '' }}" name="course_accreditation_sponsor[]" id="course_accreditation_sponsor" multiple>
                                                                @foreach($accreditation_sponsor as $key => $label)
                                                                <option value="{{ $key }}" {{ old('course_accreditation_sponsor', '') === (string) $key ? 'selected' : '' }}>{{ $label  }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('course_accreditation_sponsor'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('course_accreditation_sponsor') }}
                                                            </div>
                                                            @endif
                                                            <span class="help-block">{{ trans('cruds.course.fields.course_accreditation_sponsor_helper') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <h6>Step 8</h6>
                                            <fieldset>
                                                <div class="row col-12">
                                                    <div class="form-group wrap-custom-file">
                                                        <label class="required" for="image">{{ trans('cruds.course.fields.image') }}</label>
                                                        <input type="file" value="{{ old('image', '') }}" name="image" id="image" required accept=".gif, .jpg, .png" />required
                                                        <label for="image">
                                                            <span>Image For Arabic</span>
                                                            <i class="fa fa-plus-circle"></i>
                                                        </label>
                                                        @if($errors->has('image'))
                                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.blog.fields.image_helper') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-12">
                                                    <!-- <div style="padding-bottom: 4px">
                                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                                            </div> -->
                                                    <label class="label-waves-effect" style="position:relative; top:0;">{{ trans('cruds.course.fields.cooperate_accreditation_sponsor') }}</label>
                                                    <select style="width: 100%;" class="form-control select2  {{ $errors->has('cooperate_accreditation_sponsor') ? 'is-invalid' : '' }}" name="cooperate_accreditation_sponsor[]" id="cooperate_accreditation_sponsor" multiple>
                                                        @foreach($accreditation_sponsor as $key => $label)
                                                        <option value="{{ $key }}" {{ old('cooperate_accreditation_sponsor', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('cooperate_accreditation_sponsor'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('cooperate_accreditation_sponsor') }}
                                                    </div>
                                                    @endif
                                                    <span class="help-block">{{ trans('cruds.course.fields.cooperate_accreditation_sponsor_helper') }}</span>
                                                </div>
                                                <div class="form-group col-12">
                                                    <!-- <div style="padding-bottom: 4px">
                                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                                            </div> -->
                                                    <label>{{ trans('cruds.course.fields.hosting_cooperate_accreditation_sponsor') }}</label>
                                                    <select style="width: 100%;" class="form-control select2 {{ $errors->has('hosting_cooperate_accreditation_sponsor') ? 'is-invalid' : '' }}" name="hosting_cooperate_accreditation_sponsor[]" multiple id="hosting_cooperate_accreditation_sponsor">
                                                        @foreach($accreditation_sponsor as $key => $label)
                                                        <option value="{{ $key }}" {{ old('hosting_cooperate_accreditation_sponsor', '') === (string) $key ? 'selected' : '' }}>{{ $label  }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('hosting_cooperate_accreditation_sponsor'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('hosting_cooperate_accreditation_sponsor') }}
                                                    </div>
                                                    @endif
                                                    <span class="help-block">{{ trans('cruds.course.fields.hosting_cooperate_accreditation_sponsor_helper') }}</span>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>{{ trans('cruds.course.fields.status') }}</label>
                                                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                                                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                        @foreach(App\Models\Course::STATUS_SELECT as $key => $label)
                                                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ trans('cruds.course.fields.'.$label)  }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('status'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('status') }}
                                                    </div>
                                                    @endif
                                                    <span class="help-block">{{ trans('cruds.course.fields.status_helper') }}</span>
                                                </div>
                                                <!-- </div> -->
                                    </div>
                                    </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with number tabs section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <form id="logoutform" action="{{ route('logout' , ['locale', app()->getLocale()]) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('/app-assets/vendors/js/extensions/jquery.steps.min.js')}}"></script>
    <script src="{{asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('/app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('/app-assets/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('/app-assets/js/scripts/forms/wizard-steps.js')}}"></script>
    <!-- END: Page JS-->

    <script src="{{asset('/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('/app-assets/js/scripts/forms/form-select2.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/xdtvumic5spz8s20xfmw404uqqibaqka8var52dipy3hxwag/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>    <script>
        tinymce.init({
            selector: 'textarea.ckeditor',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            importcss_append: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 300,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
            valid_elements: '*[*]',
            extended_valid_elements: "style,link[href|rel]",
            custom_elements: "style,link,~link"
        });
    </script>
    <script>
        $(".select2").select2();
    </script>

    <script type="text/javascript">
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


</body>
<!-- END: Body-->

</html>
