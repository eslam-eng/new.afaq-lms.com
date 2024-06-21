@extends('layouts.front')
@section('title')
    <title>{{ __('frontend.eventandactivities') }}</title>
@endsection
<link rel="stylesheet" href="{{ asset('afaq/assests/css/search-style.css') }}">
@section('title' ,__('afaq.all-courses'))
@section('content')
    <style>
        .cme-hours>.cme-top>p {
            top: auto !important;
        }

        .br-ul li:last-of-type {
            font-size: 18px;
        }
        .card-result .card-details .shared-card.card-activities{
            width: 100%;
            height: 100%;
            box-shadow: 0px 8px 26px #00000017;
            background-color: #fff;
            border-radius: 5px;
        }

        .card-result .card-details .shared-card.card-activities .card-data{
            bottom: auto !important;
        }
        .card-details{
            box-shadow: none;
        }
    </style>
    {{--
   /* .precemp {
          bottom: 150px;
       } */
   @media (min-width: 990px) and (max-width: 1200px) {
      .innerheader-nd {
         height: 60vh !important;
      }
   }

   @media screen and (max-width: 830px) {
      .precemp {
         bottom: 30px;
      }
   }
</style>
<section class="idu-programss">
   <div class="container sit-container show-all-course-page mb-5">
      <div class="all-courses-nd">
         <div class=" course-title">
            <h3> {{ __('frontend.eventandactivities') }}</h3>
         </div>
         <div class="on-filter-course-sort-by d-flex">
            <div class="course-option course-option-search-nd">
               <input value="{{ request('text') ?? '' }}" placeholder="{{ __('lms.search') }}" type="text" name="text" id="text" class="input-option-search-nd">
            </div>
            <button class="btn-active-search btn_filter option-search-nd">{{ __('lms.search') }}</button>
         </div>
      </div>
      <div class="all-courses">
         <div class="container">

            <div class="row courses_filters courses_filters-nd justify-content-between align-items-center">
               <div class="col-lg-9 ">
                  <div class="row">
                     <div class="course-sort-by col-lg-4">
                        <span>{{ __('lms.type') }}</span>
                        <div class="course-option">
                           <select name="category_id" id="category_id" class="no-search select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                              <option value="">{{ __('lms.select') }}</option>
                              @foreach ($courseCategories as $category)
                              <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                 {{ app()->getLocale() == 'en' ? $category->name_en : $category->name_ar }}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="course-sort-by col-lg-4">
                        <span>{{ __('lms.price') }}</span>
                        <div class="course-option">
                           <select name="price" id="price" class="no-search select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                              <option value="">{{ __('lms.all') }}</option>
                              <option value="free" {{ request('price') == 'free' ? 'selected' : '' }}>
                                 {{ __('lms.free') }}
                              </option>
                              <option value="paid" {{ request('price') == 'paid' ? 'selected' : '' }}>
                                 {{ __('lms.paid') }}
                              </option>
                           </select>
                        </div>
                     </div>
                     <div class="course-sort-by col-lg-4">
                        <span>{{ __('lms.sort_by') }}</span>
                        <div class="course-option">
                           <select name="sort" id="sort" class="no-search select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                              <option value="">{{ __('lms.select') }}</option>
                              <option value="date_high" {{ request('sort') == 'date_high' ? 'selected' : '' }}>
                                 {{ __('lms.release_new') }}
                              </option>
                              <option value="date_low" {{ request('sort') == 'date_low' ? 'selected' : '' }}>
                                 {{ __('lms.release_old') }}
                              </option>
                              <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                 {{ __('lms.price_high') }}
                              </option>
                              <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                 {{ __('lms.price_low') }}
                              </option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
                <div class="col-lg-3">
                  <div class="empty-div"></div>
                  <div class="course-view-type justify-content-center d-flex align-items-center">
                     <span class="horizental"><i class="fa fa-th"></i></span>
                     <span class="vertical active-icon"><i class="fas fa-list-ul"></i></span>
                  </div>
               </div>
            </div>

            @if ($courses)
            <div class="row">
               <div class="col-lg-3">
                  <div class="course-vertical">
                     <div class="course-vertical-card onright-side register p-3">
                        <span class="show-all-data">

                           {{ __('frontend.show_allcategoryy') }}
                        </span>
                        <div class="all-btn-filter">
                           <button name="all" value="all" class="{{ request('all') ? 'active-filter' : '' }} filter btn btn-default btn-filter row pt-2">
                              {{ __('frontend.show_all') }}</button>

                            @foreach ($tracks as $track)
                                <button name="track_id" value="{{ $track->id }}" class="{{ (request('track_id') && request('track_id') == $track->id) ? 'active-filter' : '' }} filter btn btn-default btn-filter row pt-2">
                                   {{ $track->title }}</button>
                            @endforeach
                        </div>
                     </div>
                  </div>

               </div>

               <div class="col-lg-9 row">
                    @foreach ($courses as $course)
                         @include('frontend.partials.course-card',['course' => $course])
                     @endforeach
                  </div>

                  <div class="allcourses-horizental">
                     <div class="all-courses-card">
                        <div class="row justify-content-center">
                           @foreach ($courses as $course)
                           <div class="thecard-category col-md-4 col-lg-4 col-sm-4 mb-5 mix All-Categories All-specialties Languages">
                              <div class="data-in-all-category">
                                 <div class="card-mst-img">
                                    <div class="card-category-img">
                                       <img src="{{ isset($course->image->url) ? $course->image->url : 'https://wordpresslms.nazil.net/wp-content/uploads/2021/10/course_image_106-scaled-544x322.jpg' }}" alt="">
                                       @if ($course->training_type)
                                       <span>{{ $course->training_type }}</span>
                                       @endif
                                    </div>
                                    <div class="card-category-description">
                                       <h3>{{ app()->getLocale() == 'en' ? $course->name_en : $course->name_ar }}
                                       </h3>
                                       <h5>
                                          <p><span style="font-size:.95rem;">{{ app()->getLocale() == 'en' ? $course->category->name_en ?? '' : $course->category->name_ar ?? '' }}</span><br>
                                          </p>
                                       </h5>
                                    </div>
                                    <div class="card-category-date d-flex justify-content-between">
                                       <div class="date-">
                                          <i class="fas fa-calendar-week"></i>
                                          @if ($course->start_date)
                                          <strong>{{ $course->start_date ? date('D d, M Y', strtotime($course->start_date)) : '' }}</strong>
                                          @endif
                                       </div>

                                       <div class="offer-type">

                                          @if ($course->today_price)
                                          <strong>{{$course->today_price ." ". __('lms.SR') }}</strong>
                                          @elseif($course->price)
                                          <strong>{{$course->price ." ". __('lms.SR') }}</strong>
                                          @else
                                          <strong>{{__('lms.free')}}</strong>
                                          @endif

                                       </div>
                                    </div>
                                 </div>

                                 <div class="data-in-all-category-filtter on-right">

                                    @if (count($course->course_instructor) > 0)
                                    @foreach ($course->course_instructor as $insta)
                                    <div class="stm_lms_courses__single--info_author">
                                       <div class="stm_lms_courses__single--info_author__avatar">
                                          <img alt="" src="{{ isset($insta->image->url) ? asset($insta->image->url) : 'https://sna.org.sa/wp-content/uploads/2021/05/logo.png' }}" class="avatar avatar-215 photo" height="215" width="215" >
                                       </div>
                                       <div class="stm_lms_courses__single--info_author__login">
                                          {{ $insta->name ?? '' }}
                                       </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="stm_lms_courses__single--info_title">
                                       <a href="#">
                                          <h4> {{ app()->getLocale() == 'en' ? $course->name_en ?? '' : $course->name_ar ?? '' }}
                                          </h4>
                                       </a>
                                    </div>
                                    <div class="stm_lms_courses__single--info_excerpt">
                                       {{ app()->getLocale() == 'en' ? substr($course->introduction_to_course_en, 0, 230) . '...' ?? '' : substr($course->introduction_to_course_ar, 0, 230) . '...' ?? '' }}
                                    </div>
                                    <div class="stm_lms_courses-data d-flex">
                                       <div class="courses-online">
                                          <i class="fas fa-signal"></i>

                                          <span>
                                             {{ $course->course_place ? __('lms.' . $course->course_place) : '' }}</span>
                                       </div>
                                       <div style="width: 15px; display: inline-block;"></div>
                                       <div class="courses-online">
                                          <i class="fa fa-users"></i>
                                          <span>{{ $course->seating_number }}
                                             {{ __('lms.seating') }} </span>
                                       </div>
                                       <div style="width: 15px; display: inline-block;"></div>
                                       <div class="courses-online">
                                          <i class="far fa-clock"></i>
                                          <span>{{ $course->lecture_hours }}{{ __('lms.hours') }}
                                          </span>
                                       </div>
                                    </div>
                                    <div class="stm_lms_courses__single--info_preview">
                                       <a href="{{ url('/' . app()->getLocale() . '/one-courses/' . $course->id) }}" class="heading_font">
                                          {{ __('lms.preview') }} </a>
                                    </div>
                                    <div class="free-wishlist d-flex justify-content-between">
                                       <!-- <div class="wishlist-icon">
                                           <i class="far fa-heart"></i>
                                        </div> -->

                                       <div class="offer-type">

                                          @if ($course->today_price)
                                          <strong>{{$course->today_price ." ". __('lms.SR') }}</strong>
                                          @elseif($course->price)
                                          <strong>{{$course->price ." ". __('lms.SR') }}</strong>
                                          @else
                                          <strong>{{__('lms.free')}}</strong>
                                          @endif

                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>


                  @if ($courses instanceof \Illuminate\Pagination\LengthAwarePaginator)
                  <div class="d-flex justify-content-center">
                     {!! $courses->links('vendor.pagination.bootstrap-4') !!}
                  </div>
                  @endif
               </div>
            </div>
            @endif
         </div>
      </div>
   </div>
</section> --}}

    <div class="br-div px-5" style="">
        <ul class="br-ul">
            <li><a href="{{ route('site-home', ['locale' => app()->getLocale()]) }}">{{ __('lms.homepage') }}</a> /</li>
            <li><a
                    href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">{{ __('frontend.eventandactivities') }}</a>
            </li>
        </ul>
    </div>

    <section class="search-result-page ">
        <div class="col-12 all-page-details_lms">
            <div class="col-10 offset-1">
                <div class="afaq-logo d-flex justify-content-center align-items-center">
                    <div class="afaq-img-log">
                        <img src="{{ asset('afaq/imgs/Group 41932.png') }}" alt="">
                    </div>
                    <form class="search-box- d-flex align-items-center justify-content-center" action="{{ url()->full() }}"
                        method="GET">
                        <input value="{{ request('q') ?? '' }}" placeholder="{{ __('lms.search') }}" type="text"
                            name="q" id="text" class="input-option-search-nd">
                        <button style="padding: 0.8rem"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="search-page-details ">
                    <div class="search-type-list">
                        <div class="sidebar-searhlist">
                            <div class="on-small-screen">
                                <div class="d-flex justify-content-between">
                                    <div class="decript-title Introduction-What-learn ">
                                        <div class="icons">
                                            <span class="small-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="big-icon">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                        </div>
                                        <strong>{{ __('afaq.Filters') }}</strong>
                                    </div>
                                    <div class="close-filtter-btn">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </div>
                                </div>
                            </div>
                            <form class="filter-form search-form" action="{{ url()->full() }}">
                                <input type="hidden" name="sort" class="sort-value">
                                <div class="filter-list">
                                    <div class="filtter-data d-flex align-items-center mb-2 radio-filter ">
                                        <input type="radio" name="fin" value="all"
                                            {{ request('fin') == 'all' ? 'checked' : '' }} class="filter-her">
                                        <em style="width:10px;"></em>
                                        <span>{{ __('lms.all') }}</span>
                                    </div>
                                    <div class="filtter-data d-flex align-items-center mb-2 radio-filter">
                                        <input type="radio" name="fin" value="free"
                                            {{ request('fin') == 'free' ? 'checked' : '' }} class="filter-her">
                                        <em style="width:10px;"></em>
                                        <span>{{ __('lms.free') }}</span>
                                    </div>
                                    <div class="filtter-data d-flex align-items-center mb-2 radio-filter">
                                        <input type="radio" name="fin" value="paid"
                                            {{ request('fin') == 'paid' ? 'checked' : '' }} class="filter-her">
                                        <em style="width:10px;"></em>
                                        <span>{{ __('lms.paid') }}</span>
                                    </div>
                                    <div class="all-filtter-data mt-3 mb-3">
                                        <div class="d-flex justify-content-between filtter-title filtter-one-afaq {{ request('track_id') ? 'active' : '' }}">
                                            <div class="filtter-name">
                                                <strong>{{ __('home.tracks') }}</strong>
                                            </div>
                                            <div class="filtter-icon">
                                                <span class="down down-one "><i class="fa-solid fa-chevron-down"></i></span>
                                                <span class="up up-one "><i class="fa-solid fa-chevron-right"></i></span>
                                            </div>
                                        </div>
                                        <div class="filtter-details filtter-one-details  {{ request('track_id') ? 'active' : '' }}">
                                            @foreach ($filters->tracks as $track)
                                                <div class="filtter-data d-flex align-items-center mb-2">
                                                    <input type="checkbox" class="filter-her"
                                                        @if (request('track_id') && in_array($track->key, request('track_id'))) checked @endif name="track_id[]"
                                                        value="{{ $track->key }}">
                                                    <em style="width:10px;"></em>
                                                    <span>{{ $track->value }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="all-filtter-data mt-3 mb-3">
                                        <div class="d-flex justify-content-between filtter-title filtter-two-afaq {{ request('specialty_id') ? 'active' : '' }}">
                                            <div class="filtter-name">
                                                <strong>{{ __('global.specialites') }}</strong>
                                            </div>
                                            <div class="filtter-icon">
                                                <span class="down down-two "><i class="fa-solid fa-chevron-down"></i></span>
                                                <span class="up up-two "><i class="fa-solid fa-chevron-right"></i></span>
                                            </div>
                                        </div>
                                        <div class="filtter-details filtter-two-details {{ request('specialty_id') ? 'active' : '' }}">
                                            @foreach ($filters->specialties as $specialty)
                                                <div class="filtter-data d-flex align-items-center mb-2">
                                                    <input type="checkbox" class="filter-her"
                                                        @if (request('specialty_id') && in_array($specialty->key, request('specialty_id'))) checked @endif name="specialty_id[]"
                                                        value="{{ $specialty->key }}">
                                                    <em style="width:10px;"></em>
                                                    <span>{{ $specialty->value }}</span>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
{{--                                    <div class="all-filtter-data mt-3 mb-3">--}}
{{--                                        <div class="d-flex justify-content-between filtter-title filtter-thr-afaq {{ request('language') ? 'active' : '' }}">--}}
{{--                                            <div class="filtter-name">--}}
{{--                                                <strong>{{ __('home.language') }}</strong>--}}
{{--                                            </div>--}}
{{--                                            <div class="filtter-icon">--}}
{{--                                                <span class="down down-thr "><i class="fa-solid fa-chevron-down"></i></span>--}}
{{--                                                <span class="up up-thr "><i class="fa-solid fa-chevron-right"></i></span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="filtter-details filtter-thr-details {{ request('language') ? 'active' : '' }}">--}}
{{--                                            @foreach ($filters->languages as $language)--}}
{{--                                                <div class="filtter-data d-flex align-items-center mb-2">--}}
{{--                                                    <input type="checkbox" class="filter-her"--}}
{{--                                                        @if (request('language') && in_array($language->key, request('language'))) checked @endif name="language[]"--}}
{{--                                                        value="{{ $language->key }}">--}}
{{--                                                    <em style="width:10px;"></em>--}}
{{--                                                    <span>{{ $language->value }}</span>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="all-filtter-data mt-3 mb-3">
                                        <div class="d-flex justify-content-between filtter-title filtter-fr-afaq {{ request('type_id') ? 'active' : '' }}">
                                            <div class="filtter-name">
                                                <strong>{{ __('home.types') }}</strong>
                                            </div>
                                            <div class="filtter-icon">
                                                <span class="down down-fr "><i class="fa-solid fa-chevron-down"></i></span>
                                                <span class="up up-fr"><i class="fa-solid fa-chevron-right"></i></span>
                                            </div>
                                        </div>
                                        <div class="filtter-details filtter-fr-details {{ request('type_id') ? 'active' : '' }}">
                                            @foreach ($filters->types as $type)
                                                <div class="filtter-data d-flex align-items-center mb-2">
                                                    <input type="checkbox" class="filter-her"
                                                        @if (request('type_id') && in_array($type->key, request('type_id'))) checked @endif name="type_id[]"
                                                        value="{{ $type->key }}">
                                                    <em style="width:10px;"></em>
                                                    <span>{{ $type->value }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="all-filtter-data mt-3 mb-3">
                                        <div class="d-flex justify-content-between filtter-title filtter-fv-afaq">
                                            <div class="filtter-name">
                                                <strong>{{ __('home.price') }}</strong>
                                            </div>
                                            <div class="filtter-icon">
                                                <span class="down down-fv "><i class="fa-solid fa-chevron-down"></i></span>
                                                <span class="up up-fv"><i class="fa-solid fa-chevron-right"></i></span>
                                            </div>
                                        </div>
                                        <div class="filtter-details filtter-fv-details {{ request('price') ? 'active' : '' }}">
                                            @foreach ($filters->prices as $price)
                                                <div class="filtter-data d-flex align-items-center mb-2">
                                                    <input type="radio" class="filter-her"
                                                        @if (request('price') && in_array($price->key, request('price'))) checked @endif name="price[]"
                                                        value="{{ $price->key }}">
                                                    <em style="width:10px;"></em>
                                                    <span>{{ $price->value }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="search-result-list">
                        <div class="d-flex justify-content-start sort-box">
                            <div class="on-small-screen">
                                <div class="filtter-btn d-flex align-items-center ">
                                    <span>{{ __('afaq.Filters') }}</span>
                                    <em><i class="fa-solid fa-filter"></i></em>
                                </div>
                            </div>
                            <s style="width: 10px;" class="on-small-screen"></s>
                            <div class="sort-by">
                                <select name="" id="" class="sort-select">
                                    <option value="">{{ __('afaq.sort_by') }}</option>
                                    <option value="last_create" {{ request('sort') == 'last_create' ? 'selected' : '' }}>
                                        {{ __('lms.release_new') }}
                                    </option>
                                    <option value="first_create"
                                        {{ request('sort') == 'first_create' ? 'selected' : '' }}>
                                        {{ __('lms.release_old') }}
                                    </option>
                                    <option value="most_price" {{ request('sort') == 'most_price' ? 'selected' : '' }}>
                                        {{ __('lms.price_high') }}
                                    </option>
                                    <option value="less_price" {{ request('sort') == 'less_price' ? 'selected' : '' }}>
                                        {{ __('lms.price_low') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="card-result d-flex flex-wrap mt-3 justify-content-around">
                            @forelse ($courses as $course)
                                <div class="card-details">
                                    @include('frontend.partials.topactivity-course-card')
                                </div>
                            @empty
                                <div class="w-100 d-flex flex-wrap justify-content-center">
                                    <div class="w-100 d-flex flex-wrap justify-content-center mb-3">
                                        <i style="font-size: 6rem;" class="fas fa-times-circle"></i>
                                    </div>
                                    <h3>{{ __('afaq.no_result_found') }}</h3>
                                </div>
                            @endforelse

                        </div>
                        @if ($courses->count() && $courses->hasPages())
                            <div class="d-flex justify-content-center">
                                {!! $courses->appends(request()->all())->links('frontend.partials.pagination') !!}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('select').on('change', function(e) {
            var url = window.location.href;
            var item = $(this).attr('name');
            var value = $('#' + item).val();
            url = updateQueryStringParameter(url, item, value);
            window.location = url;
        });

        // $('#text').on('change', function(e) {
        //    var url = window.location.href;
        //    var item = $(this).attr('name');
        //    var value = $('#' + item).val();
        //    url = updateQueryStringParameter(url, item, value);
        //    window.location = url;
        // });

        $('.filter').on('click', function(e) {
            cleanUrl();
            var url = window.location.href;
            var item = $(this).attr('name');
            var value = $(this).attr('value');
            url = updateQueryStringParameter(url, item, value);
            window.location = url;
        });

        $('.btn_filter').on('click', function(e) {
            var item = $('#text').attr('name');
            var value = $('#text').val();
            if (value != '') {
                cleanUrl();
                var url = window.location.href;
                url = updateQueryStringParameter(url, item, value);
                window.location = url;
            } else {
                alert('please, type text in search box ...')
            }
        });

        $(document).on('change', '.filter-her', function() {
            $('.filter-form').submit();
        });

        $(document).on('change', '.sort-select', function() {
            $('.sort-value').val($(this).val());
            $('.filter-form').submit();
        });
    </script>
@endsection
