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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/css/bootstrap.min.css') }}">    <link rel="stylesheet" href="{{asset('frontend/css/normalize.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}" />
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.theme.default.min.css') }}">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

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
    <title>{{ trans('panel.site_title') }}</title>
    <link href="{{ asset('frontend/css/HomePage.css') }}?v={{time()}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/course_card.css') }}?v={{time()}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css ')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/cart_popup.css ')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">

    @yield('styles')
</head>

<body {{app()->getLocale() == 'ar' ?  'class=rtl': "class=ltr"}} >
    <div class="home-page">

         @include('frontend.partials.header')
        <!-- ********** end header ************** -->

        <!-- *********** end-slider ******************** -->
        @yield("content")
        <!-- *********** end-about-us ******************** -->
        {{-- All Category--}}
        <!-- *********** end-all-category ******************** -->
        {{-- OurWork--}}
        <!-- *********** end-our-work ******************** -->

        <!-- *********** end-Host-Your-Health-Event-For-Free ******************** -->
        {{-- Icon Text Descriptionlink--}}
        <!-- *********** end-our-work ******************** -->
        {{-- Blog--}}
        <!-- *********** end-Investing-for-Your-Future ******************** -->
        <!-- {{-- Partner--}} -->
        <!-- *********** end-Trusted-by ******************** -->

        <!-- *********** end-SUBSCRIBE-OUR-NEWSLETTER ******************** -->
        <!-- ********************* end page ********************************** -->

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
    <!-- ***************** all script ************************************** -->
    <script src="{{asset('afaq/assests/js/jquery3.7.0.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="{{asset('nazil/assests/js/jquery-3.4.0.js')}}"></script>
    <script src="{{asset('nazil/assests/js/mixitup.min.js')}}"></script>
    <script src="{{asset('nazil/assests/js/main.js')}}"></script>
    <script src="{{asset('frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/js/hover-card.js')}}"></script>
    <script src="{{asset('frontend/js/cart_popup.js')}}"></script>
    <script src="{{ asset('afaq/new-assets/js/bootstrap.min.js') }}"></script>
    <script>
        // new WOW().init();
    </script>
       @yield('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/jquery.flexslider.min.js" integrity="sha512-M3wq5WV8hxDfr57VnaB8R3j7TK1dTBwwTWCemilGC1b1bk447mxw8v7t0ImJ0z4pfRVlVcwODbkQbkWiCQGh0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.js') }}"></script>

</body>

</html>
