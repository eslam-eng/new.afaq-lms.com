<section class="all-category all-category-courses">
    <div class="background-courses"></div>

    <div class="filter-category most-prodct container" id="most-prodct">

        <div id="containersasa" class=" portfolio-list  ">
            <div class="latestcourse- ">
                <div class="latestcourse-right-side">
                    <span>{{__('frontend.new_courses')}}</span>
                </div>
                <div class="latestcourse-left-side onlargweb">
                    @if(!auth()->check())
                    <a href="{{url(app()->getLocale().'/register')}}" class="latestcourse-btn">

                        {{__('frontend.join_us')}}
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    @endif
                    <a href="{{url(app()->getLocale().'/all-courses')}}" class="latestcourse-btn latestcourse-btn-active">

                        {{__('frontend.show_more')}}
                        <i class="fas fa-arrow-left"></i>
                    </a>

                </div>

            </div>

            <div class="latestcourse-all-item owl-carousel latestcourse-card-viewcard owl-theme">
                @foreach($courses as $k1=>$v1)
                <div class="latestcourse-card " onclick="location.href='{{url('/'.app()->getLocale().'/one-courses/'.$v1->id)}}'">
                    <div class="latestcourse-card-data">
                        <div class="latestcourse-card-img">
                            <img src="{{isset($v1->image->url) ? $v1->image->url : asset('/nazil/imgs/new-page/Group 13513.png')}}" alt="">
                                <span class="courses_lms_cmd">
                                 <em>CMD</em>
                                <em>{{$v1->lecture_hours ?? ''}}</em>
                             </span>
                            <span>{{$v1->courseTrack ? $v1->courseTrack->title : ''}}</span>
                        </div>
                        <div class="latestcourse-card-all-details">
                            <span>
                                {{app()->getLocale()=='en' ? $v1->name_en ?? '' : $v1->name_ar ?? ''}}
                            </span>
                        </div>
                        <div class="latestcourse-card-time ">
                            <div class="the-latestcourse-btn-type">
                                @if($v1->today_price)
                                <button class="latestcourse-btn-type free-latestcourse">{{$v1->today_price ." ". __('lms.SR') }}</button>
                                @elseif($v1->has_general_price)
                                <button class="latestcourse-btn-type free-latestcourse">{{$v1->price ." ". __('lms.SR') }}</button>
                                @elseif(count($v1->prices))
                                <button class="latestcourse-btn-type free-latestcourse">{{__('lms.different_prices')}}</button>
                                @else
                                    <button class="latestcourse-btn-type free-latestcourse">{{__('lms.free')}}</button>
                                @endif
                                <button class="latestcourse-btn-type online-latestcourse">{{$v1->coursePlace ? $v1->coursePlace->title : ''}}</button>
                            </div>

                            <div class="latestcourse-date">
                                <i class="fas fa-calendar-week"></i>
                                {{$v1->start_date ? date('D d, M Y' , strtotime($v1->start_date)) : ''}}
                            </div>

                        </div>
                        @if($v1->course_place == 'onsite')
                        <small>{{$v1->location ?? ''}}</small>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <div class="onmobil show-latestcourse">
            <div class="latestcourse-left-side">
                @if(!auth()->check())
                <a href="{{url(app()->getLocale().'/register')}}" class="latestcourse-btn">
                    <i class="fas fa-arrow-left"></i>
                    {{__('frontend.join_us')}}
                </a>
                @endif
                <a href="{{url(app()->getLocale().'/all-courses')}}" class="latestcourse-btn latestcourse-btn-active">
                    <i class="fas fa-arrow-left"></i>
                    {{__('frontend.show_more')}}
                </a>

            </div>
        </div>

    </div>
    <!-- <div class="btn-show-more">
        <button class="show-more">
            <a href="all-courses">{{__('lms.show')}}</a>
        </button>
    </div> -->
</section>
