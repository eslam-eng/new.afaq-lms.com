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
<header class="the-header header-">
    <div class="container h-on-web">
        <div class="header header-row ">
            <div class="heade-details">
                <a href="{{ url(app()->getLocale() . '/homepage') }}">
                    <div class="header-logo">

                        <img src="{{ asset('afaq\business/imgs/AFAQ.png') }}" alt="">

                    </div>
                </a>
                <span class="w-25-"></span>
                <div class="header-nav">
                    <nav class="nav-bar">
                        <ul>
                            <li> <a href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                                    {{ __('afaq.Bus_home') }}</a></li>
                            <span class="w-20-"></span>

                            <span class="w-20-"></span>

                            <li>
                                <a href="{{ url('/' . app()->getLocale() . '/business-content/' . 'about_business') }}">
                                    {{ __('afaq.aboutbusiness') }}
                                </a>

                            </li>
                            <span class="w-20-"></span>
                            <li><a href="{{ url(app()->getLocale() . '/business-package_details') }}">
                                    {{ __('afaq.packages_features') }}</a></li>
                            <span class="w-20-"></span>
                            <li><a href="{{ url(app()->getLocale() . '/business-own_package') }}">
                                    {{ __('afaq.packages_compare') }}</a></li>
                            <span class="w-20-"></span>
                            {{--                            <li><a href="">Blogs</a></li> --}}
                            <li>
                                <a href="{{ url('/' . app()->getLocale() . '/all_business_blogs') }}">
                                    {{ __('afaq.blogs') }}
                                </a>


                            </li>
                            <li class="px-5">
                                <button class="custom-btn">
                                    <a href="{{ url(app()->getLocale() . '/customize-now') }}">{{ __('afaq.customise_now') }}</a></button>

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="heade-login" >
                <div class="lang-">
                    {{--                    <span class="ar active">عربي</span> --}}
                    {{--                    <span class="en">English</span> --}}
                    <a
                        href="{{ str_replace($c_lang, $n_lang, url()->full()) }}">{{ app()->getLocale() == 'en' ? 'عربي' : ' English' }}</a>

                </div>
                <span class="w-10- " style="display: inline-block;"></span>
                @if (!auth()->check())
                    <div class="before-login">
                        <button class="sign-up">
                            <a href="{{ url(app()->getLocale() . '/registration') }}">
                                {{ __('lms.register') }}
                            </a>
                        </button>

                        <span class="w-10- " style="display: inline-block;"></span>
                        <button class="log-in">
                            <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                {{ __('lms.login') }}
                            </a>
                        </button>
                        <span class="w-10- " style="display: inline-block;"></span>


                    </div>
                @endif
                @if (auth()->check())
                    <div class="after-login">
                        <div class="user-name list-log_">
                            <div class="user-img">
                                <img src="{{ auth()->user()->personal_photo ? auth()->user()->personal_photo->url : asset('afaq/imgs/Groupimg.png') }}" alt="">
                            </div>
                            <div class="user-name">
                                <span>{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>
                            </div>

                        </div>
                        <div class="notifc-card-nd_"></div>
                        {{-- <div class="notifc-card-nd_"></div> --}}
                        <div class="drop-dawn-user-list">

                            @if (auth()->check())

                                <ul>
                                     <li>
                                         <a class="dropdown-item"
                                            href="{{ url(app()->getLocale() . '/business-personal-infos') }}">
                                            <i class="fas fa-user" style="margin:0 5px;"></i>
                                            {{ __('lms.profile') }}</a></li>

                                    <li><a class="dropdown-item" href="{{ url(app()->getLocale() . '/business_packages') }}">
                                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                            {{ __('lms.my_packages') }}</a></li>
                                    <li> <a class="dropdown-item"
                                            href="{{ url(app()->getLocale() . '/business_invoices') }}">
                                            <i class="fas fa-file-invoice" style="margin:0 5px;"></i>
                                            {{ __('lms.my_invoices') }}</a></li>

                                    <li><a class="dropdown-item" href="{{ url(app()->getLocale() . '/business_tickets') }}">
                                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                            {{ __('lms.myTicket') }}</a></li>



{{--                                    <li><a class="dropdown-item" href="{{ url('/admin/messenger') }}">--}}
{{--                                            <i class="fas fa-envelope" style="margin:0 5px;"></i>--}}
{{--                                            {{ __('lms.messages') }}</a></li>--}}
{{--                                    @if (auth()->check())--}}
{{--                                        @can('home_page_access')--}}
{{--                                            <li><a class="dropdown-item" href="{{ url('/admin') }}" target="_blank">--}}
{{--                                                    <i class="fas fa-dashboard" style="margin:0 5px;"></i>--}}
{{--                                                    {{ __('lms.dashboard') }}</a></li>--}}
{{--                                        @endcan--}}
{{--                                    @endif --}}
                                    <li><a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                            <i class="fas fa-sign-out-alt" style="margin:0 5px;"></i>
                                            {{ __('lms.logout') }}</a></li>
                                </ul>

                                <form id="logoutform" action="{{ route('logout', ['locale' => app()->getLocale()]) }}"
                                    method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif

                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
    <div class="container h-on-mob">
        <div class="media-screen-header ">
            <div class="small-logo-header">
                <a href="{{ url(app()->getLocale() . '/homepage') }}">
                    <img  src="{{ asset('afaq/imgs/small-logo.png') }}" alt="">
                </a>

                {{-- <span>{{__('afaq.goodmorning')}} </span>
                <em>     </em> --}}
                @if (!auth()->check())
                    <div class="before-login">

                        {{--                        <button class="welcom-user"> --}}
                        {{-- <br> --}}
                        <a href="{{ url(app()->getLocale() . '/new_login') }}">
                            <em>{{ __('afaq.goodmorning') }}</em>
                            <span>{{ __('lms.onlogin') }}</span>

                        </a>
                        {{--                        </button> --}}
                    </div>
                @else
                    <div class="welcom-user">
                        <span>{{ __('afaq.goodmorning') }} </span>
                        <strong>{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</strong>
                    </div>
                @endif





            </div>
            <div class="burger-menu">
                <div class="menu-bar">
                    <i class="fa-solid fa-bars"></i>
                    {{-- <img src="{{ asset('afaq\business/imgs/hamburger.png') }}" alt=""> --}}

                </div>
                <div class="side-nav-bar">
                    <div class="side-nave-menu">
                        <div class="close-side-nave">
                            <span class="colse-icon">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                        </div>
                        <div class="main-side-nave-body bn">
                            @if (!auth()->check())
                                <div class="personal-details-small-menue">
                                    <div class="log-in-small-screen ">
                                        <ul class="small-login_ ">
                                            <li class="is-log">
                                                <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                                    <span>
                                                        {{__('lms.login')}}
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="is-regester">
                                                <a href="{{ url(app()->getLocale() . '/registration') }}">
                                                    <span> {{__('lms.register')}}</span>
                                                </a>
                                            </li>
                                            {{-- <li> <a href="{{ url(app()->getLocale() . '/business-contact-us') }}">{{ __('afaq.customise_now') }}</a></li> --}}
                                            <li>
                                                <button class="custom-btn bold" style="width:100%;font-weight: bold;padding-top: 10px;padding-bottom: 10px;"> <a href="{{ url(app()->getLocale() . '/customize-now') }}">{{ __('afaq.customise_now2') }}</a></button>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if (auth()->check())
                                <div class="user-name-details">
                                    <div
                                        class="details-personal-acc d-flex align-items-center justify-content-between">
                                        <div class="name-data d-flex align-items-center">
                                            <div class="username-img">
                                                <img src="{{ auth()->user()->personal_photo ? auth()->user()->personal_photo->url : asset('afaq/imgs/Groupimg.png') }}"
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
                                                        <img src="{{ auth()->user()->personal_photo ? auth()->user()->personal_photo->url : asset('afaq/imgs/Groupimg.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="userName">
                                                        <div>
                                                            {{ app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? 'لا يوجد الاسم بالعربي' }}
                                                        </div>
                                                        <div class="userEmail">{{ auth()->user()->email }}</div>
                                                    </div>
                                                </div>
                                                {{-- <div class="studentInfoInProfilePage">
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
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="sm-acc-linkes">
                                            <div class="linkes-toaccount">
                                                <ul class="small-list-bar s">

                                                    <li><a class="dropdown-item"
                                                           href="{{ url(app()->getLocale() . '/business-personal-infos') }}">
                                                            <i class="fas fa-user" style="margin:0 5px;"></i>
                                                            {{ __('lms.profile') }}</a></li>


                                                    <li><a class="dropdown-item" href="{{ url(app()->getLocale() . '/business_packages') }}">
                                                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                                            {{ __('lms.my_packages') }}</a></li>
                                                    <li> <a class="dropdown-item"
                                                            href="{{ url(app()->getLocale() . '/business_invoices') }}">
                                                            <i class="fas fa-file-invoice" style="margin:0 5px;"></i>
                                                            {{ __('lms.my_invoices') }}</a></li>

                                                    <li><a class="dropdown-item" href="{{ url(app()->getLocale() . '/business_tickets') }}">
                                                            <i class="fas fa-book-open" style="margin:0 5px;"></i>
                                                            {{ __('lms.myTicket') }}</a></li>



                                                    {{--
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
                                                           <i class="fas fa-file-invoice" style="margin:0 5px;"></i>
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
                                                                   <i class="fas fa-dashboard" style="margin:0 5px;"></i>
                                                                   {{ __('lms.dashboard') }}</a></li>
                                                       @endcan
                                                   @endif --}}
                                                    <li class="log-out-btn"><a class="" href="#"
                                                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                                            <i class="fas fa-sign-out-alt" style="margin:0 5px;"></i>
                                                            {{ __('lms.logout') }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="custom-btn py-3 bold mx-2" style="width:95%;font-weight: bold;"> <a href="{{ url(app()->getLocale() . '/customize-now') }}">{{ __('afaq.customise_now') }}</a></button>

                            @endif
                            <div class="fall-height-page">

                                <ul>
                                    <li> <a href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/image (gr6).png') }}"
                                                alt="">
                                            {{ __('afaq.Bus_home') }}</a></li>
                                    <span class="w-20-"></span>

                                    {{-- <span class="w-20-"></span> --}}

                                    <li>
                                        <a
                                            href="{{ url('/' . app()->getLocale() . '/content/' . 'about_business') }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/image (gr7).png') }}"
                                                alt="">
                                            {{ __('afaq.aboutbusiness') }}
                                        </a>

                                    </li>
                                    <span class="w-20-"></span>
                                    <li><a href="{{ url(app()->getLocale() . '/business-package_details') }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/image (gr9).png') }}"
                                                alt="">
                                            {{ __('afaq.packages_features') }}</a></li>
                                    <span class="w-20-"></span>
                                    <li><a href="{{ url(app()->getLocale() . '/business-own_package') }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/image (gr10).png') }}"
                                                alt="">
                                            {{ __('afaq.packages_compare') }}</a></li>
                                    <span class="w-20-"></span>
                                    {{--                            <li><a href="">Blogs</a></li> --}}
                                    <li>
                                        <a href="{{ url('/' . app()->getLocale() . '/all_business_blogs') }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/image (gr11).png') }}"
                                                alt="">
                                            {{ __('afaq.blogs') }}
                                        </a>
                                    </li>
                                    <li>  
                                        <a href="{{ url(app()->getLocale() . '/business-contact-us') }}">
                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/image (gr12).png') }}"
                                                alt="">
                                            {{ __('afaq.contact') }}
                                        </a>
                                    </li>

                                    <li>
                                        <div class="sm-sub-lang active">

                                            <img class="sm-log-img" src="{{ asset('afaq/imgs/image (gr8).png') }}"
                                                alt="">
                                            <a
                                                href="{{ str_replace($c_lang, $n_lang, url()->full()) }}">{{ app()->getLocale() == 'en' ? 'عربي' : ' English' }}</a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="get-app-bar">
                <div class="get-all-apps-btn" onclick="goToApp()">
                    Get App
                </div>
            </div> --}}
        </div>

    </div>
</header>
