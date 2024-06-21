@php
$currentRouteName = Route::currentRouteName();
$parm_string = '';
$loop =0;
if($currentRouteName != 'all-courses'){
    foreach (request()->all() as $key => $parm) {

    if($loop == 0){
    $parm_string.='?';
    }else{
    $parm_string.='&';
    }

    $parm_string.="$key".'='.$parm;
    $loop++;
    }
}
@endphp


<header class="header col-12">
    <nav class="menu d-flex justify-content-between align-items-center col-10 offset-1 on-larg-screen">
        <a href="{{url(app()->getLocale().'/homepage')}}">
            <div class="logo-afaq">
                <picture>
                    <img  src="/afaq/imgs/AFAQ.png" alt="">
                </picture>
            </div>
        </a>
        <div class="menu-nav-bar d-flex ">
            <ul>

                <li>
                    <a href="{{ route('site-home',['locale'=>app()->getLocale()]) }}">
                        {{__('afaq.home')}}
                      </a>
                </li>
                <li>
                    <a href="{{ route('all-courses',['locale'=>app()->getLocale()]) }}">
                        {{__('afaq.event')}}
                      </a>
                </li>

                <li>
                    <span>{{__('afaq.service')}}</span>
                    <ul class="subcategory_">
                        <li>Courses</li>
                        <li>Courses</li>
                        <li>Courses</li>
                        <li>Courses</li>
                    </ul>
                </li>
                <li>{{__('afaq.aboutafaq')}}</li>
                <li>{{__('afaq.contact')}}</li>
            </ul>
        </div>
        <div class="login-language d-flex align-items-center">
            <div class="lang">
                {{-- <span>عربي</span>--}}
                <a href="{{url((app()->getLocale() == 'en' ? '/ar/' : '/en/') . \Request::segment(2).'/'.\Request::segment(3))}}">{{app()->getLocale() == 'en' ?  'عربي' : ' English'}}</a>

            </div>
            <div class="search-Icon">
                <div class="search-bnt">
                    <i class="fa-solid fa-magnifying-glass"></i>
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
            @if (!auth()->check())
            <div class="log-reg d-flex align-items-center">
                <div class="sign-in">
                    <!-- <span>{{ __('afaq.onlogin') }} </span> -->
                    <a href="{{ url('login') }}">
                        <span>
                            {{ __('lms.login') }}
                        </span>
                    </a>
                </div>
                <div class="free-join">
                    <a href="{{ url(app()->getLocale() . '/register') }}">
                        <span> {{ __('lms.register') }}</span>
                    </a>
                    <!-- <span>{{ __('afaq.JoinUs') }}</span> -->
                </div>
            </div>
        @else
            <div class="after-login">
                <div class="user-name list-log_">
                    <div class="user-img">
                        <img src="{{ auth()->user()->personal_photo->url }}" alt="">
                    </div>
                    <div class="user-name">
                        <span>{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>
                    </div>

                </div>
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

                            <li> <a class="dropdown-item" href="{{ url(app()->getLocale() . '/my_invoices') }}">
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

                        <form id="logoutform" action="{{ route('logout', ['locale' => app()->getLocale()]) }}"
                            method="POST" style="display: none;">
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
                <img  src="/afaq/imgs/small-logo.png" alt="">
                <div class="welcom-user">
                    <span>Good Morning </span>
                    @if(auth()->check())
                    <strong>{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</strong>
                    @endif
                </div>
            </div>
            <div class="menu-brgger-header">
                <span class="buger-small-meu"><i class="fa-solid fa-bars"></i></span>
                <div class="set-menu-bar">
                    <ul class="small-list-bar">
                        <li><a href="">Home</a></li>
                        <li><a href="">Courses & Activities</a></li>
                        <li><span class="open-sub-cat"> Our Services</span>
                            <ul class="sub-small-menu-bar">
                                <li><a href="">Home</a></li>
                                <li><a href="">Home</a></li>
                                <li><a href="">Home</a></li>
                                <li><a href="">Home</a></li>
                            </ul>
                        </li>
                        <li><a href="">About us</a></li>
                        <li><a href="">عربي</a></li>
                    </ul>
                    <div class="log-in-small-screen">
                        <ul class="small-login_">
                            <li>
                                <a href="{{url('login')}}">
                                    {{__('lms.login')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{url(app()->getLocale().'/register')}}">
                                    {{__('lms.register')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ************************************* end responsive header ******************************** -->
