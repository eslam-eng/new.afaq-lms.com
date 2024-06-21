<section class="slider elementor-section elementor-top-section ">
    <div class="flexslider kenburn-slider">
        <div class="slides flexslider-bunner d-flex">
            <div class="left-side-slider-items ">
                <div class="fixed-side-header ">
                    <div class="search-toggler-unit">
                        <div class="search-toggler">
                            <i class="fa fa-search"></i>
                        </div>
                        <!-- *********************************** -->
                    </div>
                    <div class="welcome ">
                        <div class="lang-">
                            <div class="lang">
                                <a href="{{url((app()->getLocale() == 'en' ? '/ar/' : '/en/') . \Request::segment(2).'/'.\Request::segment(3))}}">
                                    {{app()->getLocale() == 'en' ? 'Ar' : 'En'}}</a>
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
                            <img src="/nazil/imgs/new-page/Group 13414.png" alt="">
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

                                                        <span class="new-price-cart">{{ isset($item->course->today_price) ? $item->course->today_price .  __('lms.currency') : '' }}</span>

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
                            <a class="dropdown-item" href="{{url('/admin')}}">
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
                            <span>{{__('frontend.from_twitter')}}</span>
                        </a>
                    </div>

                </div>
            </div>
            <!-- ************************************************************** -->
            <div id="carouselExampleFade" class="carousel slide kenburn-slider-bunner carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators slider-dots">
                    @foreach($sliders as $k=>$slide)
                        <li data-target="#carouselExampleFade" data-slide-to={{$k}} class="slider-dots-item {{ $k == 0 ? 'active' : ''}}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner kenburn-slider-thebunner">
                    @foreach($sliders as $k1=>$v1)
                    <div class="carousel-item kenburn-slider-item  {{ $k1 == 0 ? 'active' : ''}}">
                        <div class="slide-img">
                            <a href="{{app()->getLocale() == 'en' ? $v1->link_en ?? '' : $v1->link_ar ?? ''}}" target="_blank">
                                <img class="d-block" src="{{asset(app()->getLocale() == 'en' ? $v1->image->url ?? '' : $v1->image_ar->url ?? '')}}" alt="First slide">
                            </a>
                        </div>
                        <div class="container">

                            <div class="our-nest-vesion">

                                <span> {{__('frontend.publishing')}}</span>
                                <div class="data-vesion">
                                    .... <em>2030</em>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>

    </div>

</section>


<!-- home page carousel on mobile -->

<div id="carousel_mobile" class="owl-carousel homepage_mobile_carousel">
    @foreach($sliders as $k1=>$v1)
    <div class="">
        <div class="slide-img">
            <!-- <img class="d-block w-100" src="{{asset(app()->getLocale() == 'en' ? $v1->image->url ?? '' : $v1->image_ar->url ?? '')}}" alt="First slide"> -->
            <a href="{{app()->getLocale() == 'en' ? $v1->link_en ?? '' : $v1->link_ar ?? ''}}" target="_blank">
                <img class="d-block w-100" src="{{asset(app()->getLocale() == 'en' ? $v1->mobile_image_en->url ?? '' : $v1->mobile_image_ar->url ?? '')}}" alt="First slide">
            </a>
        </div>
        <div class="container">

            <div class="our-nest-vesion">

                <span> {{__('frontend.publishing')}}</span>
                <div class="data-vesion">
                    .... <em>2030</em>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
