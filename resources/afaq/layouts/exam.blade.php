<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('panel.site_title') }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{ asset('frontend/img/IDU LOGO-inverted-02.png') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link href="{{ asset('css/custom_exam.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/front.css') }}" rel="stylesheet" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />

    @yield('styles')
    <style>
        .noselect {
            -webkit-touch-callout: none;
            /* iOS Safari */
            -webkit-user-select: none;
            /* Safari */
            -khtml-user-select: none;
            /* Konqueror HTML */
            -moz-user-select: none;
            /* Old versions of Firefox */
            -ms-user-select: none;
            /* Internet Explorer/Edge */
            user-select: none;
            /* Non-prefixed version, currently
                                    supported by Chrome, Edge, Opera and Firefox */
        }

        @media print {

            html,
            body {
                display: none;
                /* hide whole page */
            }
        }

        * {
            zoom: 98%
        }
    </style>
</head>


<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page noselect">

    <div class="contentfloorlinks parbase section">
        <div class="content-floor-links relative-position  ">
            <div class="row title-bar">
                <div class="col-lg-3 col-md-5 hidden-sm hidden-xs">
                    <div class="title vertical-center-txt">
                        <h3 class="text-uppercase"><img src="{{ asset('frontend/img/IDU LOGO-inverted-02.png') }}" style="width: 120px;height:80px"></h3>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7 col-sm-12 col-xs-12">
                    <ul class="list-inline sub-cat-links">
                        <li>
                            <div>
                                <img src="{{ asset('frontend/img/IDU LOGO-inverted-02.png') }}" style="width: 100px;height:80px">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>
