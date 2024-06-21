<?php
if (auth()->check()) {
    $cart = \App\Models\Cart::withCount('items')->where(['user_id' => auth()->user()->id, 'status' => 0])->first();
    if (!isset($cart->items_count)) {
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
    <title>{{ trans('panel.site_title') }}</title>

    <!-- EN start -->
    <meta name="theme-color" content="#014656" />
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('afaq/imgs/small-logo.png') }}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/regular.min.css" integrity="sha512-k2UAKyvfA7Xd/6FrOv5SG4Qr9h4p2oaeshXF99WO3zIpCsgTJ3YZELDK0gHdlJE5ls+Mbd5HL50b458z3meB/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('afaq/assests/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/normalize.css') }}" rel="stylesheet">

    <link href="{{ asset('afaq/assests/css/inner-style.css') }}?v={{time()}}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/topactivity-style.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/header-style.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://kit.fontawesome.com/aa91594180.js" crossorigin="anonymous"></script>
    <!-- EN end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="{{ asset('afaq/assests/css/course_card.css') }}?v={{time()}}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/cart_popup.css ')}}" rel="stylesheet">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
    <link href="{{ asset('afaq/assests/css/addtional.css')}}" rel="stylesheet">

    @yield('styles')
</head>


<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page {{app()->getLocale() == 'ar' ?  'rtl': 'ltr'}}">
    <!-- <body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page"> -->

    <!-- <div class="container">

    </div> -->
    <!-- ,[$ContentCategory] -->
    <div class="home-page-nd onregister-page">
        @yield("content")

    </div>

    {{-- @if (auth()->check() && $cart)
    <div class="fixed_cart_icon cart_popup" onclick="openCartPopup()">
        <img src="{{asset('nazil/imgs/cart-afaq.svg')}}" alt="cart">
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
    @endif --}}

    <script src="{{asset('afaq/assests/js/jquery3.7.0.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="{{asset('afaq/assests/js/mixitup.min.js')}}"></script>
    <script>
        var langRtl = {{ app()->getLocale() == 'ar' ? 1 : 0 }}
    </script>
    <script src="{{asset('afaq/assests/js/main.js')}}"></script>
    <script src="{{ asset('afaq/new-assets/js/bootstrap.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/jquery.flexslider.min.js" integrity="sha512-M3wq5WV8hxDfr57VnaB8R3j7TK1dTBwwTWCemilGC1b1bk447mxw8v7t0ImJ0z4pfRVlVcwODbkQbkWiCQGh0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>

    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/jquery.flexslider.min.js" integrity="sha512-M3wq5WV8hxDfr57VnaB8R3j7TK1dTBwwTWCemilGC1b1bk447mxw8v7t0ImJ0z4pfRVlVcwODbkQbkWiCQGh0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</body>

</html>
