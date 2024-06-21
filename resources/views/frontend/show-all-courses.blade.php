@extends('layouts.front')
@section('content')
<style>
   .innerheader-nd {
      height: 55vh !important;
   }

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
               {{-- <div class="col-lg-3">
                  <div class="empty-div"></div>
                  <div class="course-view-type justify-content-center d-flex align-items-center">
                     <span class="horizental"><i class="fa fa-th"></i></span>
                     <span class="vertical active-icon"><i class="fas fa-list-ul"></i></span>
                  </div>
               </div> --}}
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
                              {{-- <i class="fas fa-table"></i>  --}}
                              {{ __('frontend.show_all') }}</button>

                            @foreach ($tracks as $track )
                                <button name="track_id" value="{{ $track->id }}" class="{{ (request('track_id') && request('track_id') == $track->id) ? 'active-filter' : '' }} filter btn btn-default btn-filter row pt-2">
                                   {{ $track->title }}</button>
                            @endforeach
                        </div>
                     </div>
                  </div>

               </div>

               <div class="col-lg-9 row" style="height: fit-content;">
                    @foreach($courses as $course)
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

                                          @if($course->today_price)
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
                                    {{-- @if ($course->instructor) --}}

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

                                          @if($course->today_price)
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


                  @if($courses instanceof \Illuminate\Pagination\LengthAwarePaginator )
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
</script>
@endsection
