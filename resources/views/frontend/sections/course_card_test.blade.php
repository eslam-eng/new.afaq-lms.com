<link href="{{ asset('frontend/css/course_card.css') }}?v={{time()}}" rel="stylesheet">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->
<link rel="stylesheet" href="{{ asset('afaq/new-assets/css/bootstrap.min.css') }}"><!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<!-- <link href="{{ asset('frontend/css/responsive.css ')}}" rel="stylesheet"> -->
<link href="{{ asset('frontend/css/style.css') }}?v={{time()}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('afaq/new-assets/owl-carousel/owl.theme.default.min.css') }}">

             @foreach($courses as $k1=>$v1)
                <div class="latestcourse-card" onclick="location.href='{{url('/'.app()->getLocale().'/one-courses/'.$v1->id)}}'"
                    onmouseover="show_card_details(this)" onmouseleave="hide_card_details(this)">
                    <div class="latestcourse-card-data">
                        <div class="latestcourse-card-img">

                            <div class="course-track"> training </div>

                            <img class="venue-type" src="/nazil/imgs/live-course.svg" alt="course type">

                            <img src="{{isset($v1->image->url) ? $v1->image->url : asset('/nazil/imgs/new-page/Group 13513.png')}}">

                            <img class="provider-logo" src="/nazil/imgs/Saudian_Ministry_of_Health_logo.png" alt="provider logo">

                            @include('frontend.sections.cme_hours')

                        </div>
                        <div class="latestcourse-card-all-details">
                            <span>
                                {{app()->getLocale()=='en' ? $v1->name_en ?? '' : $v1->name_ar ?? ''}}
                            </span>
                        </div>
                        <div class="latestcourse-card-time ">
                            <div>
                            <p>
                                {{ trans('global.available_now') }}
                            </p>
                            <div class="latestcourse-date">
                            <i class="fa-regular fa-calendar"></i>
                                {{$v1->start_date ? date('D d, M Y' , strtotime($v1->start_date)) : ''}}
                            </div>
                            </div>

                            <div class="the-latestcourse-btn-type">
                                <!-- @if($v1->today_price)
                                <button class="latestcourse-btn-type free-latestcourse">{{$v1->today_price ." ". __('lms.SR') }}</button>
                                @elseif($v1->price)
                                <button class="latestcourse-btn-type free-latestcourse">{{$v1->price ." ". __('lms.SR') }}</button>
                                @else
                                <button class="latestcourse-btn-type free-latestcourse">{{__('lms.free')}}</button>
                                @endif
                                <button class="latestcourse-btn-type online-latestcourse">{{$v1->course_place ? __('lms.'.$v1->course_place) : ''}}</button> -->
                                <del class="old-price">
                                    400 SAR
                                </del>
                                <button class="latestcourse-btn-type price-on-card">350 SAR</button>

                            </div>

                        </div>
                        <div class="latestcourse-card-hover d-flex flex-column">
                            <div class="hover-top d-flex flex-row">
                                <img class="provider-logo" src="/nazil/imgs/Saudian_Ministry_of_Health_logo.png" alt="provider logo">
                                <img class="venue-type" src="/nazil/imgs/live-course.svg" alt="course type">
                            </div>
                            <br>

                            <h2>ICD 10 Australian - Upgrading From 6th Edition To 10th Edition</h2>
                            <p>The fact that a health practitioner is an expert in his field does not mean that he is able to train others. This course contains the definition of…</p>
                            <ul class="target-customers d-flex flex-row">
                                <li>Dentists</li>
                                <div style="width: 10px;"></div>
                                <li>Nurses</li>
                                <div style="width: 10px;"></div>
                                <li>Doctors</li>
                                <div style="width: 10px;"></div>
                                <li>Physicans</li>
                            </ul>
                            <ul class="course-info d-flex flex-row">
                                <li>
                                    <span class="material-symbols-outlined">
                                        language
                                    </span>
                                    <div style="width: 5px;"></div>
                                    <span>online</span>
                                </li>
                                <li>
                                    <span class="material-symbols-outlined">
                                        list
                                    </span>
                                    <div style="width: 5px;"></div>
                                    <span>lectures</span>
                                </li>
                                <li>
                                    <span class="material-symbols-outlined">
                                        schedule
                                    </span>
                                    <div style="width: 5px;"></div>
                                    <span>hours</span>
                                </li>
                            </ul>
                            <button class="join-now">
                                <span>{{ __('front.join') }}</span>
                                <div style="width: 10px; display: inline-block;"></div>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
<script src="{{asset('frontend/js/hover-card.js')}}"></script>

<script src="{{ asset('afaq/new-assets/js/bootstrap.min.js') }}"></script>
