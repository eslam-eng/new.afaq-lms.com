<!DOCTYPE html>
<html>

<head>
    @include('frontend.business.components.header-scripts')
    <style>
        .pk-style div:last-child{
            order: -1;
        }
    </style>
    @yield('header-scripts')
</head>

<body class="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <main class="home-page ">
        @include('frontend.business.components.header')
        @yield('content')

        <!-- ********************* end footer-sec ********************************** -->
        @include('frontend.business.components.footer')

        {{-- ****************** whats up section --}}
        <section class="Message-Us">
            <div class="MessageUs-btn">
                <a href="https://api.whatsapp.com/send/?phone=966506986979" data-action="share/whatsapp/share"
                    target="_blank">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>
        </section>
    </main>

    @include('frontend.business.components.footer-scripts')
    @stack('scripts')

</body>

</html>
