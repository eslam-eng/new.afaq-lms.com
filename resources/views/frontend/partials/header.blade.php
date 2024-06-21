@php
$currentRouteName = Route::currentRouteName();
@endphp

<div class="global_whatsapp_icon d-flex flex-column justify-content-center">
    <a href="https://api.whatsapp.com/send/?phone=966557527232&text&type=phone_number&app_absent=0" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<div class="single-header">

    <div class="open-search-box">
        <div class="close-icon-">
            <i class="far fa-times-circle"></i>
        </div>
        <div class="the-searching-box">

            <div class="open-search">
                <span> {{__('lms.footer_design')}}</span>
                <input type="text" placeholder="{{__('lms.type_here')}}">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>

        </div>
    </div>
    <!-- ***************************************** -->

    <section class="the-new-header">
        <!-- <div class="fixed-side-header">
        <div class="welcome">
            <div class="lang-">
                <div class="lang">
                    <a href="{{url((app()->getLocale() == 'en' ? '/ar/' : '/en/') . \Request::segment(2).'/'.\Request::segment(3))}}">{{app()->getLocale() == 'en' ? 'عربي' : 'english'}}</a>
                </div>
            </div>
        </div>
    </div> -->
        <!-- ******************************************** -->
        <div class="header" id="myHeader">
            <div class="header_default header_5 fixed">
                <div class="new-header-sna col-12">
                    <div class="offset-1 header_5-slider new-snaheader" style="margin: 0 60px">
                        <div class="left-side-header">
                            <div class="all-header-data">
                                <div class="top-small-header">
                                    <!-- ***************** top header ************************************* -->
                                    <div class="top-header">
                                        <div class="container on-top-header">
                                            <div class="top-header-data d-flex justify-content-between">

                                                <div class="right-side-ontop-header d-flex">
                                                    <div class="connect-topheader">

                                                    </div>
                                                    <div class="social-connect">

                                                        @if(auth()->check())


                                                        @else
                                                        <div class="log-inpage">
                                                            <div class="header_login_url">
                                                                <a href="{{url(app()->getLocale().'/login')}}">
                                                                    <!-- <i class="fa fa-user"></i> -->
                                                                    {{__('lms.login')}}
                                                                </a>
                                                                <span class="vertical_divider">/</span>
                                                                <a href="{{url(app()->getLocale().'/register')}}">{{__('lms.register')}}</a>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <!-- <div style="width: 40px;"></div> -->
                                                        <div class="social">
                                                            <ul>
                                                                <!-- <li><a href="https://www.facebook.com/saudinursing">
                                                                        <i class="fab fa-facebook-f"></i>
                                                                    </a></li> -->
                                                                <li><a href="https://twitter.com/Saudi_Nurses">
                                                                        <i class="fab fa-twitter"></i>
                                                                    </a></li>
                                                                <!-- <li><a href="https://www.snapchat.com/add/Saudi_Nurses">
                                                                        <i class="fab fa-snapchat"></i>
                                                                    </a></li> -->
                                                                <li><a href="#">
                                                                        <i class="fab fa-linkedin-in"></i>
                                                                    </a></li>
                                                                <li><a href="https://www.youtube.com/channel/UCSfj5r6YjItuB0Ltfslm6dA">
                                                                        <i class="fab fa-youtube"></i></a></li>
                                                                @if(auth()->check() && isset(auth()->user()->userUserAlerts))
                                                                <li class="item-list-notifcation notifications-menu">
                                                                    <!-- <a href="#" class="list-notifications-menu">
                                                                            <i class="far fa-bell"></i>
                                                                            @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                                                                            @if($alertsCount > 0)
                                                                            <span class="badge badge-warning navbar-badge">
                                                                                {{ $alertsCount }}
                                                                            </span>
                                                                            @endif
                                                                        </a> -->
                                                                    <div class="overlaytwo-sna"></div>
                                                                    <div class="dropdown-menu notifcation-itemm-list ">
                                                                        @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                                                                        @foreach($alerts as $alert)
                                                                        <div class="dropdown-item-menu">
                                                                            <a href="{{ $alert->alert_link ? $alert->alert_link : '#' }}" target="_blank" rel="noopener noreferrer">
                                                                                @if($alert->pivot->read === 0) <strong> @endif
                                                                                    {{ $alert->alert_text }}
                                                                                    @if($alert->pivot->read === 0) </strong> @endif
                                                                            </a>
                                                                        </div>
                                                                        @endforeach
                                                                        @else
                                                                        <div class="text-center">
                                                                            {{ trans('global.no_alerts') }}
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                                @endif
                                                            </ul>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="logoutform" action="{{ route('logout' ,['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    <!-- **************** end top header ********************************** -->
                                </div>
                                <div class="top-big-header">
                                    <div class="row menu-header web-view">
                                        <div class=" hidden-xs hidden-sm">
                                            <div class="stm_menu_toggler" data-text="Menu"></div>
                                            <div class="header_main_menu_wrapper clearfix">


                                                <div class="new-menu-onheader">
                                                    <div style="width: 10px;"></div>
                                                    {{-- <div class="sna-vesion-img">--}}
                                                    {{-- <img src="{{asset('nazil/imgs/2030.png')}}" alt="">--}}
                                                    {{-- </div>--}}

                                                    <ul class="header-menu clearfix">
                                                        <!-- <div style="width: 10px;"></div> -->
                                                        {{-- <li class="--}}
                                                        {{-- menu-item--}}
                                                        {{-- menu-item-type-custom--}}
                                                        {{-- menu-item-object-custom--}}
                                                        {{-- menu-item-5005--}}
                                                        {{-- drowp-dawn-lms--}}
                                                        {{-- ">--}}
                                                        {{-- <a >{{__('lms.aboutsna')}}</a>--}}
                                                        {{-- <div class="drowp-dawn-lms-list">--}}
                                                        {{-- <span><a href="{{url('/'.app()->getLocale() . '/contact-us')}}">{{__('lms.contact')}}</a></span>--}}
                                                        {{-- <span> <a href="{{url('/'.app()->getLocale() . '/content/')}}">{{app()->getLocale() == 'en' ? "about us" : "من نحن"}}</a></span>--}}
                                                        {{-- </div>--}}
                                                        {{-- </li>--}}
                                                        <!-- <div class="inlin-style-list"></div> -->
                                                        <li class=" menu-item menu-item-type-custom menu-item-object-custom
                                                            menu-item-5004 ">
                                                            <a href="{{url('/'.app()->getLocale() . '/contact-us')}}">{{__('lms.contact')}}</a>
                                                        </li>
                                                        <div class="inlin-style-list"></div>
                                                        <li class=" menu-item menu-item-type-custom menu-item-object-custom
                                                            menu-item-5004 ">
                                                            <a href="{{url('/'.app()->getLocale() . '/content/about-us')}}">{{app()->getLocale() == 'en' ? "About us" : "من نحن"}}</a>
                                                        </li>
                                                        <div class="inlin-style-list"></div>
                                                        <li class=" menu-item menu-item-type-custom menu-item-object-custom
                                                            menu-item-5004 ">
                                                            <a href="{{url('/'.app()->getLocale() . '/available-exams')}}">{{__('frontend.available_exam')}}</a>
                                                        </li>
                                                        <div class="inlin-style-list"></div>


                                                        <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5005
                                                            ">
                                                            <a href="{{url('/'.app()->getLocale() . '/membership')}}">{{__('frontend.members')}}</a>
                                                        </li>
                                                        <div class="inlin-style-list"></div>

                                                        <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5005
                                                            ">
                                                            <a href="{{url('/'.app()->getLocale() . '/all-blogs')}}">{{__('frontend.science_search')}}</a>
                                                        </li>
                                                        <div class="inlin-style-list"></div>

                                                        <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5004
                                                            ">
                                                            <a href="{{url('/'.app()->getLocale() . '/all-courses')}}"> {{__('frontend.eventandactivities')}}</a>
                                                        </li>

                                                        <!-- @foreach(\App\Models\ContentPage::where('show_in_menu' , 1)->get() as $page)
                                                        <div class="inlin-style-list"></div>
                                                        <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5005
                                                            ">
                                                            <a href="{{url('/'.app()->getLocale() . '/content/'.\Illuminate\Support\Str::slug($page->title))}}">{{app()->getLocale() == 'en' ? $page->title : $page->title_ar}}</a>
                                                        </li>
                                                        @endforeach -->

                                                        <div class="inlin-style-list"></div>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right-side-header">
                            <div class="logo-unit">
                                <a href="{{url(app()->getLocale().'/homepage')}}">
                                    <div style="margin: 0 15px;">
                                        <span>{{__('frontend.logo')}}</span>
                                        <em>{{__('frontend.subtitle_one')}}</em>
                                        <strong>{{__('frontend.subtitle_two')}}</strong>
                                    </div>
                                    <img class="logo_transparent_static visible" src="https://sna.org.sa/wp-content/uploads/2021/05/logo.png" alt="الجمعية السعودية للتمريض المهني">

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ************************************* responsive header ******************************** -->
                <div class="mobile-view">
                    <div class="new-navbar d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <div class="logo-unit">
                                <a href="{{url(app()->getLocale().'/homepage')}}">
                                    <img class="logo_transparent_static visible" src="/nazil/imgs/logo.png" alt="الجمعية السعودية للتمريض المهني">

                                    <div style="margin: 0 15px;">
                                        <span>الجمعيه السعوديه للتمريض المهني</span>
                                        <em>Saudi Nurses Association</em>
                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="menu">
                            <span class="nav-menu">
                                <span class="material-symbols-outlined">
                                    sort
                                </span>
                            </span>
                            <div class="new-small-menu">
                                <div class="close-menu">
                                    <span><i class="fas fa-times"></i></span>
                                </div>
                                <div class="data-small-menue">
                                    <div class="log-inpage">
                                        @if(auth()->check())
                                        <!-- Example single danger button -->
                                        <div class="btn-group on-mobile-view">
                                            <button type="button" class="btn-dropdown">
                                                <i class="fa-solid fa-circle-user" style="margin:0 5px;"></i>
                                                {{__('global.welcome')}} {{ auth()->user()->name }}
                                            </button>
                                            <!-- <div class="overlay-sna"></div> -->
                                            <div class=" small-menu-mobil-view">
                                                <a class="dropdown-item" href="{{url(app()->getLocale().'/personal-infos')}}">
                                                    <i class="fas fa-user" style="margin:0 5px;"></i>
                                                    {{__('lms.Profile')}}
                                                </a>
                                                <a class="dropdown-item" href="{{url(app()->getLocale().'/mycourses')}}">
                                                    <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                                    {{__('lms.my_courses')}}
                                                </a>
                                                <a class="dropdown-item" href="{{url(app()->getLocale().'/my_exams')}}">
                                                    <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                                    {{__('lms.my_exams')}}
                                                </a>
                                                <a class="dropdown-item" href="{{url('/admin/messenger')}}">
                                                    <i class="fas fa-envelope" style="margin:0 5px;"></i>
                                                    {{__('lms.Messages')}}
                                                </a>

                                                @if(auth()->check())
                                                @can('home_page_access')
                                                <a class="dropdown-item" href="{{url('/admin')}}" target="_blank">
                                                    <i class="fas fa-dashboard" style="margin:0 5px;"></i>
                                                    {{__('lms.dashboard')}}</a>
                                                <div class="dropdown-divider"></div>
                                                @endcan
                                                @endif

                                                <div style="
                                                    height: 0;
                                                    margin: 0.5rem 0;
                                                    width: 90vw;
                                                    overflow: hidden;
                                                    border-top: 15px solid #e9ecef;
                                                    border-radius: 50px;
                                                "></div>

                                                <a class="dropdown-item" href="{{url(app()->getLocale().'/carts')}}">
                                                    <i class="fa-solid fa-cart-arrow-down" style="margin:0 5px;"></i>
                                                    {{__('lms.carts')}}
                                                </a>
                                                <!-- <div class="dropdown-divider"></div> -->
                                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                                    <i class="fas fa-sign-out-alt" style="margin:0 5px;"></i>
                                                    {{__('lms.Logout')}}
                                                </a>
                                            </div>
                                        </div>

                                        @else
                                        <div class="header_login_url on-mobile-view">

                                            <a href="{{url('login')}}">
                                                <!-- <i class="fa fa-user"></i> -->
                                                {{__('lms.login')}}
                                            </a>
                                            <a href="{{url(app()->getLocale().'/register')}}">{{__('lms.register')}}</a>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="lang-dir">
                                        <span>
                                            <a href="{{url((app()->getLocale() == 'en' ? '/ar/' : '/en/') . \Request::segment(2).'/'.\Request::segment(3))}}">
                                                @if(app()->getLocale() == 'ar')
                                                    <img src="/nazil/imgs/lang-flags/united-states.png" alt="Aemrican flag">
                                                @else
                                                    <img src="/nazil/imgs/lang-flags/saudi-arabia.png" alt="Saudi Arabia flag">
                                                @endif
                                                <span>{{app()->getLocale() == 'en' ? 'عربي' : 'english'}}</span>
                                            </a>
                                        </span>
                                    </div>
                                    <!-- <div class="notifcations-carts-all d-flex justify-content-between">
                                        <div class="notifcation-carts-">
                                            @if(auth()->check())
                                            <li class=" notifications-menu">
                                                <a href="#" class=" mobil-view-notifc">
                                                    <i class="far fa-bell"></i>
                                                    @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                                                    @if($alertsCount > 0)
                                                    <span class="badge badge-warning navbar-badge">
                                                        {{ $alertsCount }}
                                                    </span>
                                                    @endif
                                                    <span class="notifcatios-name">notifcatios</span>
                                                </a>

                                            </li>
                                            @endif
                                        </div>
                                        <div class="notifcation-carts-">
                                            <div class="cart-icon-groub all-popup-notifcation-items">
                                                <div class="cart-icon popup-notifcation-items">
                                                    <i class="fas fa-cart-plus"></i>
                                                    <span class="cart-notifcation">14</span>

                                                </div>
                                                <span class="notifcatios-name">all carts</span>
                                            </div>
                                        </div>
                                    </div> -->

                                    <ul>
                                        <!-- <li>
                                            <a href="{{url('/'.app()->getLocale() . '/homepage')}}" aria-current="page">{{__('lms.home')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{url('/'.app()->getLocale() . '/all-courses')}}"> {{__('lms.event')}}</a>
                                        </li> -->

                                        <li>
                                            <a href="{{url('/'.app()->getLocale() . '/all-courses')}}"> {{__('frontend.eventandactivities')}}</a>
                                        </li>

                                        <li>
                                            <a href="{{url('/'.app()->getLocale() . '/all-blogs')}}">{{__('frontend.science_search')}}</a>
                                        </li>

                                        <li>
                                            <a href="{{url('/'.app()->getLocale() . '/membership')}}">{{__('frontend.members')}}</a>
                                        </li>

                                        <li>
                                            <a href="{{url('/'.app()->getLocale() . '/available-exams')}}">{{__('frontend.available_exam')}}</a>
                                        </li>

                                        @if(!empty($page))
                                        <li>
                                            <a href="{{url('/'.app()->getLocale() . '/content/'.\Illuminate\Support\Str::slug($page->title))}}">{{app()->getLocale() == 'en' ? $page->title : $page->title_ar}}</a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{url('/'.app()->getLocale() . '/contact-us')}}">{{__('lms.contact')}}</a>
                                        </li>


                                    </ul>


                                    <div class="social">
                                        <ul>

                                            <!-- <li><a href="https://www.facebook.com/saudinursing">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a></li> -->
                                            <li><a href="https://twitter.com/Saudi_Nurses">
                                                    <i class="fab fa-twitter"></i>
                                                </a></li>
                                            <!-- <li><a href="https://www.snapchat.com/add/Saudi_Nurses">
                                                    <i class="fab fa-snapchat"></i>
                                                </a></li> -->
                                            <li><a href="#">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a></li>
                                            <li><a href="https://www.youtube.com/channel/UCSfj5r6YjItuB0Ltfslm6dA">
                                                    <i class="fab fa-youtube"></i></a></li>

                                        </ul>

                                    </div>
                                    <!-- <div class="search-toggler-unit">
                                        <div class="search-toggler">
                                            <i class="fa fa-search"></i>
                                            <span>search</span>
                                        </div>
                                    </div> -->
                                    <div class="connect-topheader">
                                        <ul class="s_contact">
                                            <li class="phone">
                                                <i class="fab fa-whatsapp"></i>
                                                <a href="tel: +0557527232">
                                                    <em>{{config('app.telephone')}}</em>
                                                </a>
                                            </li>

                                            <li class="mail">
                                                <i class="far fa-envelope-open"></i>
                                                <a href="mailto:{{config('app.email')}}">{{config('app.email')}}</a>
                                            </li>
                                            <!-- <li class="mapi">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>
                                                    {{config('app.address')}}
                                                </span>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ************************************* end responsive header ******************************** -->

            </div>
        </div>

    </section>

    <script>
        window.onload = function() {
            $(".overlaytwo-sna").click(function() {
                $(this).toggleClass("active-overlay")
                $(".notifcation-itemm-list").removeClass("activ-notifcation-itemm-list")
            })

        }
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {
            myFunction()
        };

        // Get the header
        var header = document.getElementById("myHeader");

        // Get the offset position of the navbar
        var sticky = header.offsetTop;

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>
</div>
