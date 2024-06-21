@php
    $currentRouteName = Route::currentRouteName();
    $c_lang = '/' . app()->getLocale() . '/';
    $n_lang = app()->getLocale() == 'en' ? '/ar/' : '/en/';
@endphp
<?php
if (auth()->check()) {
    $cart = \App\Models\Cart::withCount('items')
        ->where(['user_id' => auth()->user()->id, 'status' => 0])
        ->first();
} else {
    $cart = null;
}
?>
{{-- <div class="global_whatsapp_icon d-flex flex-column justify-content-center"> --}}
{{-- <i class="fa-brands fa-whatsapp"></i> --}}
{{-- </div> --}}
<link href="{{ asset('afaq/assests/css/notifcation-header-style.css') }}" rel="stylesheet">
<div class="single-header">

    {{-- <div class="open-search-box"> --}}
    {{-- <div class="close-icon-"> --}}
    {{-- <i class="far fa-times-circle"></i> --}}
    {{-- </div> --}}
    {{-- <div class="the-searching-box"> --}}

    {{-- <div class="open-search"> --}}
    {{-- <span> {{__('lms.footer_design')}}</span> --}}
    {{-- <input type="text" placeholder="{{__('lms.type_here')}}"> --}}
    {{-- <button type="submit"><i class="fa fa-search"></i></button> --}}
    {{-- </div> --}}

    {{-- </div> --}}
    {{-- </div> --}}
    <!-- ***************************************** -->
    <div class="on-small-screen the-get-app-btn">
        <div class="get-app-section">
            <div class="d-flex getapp-data justify-content-between">
                <div class="d-flex get-app-afaqlogo_">
                    <div class="close-setion-lms"> <span><i class="fa-solid fa-xmark"></i></span></div>
                    {{-- <div class="get-app-logo">
                        <img  src="{{ asset('afaq/imgs/Group30541849.png') }}" alt="">
                    </div> --}}
                    <div class="getapp-details-afaq">
                        <em> {{ __('afaq.betterExperience') }}</em>
                        <span> {{ __('afaq.DownloadtheApp') }}</span>
                    </div>
                </div>
                <div class="get-app-text" onclick="goToApp()">
                    <span> {{ __('afaq.Gettheapp') }}</span>
                    <img  src="{{ asset('afaq/imgs/downloadapp.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <header class="header col-12 ssd  @if (Route::currentRouteName() != 'site-home') inner-header @endif">
        <nav class="menu d-flex justify-content-between align-items-center col-10 offset-1 on-larg-screen">
            <div class="header-menu">
                <div class="logo-afaq">
                    <a href="{{ url(app()->getLocale() . '/homepage') }}">
                        <picture>
                            <img  src="/afaq/imgs/Logo-Type-1v-2.png" alt="">
                        </picture>
                </div>
                <span class="fake-width"></span>
                <div class="menu-nav-bar d-flex ">
                    <ul>
                        <li> {{ __('afaq.home') }}</li>
                        <li>
                            <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                                {{ __('afaq.event') }}
                            </a>
                        </li>
                        {{-- <li>
                        <span>{{ __('afaq.service') }}</span>
                    <ul class="subcategory_">
                        <li>Courses</li>
                        <li>Courses</li>
                        <li>Courses</li>
                        <li>Courses</li>
                    </ul>
                    </li> --}}

                        <li>
                            <a href="{{ url('/' . app()->getLocale() . '/content/' . 'about-us') }}">
                                {{ __('afaq.aboutafaq') }}
                            </a>
                        </li>
                          <li>
                            <a href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                                {{ trans('cruds.afaqBusiness.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contactUs', ['locale' => app()->getLocale()]) }}">
                                {{ __('afaq.contact') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="login-language d-flex align-items-center {{ auth()->check() ? 'active' : '' }}">
                <div class="lang">

                    {{-- <a href="http://sna.test/ar/homepage"> --}}
                    {{-- <span>عربي</span></a>
                     {{ url((app()->getLocale() == 'en' ? '/ar/' : '/en/') . \Request::segment(2) . '/' . \Request::segment(3).'/'.\Request::segment(4))  }}
                     --}}
                    <a
                        href="{{ str_replace($c_lang, $n_lang, url()->full()) }}">{{ app()->getLocale() == 'en' ? 'عربي' : ' English' }}</a>

                </div>
                <span class="small-fake-wigth"></span>
                <div class="search-Icon ">
                    <div class="search-bnt">
                        <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                    <!-- <div class="search-popup">

                        <div class="search-page">
                            <div class="close-icon">
                                <span><i class="fa-solid fa-circle-xmark"></i></span>
                            </div>
                            <div class="search-box">
                                <input type="text" placeholder="search...">
                                <button>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div> -->
                </div>
                <span class="new-fake-wigth"></span>
                @if (!auth()->check())
                    <div class="log-reg d-flex align-items-center">
                        <div class="sign-in">
                            <!-- <span>{{ __('afaq.onlogin') }} </span> -->
                            <a href="{{ url(app()->getLocale() . '/login') }}">
                                <span>
                                    {{ __('lms.login') }}
                                </span>
                            </a>
                        </div>
                        <span class="fk-w"></span>
                        <div class="free-join ss">
                            <a href="{{ url(app()->getLocale() . '/register') }}">
                                <span> {{ __('lms.register') }}</span>
                            </a>
                            <!-- <span>{{ __('afaq.JoinUs') }}</span> -->
                        </div>
                        {{-- <span class="fk-w"></span>
                        <div class="free-account">
                            <a href="{{ url(app()->getLocale() . '/register') }}">
                                <span> {{ __('lms.freeAccount') }}</span>
                            </a>
                        </div> --}}

                    </div>
                @else
                    @php
                        $notification = \App\Models\UserNotification::where(['user_id' => auth()->user()->id, 'read' => 0])->get();
                    @endphp
                    <div class="after-login wishlist-notifcation">
                        {{-- <div class="fav-btn img-card-header-list">
                            <span class="wish-btnn">
                                <a href="{{ url('/' . app()->getLocale() . '/afaq_wishlists/') }}">
                                <i class="fa-regular fa-heart">
                                </i>
                                </a>
                            </span>
                        </div> --}}
                        <div class="fav-btn img-card-header-list">
                            <span class="notifcations-btn ">
                                <i class="fa-regular fa-bell"></i>
{{--                                <em class="numb-notifc">{{auth()->user()->unreadNotifications->count()}}</em>--}}
                            </span>
                            <div class="notifc-card-nd"></div>
{{--                            <div class="popup-notic-card">--}}
{{--                                <div class="notifcation-title">--}}
{{--                                    <span>{{ __('afaq.notifcation') }} ( {{auth()->user()->unreadNotifications->count()}} )</span>--}}
{{--                                    <em class="read-massage">Mark all as read</em>--}}
{{--                                  </div>--}}

{{--                                <ul class="notification-listed">--}}
{{--                                    @foreach (auth()->user()->unreadNotifications as $notification)--}}
{{--                                        @switch($notification->data['type'])--}}
{{--                                            @case('course')--}}
{{--                                                @php--}}
{{--                                                    $url = '/' . app()->getLocale() . '/one-courses-new/' . $notification->data['parent_id'];--}}
{{--                                                @endphp--}}
{{--                                            @break--}}

{{--                                            @default--}}
{{--                                                @php--}}
{{--                                                    $url = '#';--}}
{{--                                                @endphp--}}
{{--                                        @endswitch--}}
{{--                                        <li class=""><a--}}
{{--                                                href="{{ $url ?? '#' }}">--}}
{{--                                                --}}{{----}}{{-- {{ app()->getLocale() == 'en' ? $noti->title_en : $noti->title_ar }} --}}
{{--                                                <div class="notifc-desc">--}}
{{--                                                    <div class="notifc-img">--}}
{{--                                                      <img src="{{ asset('/afaq/imgs/Group 42174@2x.png') }}" alt="">--}}
{{--                                                      <em class="notifc-partiner">--}}

{{--                                                        <img src="{{ asset('/afaq/imgs/NoPath - Copy.png') }}" alt="">--}}
{{--                                                      </em>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="notifc-details">--}}
{{--                                                      <span>{{ app()->getLocale() == 'en' ? $notification->data['title_en'] : $notification->data['title_ar'] }}</span>--}}
{{--                                                      <small>{{ app()->getLocale() == 'en' ? $notification->data['message_en'] : $notification->data['message_ar'] }}</small>--}}
{{--                                                      <em class="date-notifcation">{{$notification->created_at}}</em>--}}
{{--                                                    </div>--}}
{{--                                                  </div>--}}
{{--                                                  <div class="notifc-option">--}}
{{--                                                    <span><i class="fa-solid fa-ellipsis"></i></span>--}}

{{--                                                  </div>--}}
{{--                                                  <div class="option-notifcation-">--}}
{{--                                                    <ul>--}}
{{--                                                      <li class="mark-delets"><i class="fa-solid fa-trash-can"></i>Delete</li>--}}
{{--                                                    </ul>--}}
{{--                                                  </div>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="after-login carts-cardd">
                        <span class="the-cart-setion">
                            <a href="{{ url('/' . app()->getLocale() . '/carts/') }}">
                                <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                {{-- <img src="{{ asset('afaq/imgs/cart-shopping-regularhhh.png') }}" alt=""> --}}
                                <i class="fa-solid fa-cart-shopping"></i>
                                <em
                                    class="numb-notifc">{{ $cart ? (isset($cart->items) ? count($cart->items) : 0) : 0 }}</em>
                            </a>
                        </span>
                        <div class="cart-popup-setion">
                            <span class="count-cards">
                                {{ __('afaq.MyCart') }}<em>{{ $cart ? (isset($cart->items) ? count($cart->items) : 0) : 0 }}</em>
                            </span>
                            <div class="header-cart-section">

                                <div class="hover-carts-afaq">
                                    <div class="the-carts-afaq-lms">
                                        @if ($cart && isset($cart->items))
                                            @foreach ($cart->items as $item)
                                                @if ($item->course)
                                                    <a
                                                        href="{{ url('/' . app()->getLocale() . '/one-courses-new/' . $item->course->id) }}">
                                                        <div class="cart-details_ d-flex align-items-center">
                                                            <div class="img-card-details"> <img
                                                                    src="{{ isset($item->course->image->url) ? $item->course->image->url : asset('/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg') }}"
                                                                    alt="{{ isset($item->course->image_title_en) ? $item->course->image_title_en : '' }}">
                                                            </div>
                                                            <div class="details-p-cart">
                                                                <p>{{ app()->getLocale() == 'en' ? $item->course->name_en ?? '' : $item->course->name_ar ?? '' }}
                                                                </p>
                                                            </div>
                                                            <span class="coust-c-lms">
                                                                {{ isset($item->course_price) ? $item->course_price . __('lms.currency') : '' }}
                                                            </span>
                                                        </div>
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                        <div class="total-cart-coust">
                                            <span class="total-">{{ __('afaq.all-coust') }}</span>
                                            <em>{{ isset($cart->final_total) ? $cart->final_total . ' ' . __('lms.currency') : '' }}</em>
                                        </div>
                                    </div>
                                    <div class="goto-cart-page">
                                        <a href="{{ url('/' . app()->getLocale() . '/carts/') }}">
                                            {{ __('afaq.gotocarts') }}
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-evenly">
                                        <span>{{ __('global.current_balance') }}</span>
                                        <strong>{{ auth()->user()->wallet   ? auth()->user()->wallet->balance   : 0 }}    {{ __('lms.currency')}}                                            {{--                                            {{ isset($cart->final_total) ? $cart->final_total . ' ' . __('lms.currency') : '' }}    --}}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span style="width: 10px"></span>
                    <div class="after-login">
                        <div class="user-name list-log_">
                            <div class="user-img">
                                {{-- <img src="" alt=""> --}}
                                <img src="{{ auth()->user()->personal_photo->url ?? asset('afaq/imgs/Groupimg.png') }}"
                                    alt="">
                            </div>
                            <div class="user-name">
                                <span
                                    class="guest-name ellipsis ">{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>

                            </div>

                        </div>
                        <div class="notifc-card-nd_"></div>
                        <div class="drop-dawn-user-list">
                            @if (auth()->check())

                                <ul>
                                    <li><a class="dropdown-item"
                                            href="{{ url(app()->getLocale() . '/personal-infos') }}">
                                            <i class="fas fa-user" style="margin:0 5px;"></i>
                                            {{ __('lms.profile') }}</a></li>

                                    <li><a class="dropdown-item" href="{{ url(app()->getLocale() . '/mycourses') }}">
                                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                            {{ __('lms.my_courses') }}</a></li>

                                    <li><a class="dropdown-item" href="{{ url(app()->getLocale() . '/my_exams') }}">
                                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                            {{ __('lms.my_exams') }}</a></li>

                                    <li> <a class="dropdown-item"
                                            href="{{ url(app()->getLocale() . '/my_invoices') }}">
                                            <i class="fas fa-file-invoice" style="margin:0 5px;"></i>
                                            {{ __('lms.my_invoices') }}</a></li>

                                    <li><a class="dropdown-item" href="{{ url('/admin/messenger') }}">
                                            <i class="fas fa-envelope" style="margin:0 5px;"></i>
                                            {{ __('lms.messages') }}</a></li>
                                    @if (auth()->check())
                                        @can('home_page_access')
                                            <li><a class="dropdown-item" href="{{ url('/admin') }}" target="_blank">
                                                    <i class="fas fa-dashboard" style="margin:0 5px;"></i>
                                                    {{ __('lms.dashboard') }}</a></li>
                                        @endcan
                                    @endif
                                    <li><a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                            <i class="fas fa-sign-out-alt" style="margin:0 5px;"></i>
                                            {{ __('lms.logout') }}</a></li>
                                </ul>

                                <form id="logoutform"
                                    action="{{ route('logout', ['locale' => app()->getLocale()]) }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif

                        </div>
                    </div>
                @endif
            </div>
        </nav>
        <div class="heade-width on-small-screen">
            <div class="d-flex justify-content-between small-header_ ">
                <div class="small-logo-header">
                    <a href="{{ url(app()->getLocale() . '/homepage') }}" class="mt-2">
                        <img  src="{{ asset('afaq/imgs/small-logo.png') }}" alt="">
                    </a>
                    <div class="welcom-user mt-2">

                        @if (auth()->check())
                            <span>{{ __('afaq.goodmorning') }}</span>
                            <strong class="guest-name ellipsis "> <a
                                    href="{{ url(app()->getLocale() . '/personal-infos') }}">
                                    {{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</a></strong>
                        @else
                            <strong>{{ __('afaq.goodmorning') }}</strong>
                            <a href="{{ url(app()->getLocale() . '/login') }}">
                                <span>
                                    {{ __('lms.onlogin') }}
                                </span>
                            </a>
                        @endif

                    </div>
                </div>
                <div class="menu-brgger-header mt-2">
                    <span class="buger-small-meu"><i class="fa-solid fa-bars"></i></span>
                    <div class="set-menu-bar">
                        <div class="close-burger-men_list">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class="overlay-card_">

                            <div class="personal-details-small-menue">
                                {{-- <div class="small-logo-header in-personal-details">
                                        <a href="{{ url(app()->getLocale() . '/homepage') }}">
                                            <img  src="{{ asset('afaq/imgs/small-logo.png') }}"
                                                alt="">
                                        </a>
                                        <div class="welcom-user d-flex align-items-center welc-sm-sc">
                                            <div class="name-personal-data ">
                                                <span>{{ __('afaq.goodmorning') }} </span>
                                                @if (auth()->check())
                                                    <strong>
                                                        </strong>
                                                        <strong class="guest-name ellipsis ">{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</strong>
                                                @else
                                                    <strong>{{ __('afaq.guest') }}</strong>
                                                @endif

                                            </div>
                                            <div class="drowp-dawn-icon-btn">
                                                <span class="t-up_"><i class="fa-solid fa-angle-down"></i></span>
                                                <span class="t-dawn_"><i class="fa-solid fa-angle-down"></i></span>
                                            </div>
                                        </div>
                                    </div> --}}
                                {{-- <div class="small-drop-menu-personal"> --}}
                                @if (!auth()->check())
                                    <div class="log-in-small-screen">
                                        <ul class="small-login_ ">
                                            <li class="is-log">
                                                <a href="{{ url(app()->getLocale() . '/login') }}">
                                                    <span>
                                                        {{ __('lms.login') }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="is-regester">
                                                <a href="{{ url(app()->getLocale() . '/register') }}">
                                                    <span> {{ __('lms.register') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <div class="user-name-details">
                                        <div
                                            class="details-personal-acc d-flex align-items-center justify-content-between">
                                            <div class="name-data d-flex align-items-center">
                                                <div class="username-img">
                                                    <img src="{{ auth()->user()->personal_photo->url ?? asset('afaq/imgs/Groupimg.png') }}"
                                                        alt="">
                                                </div>
                                                <div class="user-details-acc">
                                                    <span>{{ __('afaq.Hello') }},</span>
                                                    <strong>{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</strong>
                                                </div>
                                            </div>
                                            <div class="icon-personal">
                                                <span class="on-en">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </span>
                                                <span class="on-ar">
                                                    <i class="fa-solid fa-chevron-left"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="next-popup-user-details">
                                        <div class="sm-pop-page">
                                            <div class="sm-profile-data d-flex">
                                                <div class="icon-personal">
                                                    <span class="on-ar back-sec">
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </span>
                                                    <span class="on-en back-sec">
                                                        <i class="fa-solid fa-chevron-left"></i>
                                                    </span>
                                                </div>
                                                {{-- <span style="width: 110px"></span> --}}
                                                <div class="sm-profile-link">

                                                    <a class="sm-dropdown-item"
                                                        href="{{ url(app()->getLocale() . '/personal-infos') }}">

                                                        {{ __('lms.myprofile') }}</a>
                                                </div>
                                            </div>
                                            <div class="sm-prof-data">
                                                {{-- <div class="sm-pro-img">
                                                    <img src="{{ auth()->user()->personal_photo->url ?? asset('afaq/imgs/Groupimg.png') }}"
                                                        alt="">
                                                </div>
                                                <strong>{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</strong> --}}
                                                <div class="studentInfoInProfilePageContainer">
                                                    <div class="studentInfoInProfilePage">
                                                        <div class="user-img">
                                                            <img src="{{ auth()->user()->personal_photo->url ?? '/afaq/imgs/Groupimg.png' }}"
                                                                alt="">
                                                        </div>
                                                        <div class="userName">
                                                            <div>
                                                                {{ app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? 'لا يوجد الاسم بالعربي' }}
                                                            </div>
                                                            <div class="userEmail">{{ auth()->user()->email }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="studentInfoInProfilePage">
                                                        <div class="progressBar">
                                                            @php
                                                                $user_courses_completion = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id])->sum('completion_percentage') ?? (0 / \App\Models\UsersCourse::where(['user_id' => auth()->user()->id])->count() ?? 1);
                                                            @endphp
                                                            <div>{{ __('lms.course_percentage') }} <span
                                                                    class="completedCoursesPercentage">{{ (int) $user_courses_completion }}%</span>
                                                            </div>
                                                            <div class="progressBarBody">
                                                                <div class="progressBarHighlight"
                                                                    style="width:{{ $user_courses_completion ? ($user_courses_completion > 100 ? 100 : $user_courses_completion) : 0 }}% !important;max-width:100%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sm-acc-linkes">
                                                <div class="linkes-toaccount">
                                                    <ul class="small-list-bar s">
                                                        <li><a class="dropdown-item"
                                                                href="{{ url(app()->getLocale() . '/personal-infos') }}">
                                                                <i class="fas fa-user" style="margin:0 5px;"></i>
                                                                {{ __('lms.profile') }}</a></li>

                                                        <li><a class=""
                                                                href="{{ url(app()->getLocale() . '/mycourses') }}">
                                                                <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                                                {{ __('lms.my_courses') }}</a></li>

                                                        <li><a class=""
                                                                href="{{ url(app()->getLocale() . '/my_exams') }}">
                                                                <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                                                {{ __('lms.my_exams') }}</a></li>
                                                        <li>
                                                            <a href="{{ url(app()->getLocale() . '/wallet') }}"
                                                                class=""><i class="fa-solid fa-wallet"></i>
                                                                <em>{{ __('lms.wallet_and_points') }}</em></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url(app()->getLocale() . '/my_quizes') }}"
                                                                class=""><i
                                                                    class="fa-solid fa-envelope-open-text"></i>
                                                                <em>{{ __('lms.my_quizes') }}</em></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url(app()->getLocale() . '/my_tickets') }}"
                                                                class=""><i class="fa-solid fa-ticket"></i>
                                                                <em>{{ __('lms.myTicket') }}</em></a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ url(app()->getLocale() . '/my_certificates') }}"
                                                                class=""><i class="fa-solid fa-certificate"></i>
                                                                <em>{{ __('lms.my_certificates') }}</em></a>
                                                        </li>
                                                        <li> <a class=""
                                                                href="{{ url(app()->getLocale() . '/my_invoices') }}">
                                                                <i class="fas fa-file-invoice"
                                                                    style="margin:0 5px;"></i>
                                                                {{ __('lms.my_invoices') }}</a></li>

                                                        <li><a class="" href="{{ url('/admin/messenger') }}">
                                                                <i class="fas fa-envelope" style="margin:0 5px;"></i>
                                                                {{ __('lms.messages') }}</a></li>
                                                        <li>
                                                            <a href="{{ url(app()->getLocale() . '/changemypassword') }}"
                                                                class=""><i
                                                                    class="fas fa-lock-open"></i><em>{{ __('lms.change_password') }}</em>
                                                            </a>
                                                        </li>
                                                        @if (auth()->check())
                                                            @can('home_page_access')
                                                                <li><a class="" href="{{ url('/admin') }}"
                                                                        target="_blank">
                                                                        <i class="fas fa-dashboard"
                                                                            style="margin:0 5px;"></i>
                                                                        {{ __('lms.dashboard') }}</a></li>
                                                            @endcan
                                                        @endif
                                                        <li class="log-out-btn"><a class="" href="#"
                                                                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                                                <i class="fas fa-sign-out-alt"
                                                                    style="margin:0 5px;"></i>
                                                                {{ __('lms.logout') }}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                {{-- </div> --}}
                            </div>
                            <div class="fall-height-page">
                                {{-- <div class="small-card-search d-flex justify-content-start">
                                    <div class="search-Icon ">
                                        <div class="search-bnt">
                                            <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </a>
                                        </div>
                                        <div class="search-popup">

                                            <div class="search-page">
                                                <div class="close-icon">
                                                    <span><i class="fa-solid fa-circle-xmark"></i></span>
                                                </div>
                                                <div class="search-box">
                                                    <input type="text" placeholder="search...">
                                                    <button>
                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fav-btn img-card-header-list">
                                        <span class="wish-btnn"><i class="fa-regular fa-heart"></i></span>
                                    </div>
                                    <div class="fav-btn img-card-header-list">
                                        <span class="notifcations-btn">
                                            <i class="fa-regular fa-bell"></i>
                                        </span>
                                    </div>
                                    <div class="the-small-carts">
                                        <span class="the-cart-setion">

                                            <a href="{{ auth()->check() ? url('/' . app()->getLocale() . '/carts/') : url('/' . app()->getLocale() . '/login/') }}">
                                                {{-- <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                                <img src="/afaq/imgs/cart-shopping-regularhhh.png" alt="">
                                                <em
                                                    class="numb-notifc">{{ $cart ? (isset($cart->items) ? count($cart->items) : 0) : 0 }}</em>
                                            </a>
                                        </span>
                                    </div>


                                </div> --}}
                                <ul class="small-list-bar">

                                    <li>
                                        <a href="{{ route('site-home', ['locale' => app()->getLocale()]) }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/home.png') }}"
                                                alt="">
                                            {{ __('afaq.home') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/book.png') }}"
                                                alt="">
                                            {{ __('afaq.event') }}
                                        </a>
                                    </li>

                                    <li><a href="{{ url('/' . app()->getLocale() . '/content/' . 'about-us') }}">
                                            <img class="sm-log-img"
                                                src="{{ asset('afaq/imgs/information-button.png') }}"
                                                alt="">
                                            {{ __('afaq.aboutafaq') }}</a></li>
                                    <li><a href="{{ route('contactUs', ['locale' => app()->getLocale()]) }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/support.png') }}"
                                                alt="">
                                            {{ __('afaq.contact') }}</a>
                                    </li>
                                    <li><a href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                                        <img class="sm-log-img" src="{{ asset('afaq/imgs/income_3594449.png') }}"
                                                alt="">
                                                 {{ trans('cruds.afaqBusiness.title') }}
                                                 <span style="width: 10px;display: inline-block;"></span>
                                                 <em class="new-feed">
                                                    {{ __('afaq.new') }}
                                                 </em>
                                    </a></li>
                                    <li>
                                        {{-- <span class="lang-sub-lms"><em>{{ __('afaq.Language') }}</em> <i
                                                class="fa-solid fa-angle-down"></i> </span> --}}
                                        <div class="sm-sub-lang active">
                                            {{-- <a href="http://sna.test/ar/homepage"> --}}
                                            {{-- <span>عربي</span></a> --}}
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/world.png') }}"
                                                alt="">
                                            <a
                                                href="{{ str_replace($c_lang, $n_lang, url()->full()) }}">{{ app()->getLocale() == 'en' ? 'عربي' : ' English' }}</a>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                            <div class="get-the-app-sec">
                                {{-- ************************** --}}
                                <div class="get-all-apps-btn" onclick="goToApp()">
                                    {{ __('afaq.GetApp') }}
                                </div>
                                <div class="hotline-sec d-flex align-items-center">
                                    <div class="hotline-img">
                                        <img src="{{ asset('afaq/imgs/headset.png') }}" alt="">
                                    </div>
                                    <div class="hotline-numb">
                                        <span>{{ __('afaq.hotline') }}</span>
                                        <a href="tel:{{ config('app.telephone') }}">
                                            {{ config('app.telephone') }}
                                        </a>
                                    </div>
                                </div>
                                <p>{{ __('afaq.Copyrights_Afaq') }}</p>
                                {{-- ********************* --}}
                                {{-- <div class="get-app-details">
                                    <span class="get-app-link"><em>{{ __('afaq.GetApp') }}</em> <i
                                            class="fa-solid fa-angle-down"></i></span>
                                    <div class="all-link-app">
                                        <div class="th-app-img">
                                            <a href="">
                                                <img  src="/afaq/imgs/Group loi41627.png"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="th-app-img">
                                            <a href="">
                                                <img  src="/afaq/imgs/Group 41626lkj.png"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="th-app-img">
                                            <a href="">
                                                <img  src="/afaq/imgs/Groghup 41628.png"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- <div class="marque- ">
     <div class="text-maqu col-10 offset-1 on-larg-screen">
        <div class="close-marq">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <div class="activation-text">
            <p>
                This course focuses on providing a systemic, process-oriented approach to meet quality standards,
                and deliver consistent, high-quality, cost-
            </p>
        </div>
     </div>
    </div> -->
    <section class="Message-Us">
        <div class="MessageUs-btn">
            <a href="https://api.whatsapp.com/send/?phone=966506986979" data-action="share/whatsapp/share"
                target="_blank">
                <i class="fa-brands fa-whatsapp"></i>
                {{-- <span>Message Us</span> --}}
            </a>
        </div>
    </section>

    {{-- <script> --}}
    {{-- window.onload = function() { --}}
    {{-- $(".overlaytwo-sna").click(function() { --}}
    {{-- $(this).toggleClass("active-overlay") --}}
    {{-- $(".notifcation-itemm-list").removeClass("activ-notifcation-itemm-list") --}}
    {{-- }) --}}

    {{-- } --}}
    {{-- // When the user scrolls the page, execute myFunction --}}
    {{-- window.onscroll = function() { --}}
    {{-- myFunction() --}}
    {{-- }; --}}

    {{-- // Get the header --}}
    {{-- var header = document.getElementById("myHeader"); --}}

    {{-- // Get the offset position of the navbar --}}
    {{-- var sticky = header.offsetTop; --}}

    {{-- // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position --}}
    {{-- function myFunction() { --}}
    {{-- if (window.pageYOffset > sticky) { --}}
    {{-- header.classList.add("sticky"); --}}
    {{-- } else { --}}
    {{-- header.classList.remove("sticky"); --}}
    {{-- } --}}
    {{-- } --}}
    {{-- </script> --}}
</div>
