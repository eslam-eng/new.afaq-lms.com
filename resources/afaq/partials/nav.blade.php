<style>
    .after-login {
    position: relative;
    display: flex;
    align-items: center;
}


.drop-dawn-user-list.active,
.cart-popup-setion.active,
.popup-notic-card.active,
.after-login.carts-cardd:hover .cart-popup-setion {
    display: block;
    transform: scale(1);
    transition: .3s ease-in-out;
}
.user-name {
    position: relative;
    display: flex;
    align-items: center;
    color: #000000;
    font-weight: 500;
    cursor: pointer;
}
.user-img {
    width: 50px;
    height: 50px;
    padding: 3px;
    background: #fff;
    border-radius: 50%;
}
.user-img img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}
.drop-dawn-user-list ul {
    list-style: none;
    padding: 10px 3px;
    margin: 0;
}
.user-name {
    position: relative;
    display: flex;
    align-items: center;
    color: #111111;
    font-weight: 700;
    cursor: pointer;
}
.notifc-card-nd, .notifc-card-nd_ {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 55px;
    left: 0;
    background: #ffffff00;
    transition: .3s ease-in-out;
    display: none;
}
.notifc-card-nd.active, .notifc-card-nd_.active {
    display: block;
}
.rtl header.header .drop-dawn-user-list {
    left: 0 !important;
    right: unset;
}
header.header .drop-dawn-user-list {
    top: 55px;
    transition: .3s ease-in-out;
    right: 0;
    -webkit-transition: .3s ease-in-out;
    -moz-transition: .3s ease-in-out;
    -ms-transition: .3s ease-in-out;
    -o-transition: .3s ease-in-out;
}
.drop-dawn-user-list ul {
    list-style: none;
    padding: 10px;
    margin: 0;
}
.drop-dawn-user-list ul li {
    transition: .3s ease-in-out;
}
nav.menu.d-flex.justify-content-between.align-items-center.col-10.offset-1 {
    width: 90% !important;
    margin: 0 auto !important;
    max-width: 90% !important;
    /* flex: 0 0 95%; */
    font-size: 14px;
    padding: 0 !important;
}
.drop-dawn-user-list {
    position: absolute;
    background: #fff;
    border-radius: 6px;
    box-shadow: 0px 5px 16px;
    /* display: none; */
    transform: scale(0);
    top: 60px;
    right: -90px;
}
.drop-dawn-user-list.active, .cart-popup-setion.active, .popup-notic-card.active, .after-login.carts-cardd:hover .cart-popup-setion {
    display: block;
    transform: scale(1);
    transition: .3s ease-in-out;
}
</style>
<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav bookmark-icons">
                        @if(count(config('panel.available_languages', [])) > 1)
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flag-icon  {{ app()->getLocale() =='en' ? 'flag-icon-us' : 'flag-icon-sa' }}"></i><span class="selected-language">{{ app()->getLocale() =='en' ? 'English' : 'العربية' }}</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                @foreach(config('panel.available_languages') as $langLocale => $langName)
                                <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}" data-language="en"><i class="flag-icon {{ $langLocale =='en' ? 'flag-icon-us' : 'flag-icon-sa' }}"></i> {{ strtoupper($langLocale) }} ({{ $langName }})</a>
                                @endforeach
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="/" target="_blank"><img  src="{{asset('afaq\logo.png')}}" style="width: 30px;"> </a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                            <input class="input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="template-list">
                            <div class="search-input-close"><i class="feather icon-x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>
                    @php($alertsCount = auth()->user()->userUserAlerts()->where('read' , 0)->count())

                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon feather icon-bell"></i>
                            @if($alertsCount > 0)
                            <span class="badge badge-pill badge-primary badge-up">{{ $alertsCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            @if($alertsCount > 0)
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <span class="notification-title">{{ $alertsCount }} Notifications</span>
                                </div>
                            </li>
                            @else
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">{{ trans('global.no_alerts') }}</h3>
                                </div>
                            </li>
                            @endif

                            @if($alertsCount > 0 && count($alerts = auth()->user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                            <li class="scrollable-container media-list">

                                @foreach($alerts as $key => $alert)

                                <a class="d-flex justify-content-between" href="{{ $alert->alert_link ? $alert->alert_link : '#' }}">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                                        <div class="media-body">
                                            <h6 class="primary media-heading">{{ $alert->alert_text }}</h6>
                                        </div><small>
                                            <time class="media-meta" datetime="{{ $alert->created_at ? $alert->created_at : '' }}">{{ $alert->created_at ? $alert->created_at->diffForHumans() : "#" }}</time></small>
                                    </div>
                                </a>

                                @endforeach

                            </li>
                            @endif

                        </ul>
                    </li>

                    {{-- <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{auth()->user()->name}}</span>
                                <span class="user-status">{{auth()->user()->roles()->first()->title}}</span>
                            </div><span><img class="round" src="{{ isset(auth()->user()->personal_photo->url) ? asset(auth()->user()->personal_photo->url) : '../../../app-assets/images/portrait/small/avatar-s-11.jpg'}}" alt="avatar" height="40" width="40">
                            </span>
                        </a>
                    </li> --}}
                </ul>
                <div class="after-login">
                    <div class="user-name list-log_">
                        <div class="user-img">
                            <img src="{{ auth()->user()->personal_photo->url ?? asset('afaq/imgs/Groupimg.png') }}"
                                alt="">
                        </div>
                        <div class="user-name">
                            <span class="guest-name ellipsis ">
                                {{ app()->getLocale() == 'ar' ? auth()->user()->full_name_ar : auth()->user()->full_name_en }} </span>

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
{{--                                @if (auth()->check())--}}
{{--                                    @can('home_page_access')--}}
{{--                                        <li><a class="dropdown-item" href="{{ url('/admin') }}" target="_blank">--}}
{{--                                                <i class="fas fa-dashboard" style="margin:0 5px;"></i>--}}
{{--                                                {{ __('lms.dashboard') }}</a></li>--}}
{{--                                    @endcan--}}
{{--                                @endif--}}
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
            </div>
        </div>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a class="pb-25" href="#">
            <h6 class="text-primary mb-0">Files</h6>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="../../../app-assets/images/icons/xls.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="../../../app-assets/images/icons/jpg.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="../../../app-assets/images/icons/pdf.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="../../../app-assets/images/icons/doc.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small>
        </a></li>
    <li class="d-flex align-items-center"><a class="pb-25" href="#">
            <h6 class="text-primary mb-0">Members</h6>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img src="../../../app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img src="../../../app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>
<!-- END: Header-->


