<?php
    if (auth()->check()) {
        $cart = \App\Models\Cart::withCount('items')->where(['user_id' => auth()->user()->id, 'status' => 0])->first();
        if(!isset($cart->items_count)){
            $cart = null;
        }
    } else {
        $cart = null;
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="lang" content="{{ app()->getLocale() }}">
    @yield('head')
    <title>@yield('title')</title>

    <!-- EN start -->
    <meta name="theme-color" content="#014656" />
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('afaq/logo.png') }}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/iduniGrid.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}?v={{time()}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/footer.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://kit.fontawesome.com/aa91594180.js" crossorigin="anonymous"></script>
    <!-- EN end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="{{ asset('frontend/css/responsive.css ')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/course_card.css') }}?v={{time()}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/cart_popup.css ')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    @yield('styles')
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page {{app()->getLocale() == 'ar' ?  'rtl': 'ltr'}}">
<!-- <body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page"> -->
    @include('frontend.partials.inner-header')

    <!-- <div class="container">

    </div> -->
    <!-- ,[$ContentCategory] -->
    <div class="home-page-nd onregister-page">

        @yield("content")

    </div>

    @if (auth()->check() && $cart)
    <div class="fixed_cart_icon cart_popup" onclick="openCartPopup()">
        <img src="{{asset('nazil/imgs/cart.png')}}" alt="cart">
        <div class="popup_cart_count">
            {{$cart ? count($cart->items) : 0}}
        </div>
    </div>
    <div class="cart_popup_text" id="cartPopup">
        <h4>
            {{__('global.your_shopping_cart')}}
        </h4>

        <i class="fa-solid fa-xmark" onclick="openCartPopup()"></i>
        @include('frontend.cart_popup_page')

    </div>
    @endif

    @include('frontend.partials.footer')
    <script src="{{asset('afaq/assests/js/jquery3.7.0.js')}}"></script>
    {{-- <script src="{{asset('nazil/assests/js/jquery-3.4.0.js')}}"></script> --}}
    <script src="{{asset('nazil/assests/js/mixitup.min.js')}}"></script>
    <script src="{{asset('nazil/assests/js/main.js')}}"></script>
{{--    <script src="{{asset('nazil/assests/css/wow.min.js')}}"></script>--}}

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }} "></script>
    <script src="{{ asset('afaq/new-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}?v=2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <!-- <script src="{{ asset('js/main.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.counterup/1.0/jquery.counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="{{asset('frontend/js/hover-card.js')}}"></script>
    <script src="{{asset('frontend/js/cart_popup.js')}}"></script>
    <script src="{{asset('frontend/js/share_course.js')}}"></script>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{asset('frontend/js/wallet.js')}}"></script>

    <script>
        $('.counter.new-offer-lms').counterUp({
            delay: 100,
            time: 2000
        });

        function updateQueryStringParameter(url, key, value) {
            if (!url) {
                uri = window.location.href;
            } else {
                uri = url;
            }

            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }

        function cleanUrl() {
            var uri = window.location.href.toString();
            if (uri.indexOf("?") > 0) {
                var clean_uri = uri.substring(0, uri.indexOf("?"));
                window.history.replaceState({}, document.title, clean_uri);
            }
        }
    </script>



    <script>
        @if(Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
        @endif


        @if($errors->count() > 0)
        @foreach($errors->all() as $error)
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{$error}}");
        @endforeach
        @endif




        const ua = navigator.userAgent;
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
            console.log("tablet");
        } else if (/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
            console.log("mobile");
        } else {
            console.log("desktop");
        }
    </script>
    @yield('scripts')
</body>

</html>
