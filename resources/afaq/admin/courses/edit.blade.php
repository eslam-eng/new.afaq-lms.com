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
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- END: Vendor CSS-->
    @if (app()->getLocale() == 'ar')
        @php($css = 'css-rtl')
    @else
        @php($css = 'css')
    @endif

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/' . $css . '/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/plugins/forms/wizard.css') }}">


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    <style>
        .navbar-header {
            padding-right: 2px !important;
            padding-left: 2px !important;
        }

        fieldset {
            height: auto;
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

        .wrap-custom-file label.file-ok .fa {
            display: none;
        }

        .select2-container {
            display: block !important;
        }

        .parsley-errors-list {
            list-style: none;
            padding: 0;
            color: red;
        }
        .custom-switch.switch-lg .custom-control-label{
            width: 7.5rem !important;
        }
        .custom-switch.switch-lg .custom-control-label::before{
            width: 7.5rem !important;
        }
        /* .custom-switch.switch-lg .custom-control-input:checked ~ .custom-control-label::after{
            transform: translateX(-5.8rem);
        } */
        #course_form i{
            color: red;
        }
    </style>
    @if(app()->getlocale() == 'ar')
    <style>
                .custom-switch.switch-lg .custom-control-input:checked ~ .custom-control-label::after{
            transform: translateX(-5.8rem);
        }
    </style>
    @else
     <style>
        .custom-switch.switch-lg .custom-control-input:checked ~ .custom-control-label::after{
            transform: translateX(5.8rem);
        }
     </style>
    @endif
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static {{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }} "
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

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
                        @if (session('message'))
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->count() > 0)
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
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
                                    <h4 class="card-title">{{ trans('global.edit') }}
                                        {{ trans('cruds.course.title_singular') }}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        {{-- <form id="course_form" method="POST" class="number-tab-steps wizard-circle" action="{{ route("admin.courses.store") }}" enctype="multipart/form-data"> --}}
                                        <form id="course_form" method="POST" class="number-tab-steps wizard-circle"
                                            action="{{ route('admin.courses.update', [$course->id]) }}"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            {{-- Step 1 --}}
                                            @include('admin.courses.updateSteps.stepOne')
                                            {{-- Step 2 --}}
                                            @include('admin.courses.updateSteps.stepTwo')
                                            {{-- Step 3 --}}
                                            @include('admin.courses.updateSteps.stepThree')
                                            {{-- Step 4 --}}
                                            @include('admin.courses.updateSteps.stepFour')

                                            {{-- Step 5 --}}
                                            @include('admin.courses.updateSteps.stepFive')

                                        </form>
                                    </div>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" class="lookups-form" enctype="multipart/form-data"
                        data-parsley-validate select-input-id="">
                        @csrf
                        <div class="form-group">
                            <label for="title_en">{{ trans('cruds.lookup.fields.name_en') }}</label>
                            <input class="form-control" {{ $errors->has('name_en') ? 'is-invalid' : '' }}
                                type="text" name="title_en" id="name_en" value="{{ old('name_en', '') }}" data-parsley-required-message="{{ trans('global.required') }}">
                            @if ($errors->has('name_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_en') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.lookup.fields.name_en_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name_ar">{{ trans('cruds.lookup.fields.name_ar') }}</label>
                            <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                type="text" name="title_ar" id="name_ar" value="{{ old('name_ar', '') }}"
                                required data-parsley-required-message="{{ trans('global.required') }}">
                            @if ($errors->has('name_ar'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_ar') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.lookup.fields.name_ar_helper') }}</span>
                        </div>

                        <input type="hidden" name="parent_id" class="parent-input">

                        <div class="form-group wrap-custom-file">
                            <label class="required" for="image">{{ trans('cruds.lookup.fields.image') }}</label>
                            <input type="file" value="{{ old('image', '') }}" name="image" id="image-lookup" data-parsley-required-message="{{ trans('global.required') }}"
                                accept=".gif, .jpg, .png" data-parsley-errors-container="#lookup_images_error" data-parsley-filemimetypes="image/jpeg, image/png" />required
                            <label for="image-lookup">
                                <span>Image</span>
                                <i class="fa fa-plus-circle"></i>
                            </label>
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lookup.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" onclick="storeLookup()" type="button">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('global.close')}}</button>
                    <button type="button" class="btn btn-primary">{{__('global.save')}}</button>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createInstructor" tabindex="-1" role="dialog"
        aria-labelledby="createInstructorLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createInstructorLabel">
                        {{ trans('global.create') }} {{ trans('cruds.instructor.title_singular') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="instructor-create" action="{{ route('admin.instructors.store') }}"
                        enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required" for="name_ar">{{ trans('cruds.instructor.fields.name_ar') }}</label>
                                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                                @if ($errors->has('name_ar'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_ar') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.instructor.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="name_en">{{ trans('cruds.instructor.fields.name_en') }}</label>
                                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                                @if ($errors->has('name_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name_en') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.instructor.fields.name_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="required"
                                for="mail">{{ trans('cruds.instructor.fields.mail') }}</label>
                            <input class="form-control {{ $errors->has('mail') ? 'is-invalid' : '' }}" type="email"
                                name="mail" id="mail" value="{{ old('mail', '') }}" required  data-parsley-required-message="{{ trans('global.required') }}">
                            @if ($errors->has('mail'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mail') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.instructor.fields.mail_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required"
                                for="password">{{ trans('cruds.instructor.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                type="password" name="password" id="password" required data-parsley-required-message="{{ trans('global.required') }}">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.instructor.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">{{ trans('cruds.instructor.fields.mobile') }}</label>
                            <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                            @if ($errors->has('mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.instructor.fields.mobile_helper') }}</span>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="bio_ar">{{ trans('cruds.instructor.fields.bio_ar') }}</label>
                                <textarea class="form-control {{ $errors->has('bio_ar') ? 'is-invalid' : '' }}" type="text" name="bio_ar" id="bio_ar" value="{{ old('bio_ar', '') }}"></textarea>
                                @if ($errors->has('bio_ar'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bio_ar') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.instructor.fields.mobile_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bio_en">{{ trans('cruds.instructor.fields.bio_en') }}</label>
                                <textarea class="form-control {{ $errors->has('bio_en') ? 'is-invalid' : '' }}" type="text" name="bio_en" id="bio_en" value="{{ old('bio_en', '') }}"></textarea>
                                @if ($errors->has('bio_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bio_en') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.instructor.fields.mobile_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group wrap-custom-file">
                            <label class="required"
                                for="image">{{ trans('cruds.instructor.fields.image') }}</label>
                            <input type="file" value="{{ old('image', '') }}" name="image" data-parsley-required-message="{{ trans('global.required') }}"
                                id="image-instractor" accept=".gif, .jpg, .png" />required
                            <label for="image-instractor">
                                <span>Image</span>
                                <i class="fa fa-plus-circle"></i>
                            </label>
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.instructor.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger sv-inst" type="button" onclick="storeInstructor()">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- END: Content-->

    <form id="logoutform" action="{{ route('logout', ['locale', app()->getLocale()]) }}" method="POST"
        style="display: none;">
        {{ csrf_field() }}
    </form>

    @include('admin.courses.update-scripts')
</body>
<!-- END: Body-->

</html>
