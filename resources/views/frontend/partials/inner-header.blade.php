@php
    $currentRouteName = Route::currentRouteName();
    $parm_string = '';
    $loop =0;
    foreach (request()->all() as  $key => $parm) {

        if($loop == 0){
            $parm_string.='?';
        }else{
            $parm_string.='&';
        }

        $parm_string.="$key".'='.$parm;
        $loop++;
    }
@endphp

@if (\Request::segment(2) != 'one-courses')
    <div class="global_whatsapp_icon d-flex flex-column justify-content-center">
        <a href="https://api.whatsapp.com/send/?phone=966557527232&text&type=phone_number&app_absent=0" target="_blank">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>
@endif

<section class="new-header-nd new-header-sna">
    <div class="innerheader-nd d-flex justify-content-between">
        <div class="left-static-side-nd">
            <div class="fixed-side-header ">
                <div class="search-toggler-unit">
                    <div class="search-toggler">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
                <div class="welcome ">
                    <div class="lang-">
                        <div class="lang">
                            <a href="{{url((app()->getLocale() == 'en' ? '/ar/' : '/en/') . \Request::segment(2).'/'.\Request::segment(3).'/'.\Request::segment(4)). $parm_string}}">
                                {{app()->getLocale() == 'en' ? 'Ar' : 'En'}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="view-page">
                    <div class="on-view">
                        <i class="far fa-eye-slash"></i>
                    </div>
                </div>
                <div class="view-page">
                    <div class="on-view">
                        <img src="{{asset('/nazil/imgs/new-page/Group 13414.png')}}" alt="">
                    </div>
                </div>
                @if(auth()->check() && isset(auth()->user()->userUserAlerts))
                <div class="view-page">
                    <div class="on-view notifcation-icon">
                        <i class="far fa-bell"></i>
                        <span class="cart-notifcation"> {{count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse())}} </span>
                    </div>
                    <div class="overlaytwo-sna"></div>
                    <div class="thedropdown-menu notifcation-itemm-list ">
                        <div class="dropdown-notifcations">
                            <ul>
                                @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                                @foreach($alerts as $alert)
                                <li>
                                    <a href="{{ $alert->alert_link ? $alert->alert_link : '#' }}" target="_blank" rel="noopener noreferrer">
                                        @if($alert->pivot->read === 0)
                                        <strong style="color: #949494;">
                                            {{ $alert->alert_text }}
                                        </strong>
                                        @else
                                        <p style="color: #30bbe6;">{{ $alert->alert_text }}</p>
                                        @endif

                                    </a>
                                </li>
                                @endforeach
                                @else
                                <li>{{ trans('global.no_alerts') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <?php
                if (auth()->check()) {
                    $cart = \App\Models\Cart::withCount('items')->where(['user_id' => auth()->user()->id, 'status' => 0])->first();
                } else {
                    $cart = null;
                }
                ?>

                @if(auth()->check())
                <div class="view-page">
                    <a href="{{url(app()->getLocale().'/carts')}}">
                        <div class="on-view cart-img">
                            <img src="{{asset('/nazil/imgs/shopping-cart (4).png')}}" alt="">
                            <span class="cart-notifcation">{{ isset($cart) ? $cart->items->count() : 0}}</span>
                        </div>
                        @if(isset($cart) && isset($cart->items))

                        <div class="cart-option-details">
                            <div class="all-carts-reserved">
                                @foreach($cart->items as $item)
                                @if($item->course)
                                <div class="carts-reserved-details">
                                    <div class="d-flex justify-content-start reserved-details-cart">
                                        <div class="img-cart-reserved">
                                            <a href="{{url('/'.app()->getLocale().'/one-courses/'.$item->course->id)}}">
                                                <img src="{{ isset($item->course->image->url) ? $item->course->image->url : asset('/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg') }}" alt="{{isset($item->course->image_title_en) ? $item->course->image_title_en : '' }}">
                                            </a>
                                        </div>
                                        <div class="data-cart-reserved">
                                            <div class="cart-details">
                                                <span>{{ app()->getLocale() == 'en' ? ($item->category->name_en ?? '') : ($item->category->name_ar ?? '') }}</span>
                                                <a href="{{url('/'.app()->getLocale().'/one-courses/'.$item->course->id)}}">
                                                    <h2>{{ app()->getLocale() == 'en' ? ($item->course->name_en ?? '') : ($item->course->name_ar ?? '') }}</h2>
                                                </a>
                                                <div class="count-cours-cart">
                                                    <span class="new-price-cart">{{$item->course_price . __('lms.SR') }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                @endif
                                @endforeach
                            </div>

                            <div class="totoal-coust-details">
                                <div class="totoal-coust-numbers">
                                    <span>{{ isset($cart->final_total) ? $cart->final_total . ' '.  __('lms.currency') : '' }}</span>
                                </div>
                                <span>{{__('frontend.total')}}</span>

                            </div>
                        </div>
                        @endif
                    </a>
                </div>
                <div class="view-page">
                    <div class="on-view">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="on-view list-user cart-option-details">

                        <a class="dropdown-item" href="{{url(app()->getLocale().'/personal-infos')}}">
                            <i class="fas fa-user" style="margin:0 5px;"></i>
                            {{__('lms.profile')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url(app()->getLocale().'/mycourses')}}">
                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                            {{__('lms.my_courses')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url(app()->getLocale().'/my_exams')}}">
                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                            {{__('lms.my_exams')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url(app()->getLocale().'/my_invoices')}}">
                            <i class="fas fa-file-invoice" style="margin:0 5px;"></i>
                            {{__('lms.my_invoices')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('/admin/messenger')}}">
                            <i class="fas fa-envelope" style="margin:0 5px;"></i>
                            {{__('lms.messages')}}</a>
                        <div class="dropdown-divider"></div>

                        @if(auth()->check())
                        @can('home_page_access')
                        <a class="dropdown-item" href="{{url('/admin')}}" target="_blank">
                            <i class="fas fa-dashboard" style="margin:0 5px;"></i>
                            {{__('lms.dashboard')}}</a>
                        <div class="dropdown-divider"></div>
                        @endcan
                        @endif
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <i class="fas fa-sign-out-alt" style="margin:0 5px;"></i>
                            {{__('lms.logout')}}</a>

                    </div>
                </div>
                @endif

                <form id="logoutform" action="{{ route('logout' ,['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <div class="view-page">
                    <a href="https://twitter.com/Saudi_Nurses">
                        <div class="on-view twitter">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <span>من تويتر</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="right-statc-side-nd">
            <div class="the-innerheader-nd">
                <div class="theheader_default header_5 fixed">
                    <div class="new-header-sna col-12 p-0">
                        <div class=" col-10 offset-1 header_5-slider new-snaheader">
                            <!-- *************************************** -->
                            <div class="right-side-header on-small-web">
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
                            <!-- ************************************** -->
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
                                                                <div class="header_login_url on-mobile-view">

                                                                    <a href="{{url('login')}}">
                                                                        <!-- <i class="fa fa-user"></i> -->
                                                                        {{__('lms.login')}}
                                                                    </a>
                                                                    <span class="login_divider_slash">/</span>
                                                                    <a href="{{url(app()->getLocale().'/register')}}">{{__('lms.register')}}</a>
                                                                </div>
                                                            </div>


                                                            @endif

                                                            <div style="width: 40px;"></div>
                                                            <div class="social">
                                                                <ul>
                                                                    <li><a href="https://twitter.com/Saudi_Nurses">
                                                                            <i class="fab fa-twitter"></i>
                                                                        </a></li>
                                                                    <li><a href="#">
                                                                            <i class="fab fa-linkedin-in"></i>
                                                                        </a></li>
                                                                    <li><a href="https://www.youtube.com/channel/UCSfj5r6YjItuB0Ltfslm6dA">
                                                                            <i class="fab fa-youtube"></i></a></li>
                                                                </ul>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form id="logoutform" action="https://sna.test/ar/logout" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="kMMNnFyUo9PrqEhjCPSeXfNuxwUEBwlYBCKVxfvt">
                                        </form>
                                        <!-- **************** end top header ********************************** -->
                                    </div>
                                    <div class="top-big-header">
                                        <div class="row menu-header web-view">
                                            <div class=" hidden-xs ">
                                                <div class="stm_menu_toggler" data-text="Menu"></div>
                                                <div class="header_main_menu_wrapper clearfix">
                                                    <!-- <div class="pull-dir hidden-xs right_buttons">
                                                        <div style="width: 20px;"></div>

                                                        <div style="width: 20px;"></div>

                                                    </div> -->

                                                    <div class="new-menu-onheader">
                                                        <div style="width: 10px;"></div>
                                                        {{-- <div class="sna-vesion-img">--}}
                                                        {{-- <img src="{{asset('/nazil/imgs/2030.png')}}" alt="">--}}
                                                        {{-- </div>--}}

                                                        <ul class="header-menu clearfix">
                                                            <div style="width: 10px;"></div>
                                                            {{-- <li class="--}}
                                                            {{-- menu-item--}}
                                                            {{-- menu-item-type-custom--}}
                                                            {{-- menu-item-object-custom--}}
                                                            {{-- menu-item-5005--}}
                                                            {{-- drowp-dawn-lms--}}
                                                            {{-- ">--}}
                                                            {{-- <a>{{__('lms.aboutsna')}}</a>--}}
                                                            {{-- <div class="drowp-dawn-lms-list">--}}
                                                            {{-- <span><a href="{{url('/'.app()->getLocale() . '/contact-us')}}">{{__('lms.contact')}}</a></span>--}}
                                                            {{-- <span> <a href="{{url('/'.app()->getLocale() . '/content/')}}">{{app()->getLocale() == 'en' ? "about us" : "من نحن"}}</a></span>--}}
                                                            {{-- </div>--}}
                                                            {{-- </li>--}}

                                                            <li class=" menu-item menu-item-type-custom menu-item-object-custom
                                                            menu-item-5004 ">
                                                                <a href="{{url('/'.app()->getLocale() . '/contact-us')}}">{{__('lms.contact')}}</a>
                                                            </li>

                                                            <li class=" menu-item menu-item-type-custom menu-item-object-custom
                                                            menu-item-5004 ">
                                                                <a href="{{url('/'.app()->getLocale() . '/content/about-us')}}">{{app()->getLocale() == 'en' ? "About us" : "من نحن"}}</a>
                                                            </li>


                                                            <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5005
                                                            ">
                                                                <a href="{{url('/'.app()->getLocale() . '/membership')}}">{{__('frontend.members')}}</a>
                                                            </li>


                                                            <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5004
                                                            ">
                                                                <a href="{{url('/'.app()->getLocale() . '/available-exams')}}">{{__('frontend.available_exam')}}</a>
                                                            </li>



                                                            <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5005
                                                            ">
                                                                <a href="{{url('/'.app()->getLocale() . '/all-blogs')}}">{{__('frontend.science_search')}}</a>
                                                            </li>


                                                            <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5004
                                                            ">
                                                                <a href="{{url('/'.app()->getLocale() . '/all-courses')}}"> {{__('frontend.eventandactivities')}}</a>
                                                            </li>

                                                            <!-- @foreach(\App\Models\ContentPage::where('show_in_menu' , 1)->get() as $page)

                                                            <li class="
                                                            menu-item
                                                            menu-item-type-custom
                                                            menu-item-object-custom
                                                            menu-item-5005
                                                            ">
                                                                <a href="{{url('/'.app()->getLocale() . '/content/'.\Illuminate\Support\Str::slug($page->title))}}">{{app()->getLocale() == 'en' ? $page->title : $page->title_ar}}</a>
                                                            </li>
                                                            @endforeach -->


                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right-side-header on-larg-web">
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
                        <div class="d-flex justify-content-between precemp-diraction">
                            <div class="left-static-side-nd">
                            </div>
                            <div class=" precemp-statc-side">
                                <div class="row p-0">
                                    <div class=" col-10 offset-1 ">
                                        <div class="precemp">
                                            <div class="precemp-anme  d-flex align-items-center justify-content-start">
                                                <span class="HomePage">
                                                    <a href="{{url('/')}}">
                                                        {{__('lms.homepage')}}
                                                    </a></span>
                                                <span style="width: 10px;"></span>
                                                <em>/</em>
                                                <span style="width: 10px;"></span>
                                                <span class="precemp-selector">
                                                    <?php
                                                    try {
                                                        if(Request::segment(2) == 'all-courses'){
                                                            echo __('frontend.eventandactivities');
                                                        }else{
                                                            echo __('lms.' . \Request::segment(2));
                                                        }
                                                    } catch (\Throwable $th) {
                                                        echo __('lms.page');
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- ************************************* responsive header ******************************** -->

                    <!-- ************************************* end responsive header ******************************** -->

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ********************************** old-inner header ************************************************* -->
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
            <div class="new-small-menu {{app()->getLocale() == 'ar' ?  'rtl': 'ltr'}}">
                <div class="close-menu">
                    <span><i class="fas fa-times"></i></span>
                </div>
                <div class="data-small-menue">
                    <div class="log-inpage">
                        @if(auth()->check())
                        <div class="btn-group on-mobile-view">
                            <button type="button" class="btn-dropdown">
                            <i class="fa-solid fa-circle-user" style="margin:0 5px;"></i>
                                Welcome, {{ auth()->user()->name }}
                            </button>
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
                                    {{__('lms.dashboard')}}
                                </a>
                                @endcan
                                @endif
                                <div class="dropdown-divider"></div>
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
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <i class="fas fa-sign-out-alt" style="margin:0 5px;"></i>
                                    {{__('lms.Logout')}}
                                </a>
                            </div>
                        </div>

                        @else
                        <div class="header_login_url on-mobile-view">

                            <a href="{{url('login')}}">
                                {{__('lms.login')}}
                            </a>
                            <a href="{{url(app()->getLocale().'/register')}}">{{__('lms.register')}}</a>
                        </div>
                        @endif
                    </div>
                    <div class="lang-dir">
                        <span>
                            <a href="{{url((app()->getLocale() == 'en' ? '/ar/' : '/en/') . \Request::segment(2).'/'.\Request::segment(3).'/'.\Request::segment(4))}}">
                            @if(app()->getLocale() == 'ar')
                                <img src="/nazil/imgs/lang-flags/united-states.png" alt="Aemrican flag">
                            @else
                                <img src="/nazil/imgs/lang-flags/saudi-arabia.png" alt="Saudi Arabia flag">
                            @endif
                            <span>{{app()->getLocale() == 'en' ? 'عربي' : 'english'}}</span>
                            </a>
                        </span>
                    </div>


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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ************************************* end responsive header ******************************** -->
