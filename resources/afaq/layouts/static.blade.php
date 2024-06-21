<?php
if (auth()->check()) {
    $cart = \App\Models\Cart::withCount('items')
        ->where(['user_id' => auth()->user()->id, 'status' => 0])
        ->first();
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
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="lang" content="{{ app()->getLocale() }}">
    <title>@yield('title')</title>
    <meta name="description" content="{{__('global.meta_description')}}">

    <!-- EN start -->
    <meta name="theme-color" content="#014656" />
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('afaq/imgs/small-logo.png') }}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/regular.min.css"
        integrity="sha512-k2UAKyvfA7Xd/6FrOv5SG4Qr9h4p2oaeshXF99WO3zIpCsgTJ3YZELDK0gHdlJE5ls+Mbd5HL50b458z3meB/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('afaq/assests/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/normalize.css') }}" rel="stylesheet">

    <link href="{{ asset('afaq/assests/css/style.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/topactivity-style.css') }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/header-style.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://kit.fontawesome.com/aa91594180.js" crossorigin="anonymous"></script>
    <!-- EN end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="{{ asset('afaq/assests/css/course_card.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('afaq/assests/css/cart_popup.css ') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;1,300&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&display=swap"
        rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css"
        rel="stylesheet" />
    <title>{{ trans('panel.site_title') }} </title>
    <link href="{{ asset('afaq/assests/css/addtional.css') }}" rel="stylesheet">
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '5777079249067527');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=5777079249067527&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <!-- Snap Pixel Code -->
    <script type='text/javascript'>
        (function(e, t, n) {
            if (e.snaptr) return;
            var a = e.snaptr = function() {
                a.handleRequest ? a.handleRequest.apply(a, arguments) : a.queue.push(arguments)
            };
            a.queue = [];
            var s = 'script';
            r = t.createElement(s);
            r.async = !0;
            r.src = n;
            var u = t.getElementsByTagName(s)[0];
            u.parentNode.insertBefore(r, u);
        })(window, document,
            'https://sc-static.net/scevent.min.js');

        snaptr('init', '2562033f-5bb8-4359-8e4e-706e9cb8b5dc', {
            'user_email': '__INSERT_USER_EMAIL__'
        });

        snaptr('track', 'PAGE_VIEW');
    </script>
    <!-- End Snap Pixel Code -->
    <script>
        ! function(w, d, t) {
            w.TiktokAnalyticsObject = t;
            var ttq = w[t] = w[t] || [];
            ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias",
                "group", "enableCookie", "disableCookie"
            ], ttq.setAndDefer = function(t, e) {
                t[e] = function() {
                    t.push([e].concat(Array.prototype.slice.call(arguments, 0)))
                }
            };
            for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);
            ttq.instance = function(t) {
                for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++) ttq.setAndDefer(e, ttq.methods[n]);
                return e
            }, ttq.load = function(e, n) {
                var i = "https://analytics.tiktok.com/i18n/pixel/events.js";
                ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = i, ttq._t = ttq._t || {}, ttq._t[e] = +new Date,
                    ttq._o = ttq._o || {}, ttq._o[e] = n || {};
                var o = document.createElement("script");
                o.type = "text/javascript", o.async = !0, o.src = i + "?sdkid=" + e + "&lib=" + t;
                var a = document.getElementsByTagName("script")[0];
                a.parentNode.insertBefore(o, a)
            };

            ttq.load('CGC0DKJC77U573C9170G');
            ttq.page();
        }(window, document, 'ttq');
    </script>
    <script type="text/javascript">
        _linkedin_partner_id = "5246089";
        window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
        window._linkedin_data_partner_ids.push(_linkedin_partner_id);
    </script>
    <script type="text/javascript">
        (function(l) {
            if (!l) {
                window.lintrk = function(a, b) {
                    window.lintrk.q.push([a, b])
                };
                window.lintrk.q = []
            }
            var s = document.getElementsByTagName("script")[0];
            var b = document.createElement("script");
            b.type = "text/javascript";
            b.async = true;
            b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
            s.parentNode.insertBefore(b, s);
        })(window.lintrk);
    </script>
    <noscript>
        <img height="1" width="1" style="display:none;" alt=""
            src="https://px.ads.linkedin.com/collect/?pid=5246089&fmt=gif" />
    </noscript>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5XR5MBW');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Twitter conversion tracking base code -->
    <script>
        ! function(e, t, n, s, u, a) {
            e.twq || (s = e.twq = function() {
                    s.exe ? s.exe.apply(s, arguments) : s.queue.push(arguments);
                }, s.version = '1.1', s.queue = [], u = t.createElement(n), u.async = !0, u.src =
                'https://static.ads-twitter.com/uwt.js',
                a = t.getElementsByTagName(n)[0], a.parentNode.insertBefore(u, a))
        }(window, document, 'script');
        twq('config', 'o7mvx');
    </script>
    <!-- End Twitter conversion tracking base code -->
    @yield('styles')
</head>
<style>
    .owl-carousel .owl-stage,
    .owl-carousel.owl-drag .owl-item {
        -ms-touch-action: auto;
        touch-action: auto;
    }
</style>

<body {{ app()->getLocale() == 'ar' ? 'class=rtl' : 'class=ltr' }}>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5XR5MBW" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="home-page">

        @include('frontend.partials.header')
        <!-- ********** end header ************** -->

        <!-- *********** end-slider ******************** -->
        @yield('content')
        <!-- *********** end-about-us ******************** -->
        {{-- All Category --}}
        <!-- *********** end-all-category ******************** -->
        {{-- OurWork --}}
        <!-- *********** end-our-work ******************** -->

        <!-- *********** end-Host-Your-Health-Event-For-Free ******************** -->
        {{-- Icon Text Descriptionlink --}}
        <!-- *********** end-our-work ******************** -->
        {{-- Blog --}}
        <!-- *********** end-Investing-for-Your-Future ******************** -->
        <!-- {{-- Partner --}} -->
        <!-- *********** end-Trusted-by ******************** -->

        <!-- *********** end-SUBSCRIBE-OUR-NEWSLETTER ******************** -->
        <!-- ********************* end page ********************************** -->

    </div>

    {{--    @if (auth()->check() && $cart) --}}
    {{--    <div class="fixed_cart_icon cart_popup" onclick="openCartPopup()"> --}}
    {{--        <img src="{{asset('nazil/imgs/cart-afaq.svg')}}" alt="cart"> --}}
    {{--        <div class="popup_cart_count"> --}}
    {{--            {{$cart ? count($cart->items) : 0}} --}}
    {{--        </div> --}}
    {{--    </div> --}}
    {{--    <div class="cart_popup_text" id="cartPopup"> --}}
    {{--        <h4> --}}
    {{--            {{__('global.your_shopping_cart')}} --}}
    {{--        </h4> --}}

    {{--        <i class="fa-solid fa-xmark" onclick="openCartPopup()"></i> --}}
    {{--        @include('frontend.cart_popup_page') --}}

    {{--    </div> --}}
    {{--    @endif --}}

    @include('frontend.partials.footer')
    <!-- ***************** all script ************************************** -->



    <!-- ***************** all script ************************************** -->
    <script src="{{asset('afaq/assests/js/jquery3.7.0.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var langRtl = {{ app()->getLocale() == 'ar' ? 1 : 0 }}
    </script>
    <script src="{{ asset('afaq/assests/js/jquery-3.4.0.js') }}"></script>
    <script src="{{ asset('afaq/assests/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('afaq/assests/js/main.js') }}"></script>
    <script src="{{ asset('afaq/new-assets/js/bootstrap.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/jquery.flexslider.min.js"
        integrity="sha512-M3wq5WV8hxDfr57VnaB8R3j7TK1dTBwwTWCemilGC1b1bk447mxw8v7t0ImJ0z4pfRVlVcwODbkQbkWiCQGh0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.js') }}"></script>





    <script>
        // new WOW().init();
    </script>
    @yield('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/jquery.flexslider.min.js"
        integrity="sha512-M3wq5WV8hxDfr57VnaB8R3j7TK1dTBwwTWCemilGC1b1bk447mxw8v7t0ImJ0z4pfRVlVcwODbkQbkWiCQGh0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.js') }}"></script>

</body>

</html>
