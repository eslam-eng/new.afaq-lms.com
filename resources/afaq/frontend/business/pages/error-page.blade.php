<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('afaq/business/new-assests/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/business/new-assests/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/business/new-assests/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/business/css/bopup-massage-style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-VhBcF/php0Z/P5ZxlxaEx1GwqTQVIBu4G4giRWxTKOCjTxsPFETUDdVL5B6vYvOt" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Tajawal:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.css"
        integrity="sha512-zar81H5lVN36QFsq/da1hxpOLODXK4/oFwBGOFrvdWX6SBe3NWriWTQS6YQDVfW5fDeb2Vry41YQCELOe8cHww=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <title>AfAQ</title>
</head>


<body>
    <main class="home-page log-in-page">
        <section class="login-page">
            <div class="log-layer">
                <img  src="{{asset('afaq/business/imgs/Group 43428@2x.png')}}" alt="">
            </div>
            <div class="log-in-form">
                <div class="login-main main-body successful-bopup">
                    <div class="close-form">
                        <a href="{{route('business-home',['locale'=>app()->getLocale()])}}"><i class="fa-solid fa-xmark"></i></a>
                    </div>
{{--                    <div class="main-b-successful">--}}
{{--                        <div class="img-popup">--}}
{{--                            <img src="{{asset('afaq/business/imgs/Group 43499.svg')}}" class="successful-img"  alt="">--}}
{{--                        </div>--}}
{{--                        <strong>Successful</strong>--}}
{{--                        <p>You can see the best venues that suit your need</p>--}}
{{--                        <b></b>--}}
{{--                        <button class="next-page successful-btn">--}}
{{--                            <span> go to the next</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
                     <!-- ********************** warning-card******************  -->
{{--                    <div class="main-b-warning">--}}
{{--                        <div class="img-popup">--}}
{{--                            <img  src="{{asset('afaq/business/imgs/Group 43506.svg')}}" class="warning-img"  alt="">--}}

{{--                        </div>--}}
{{--                        <strong>{{__('afaq.warning')}}</strong>--}}
{{--                        <p>{{__('afaq.warning_desc')}} </p>--}}
{{--                        <b></b>--}}

{{--                        <a href="{{ url(app()->getLocale() . '/business-package_details') }}">--}}
{{--                        <button class="next-page warning-btn">--}}

{{--                            <span>{{__('afaq.try_again')}}</span>--}}

{{--                        </button>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    <!-- ********************** error-card******************  -->
                    <div class="main-b-successful">
                        <div class="img-popup">
{{--                            <img src="imgs/Group 43506 (1).svg" class="error-img"  alt="">--}}
                            <img  src="{{asset('afaq/business/imgs/Group 43506 (1).svg')}}" class="error-img"  alt="">

                        </div>
                        <strong>{{__('afaq.error')}}</strong>
                        <p>{{__('afaq.error_desc')}}</p>
                        <b></b>
                        <button class="next-page error-btn"
                            onclick="window.location.href='{{ route('business-home', ['locale' => app()->getLocale()]) }}'">
                            <span> {{__('afaq.try_again')}}</span>
                        </button>


                    </div>
                        <!-- ********************** reminder-card******************  -->
{{--                        <div class="main-b-successful">--}}
{{--                            <div class="img-popup">--}}
{{--                                <img src="imgs/Group 43506 (2).svg" class="reminder-img"  alt="">--}}
{{--                            </div>--}}
{{--                            <strong>Reminder</strong>--}}
{{--                            <p>You can see the best venues that suit your need</p>--}}
{{--                            <b></b>--}}
{{--                            <button class="next-page reminder-btn">--}}
{{--                                <span> ok</span>--}}
{{--                            </button>--}}
{{--                        </div> --}}
                </div>
            </div>
        </section>
    </main>


    <!-- ********************************** -->
    <script src="{{asset('afaq/business/new-assests/jquery3.7.0.js')}}"></script>
    <script src="{{asset('afaq/business/new-assests/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('afaq/business/new-assests/owl-carousel/owl.carousel.min.js')}}"></script>
    <!-- ***************** all script ************************************** -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.8/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.min.js"
        integrity="sha512-+z66PuMP/eeemN2MgRhPvI3G15FOBbsp5NcCJBojg6dZBEFL0Zoi0PEGkhjubEcQF7N1EpTX15LZvfuw+Ej95Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/24317918e9.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="{{asset('afaq/business/js/main.js')}}"></script>
</body>
