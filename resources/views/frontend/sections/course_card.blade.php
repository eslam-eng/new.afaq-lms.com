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
                @include('frontend.partials.course-card',['course' => $v1])

                @endforeach
            </div>

            <div class="latestcourse-left-side mt-4 onmobil">
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

    </div>
</section>
