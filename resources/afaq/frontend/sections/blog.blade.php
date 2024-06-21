

<section class="Investing-for-Your-Future">
    <div class="last-blog-data">
        <div class="container">
            <!-- <div class="Investing-for-Your-Future-title">
            <h2>{{__('lms.invest')}}</h2>
            <div class="row">
                @foreach($blogs as $k1=>$v1)
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="Investing-Future-card">
                        <a href="{{url('/'.app()->getLocale().'/blogs/view/'.$v1->id)}}">
                            <div class="Investing-Future-img">


                                <img src="{{isset($v1->featured_image->url) ? asset($v1->featured_image->url) : asset('afaq\logo.png')}}" alt="" >


                                <span ><i class="fas fa-plus-circle">
                                    </i></span>

                            </div>
                        </a>
                        <div class="Investing-Future-details d-flex ">
                            <div class="Investing-Future-date">
                                <div class="-Future-date">
                                    <em>08</em>
                                    <span>NOV</span>
                                </div>
                            </div>
                            <div style="width: 100px; display: inline-block;"></div>
                            <div class="Investing-Future-title">

                                <h5>{{app()->getLocale()=='en' ? $v1->title ?? '' : $v1->title_ar ?? ''}}</h5>
                                <p>
                                    {{app()->getLocale()=='en' ? $v1->excerpt ?? '' : $v1->excerpt_ar ?? ''}}
                                </p>
                                <span class="post-date">
                    {{__('lms.Posted_in')}} : <em> {{$v1->categories ? $v1->categories->pluck('name') : ""}}</em>
                    </span>
                                <span class="post-date">
                     {{__('lms.tags')}}: <em>{{$v1->tags ? $v1->tags->pluck('name') : ''}}</em>
                    </span>
                                <span class="post-date">
                      {{__('lms.Edited_By')}}: <em>{{ $v1->editor ? $v1->editor->pluck('name') : ''}}</em>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div> -->
            <div class="all-blogs pt-5">
                <div class="all-blogs-news  small-container">
                <h3>{{__('frontend.more_news2')}}</h3>
                    <a href="{{url(app()->getLocale().'/all-blogs') }}" class="all-blogs-news-more onweb-view">
                        {{__('frontend.more_news')}}
                        <i class="fas fa-arrow-left"></i>
                    </a>


                </div>

                <div>
                    <!-- Loading Screen -->

                    <div class="blogslider  onweb-view ">


                        @if(!empty($blogs))
                        @foreach($blogs as $k1=>$v1)
                        <div class="blogslider-items" onclick="location.href='{{url('/'.app()->getLocale().'/blogs/view/'.$v1->id)}}'">
                            <img data-u="image" src="{{isset($v1->featured_image->url) ? asset($v1->featured_image->url) : asset('afaq\logo.png')}}" />
                            <div class="data-blog">
                                <div class="data-blog-type">
                                    @foreach($v1->categories as $cat)
                                    <span>{{app()->getLocale()=='en' ? $cat->name ?? '' : $cat->name ?? ''}}</span>
                                    @endforeach
                                </div>
                                <div class="data-blog-date">
                                    <i class="fas fa-calendar-week"></i>
                                    <span>{{ $v1->created_at ? date('D d, M Y' , strtotime($v1->created_at)) : 'Mon 22, Nov 2021'}}</span>
                                </div>
                                <div class="data-blog-description">
                                    <span>{{app()->getLocale()=='en' ? $v1->title ?? '' : $v1->title_ar ?? ''}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif


                    </div>

                </div>
                <div class="blogslider onmobile-view ">
                    <div class=" owl-carousel latestcourse-card-viewcard owl-theme">
                        @if(!empty($blogs))
                        @foreach($blogs as $k1=>$v1)

                        <div class="blogslidersmall">

                            <img data-u="image" src="{{isset($v1->featured_image->url) ? asset($v1->featured_image->url) : asset('afaq\logo.png')}}" />
                            <div class="data-blog">
                                <div class="data-blog-type">
                                    @foreach($v1->categories as $cat)
                                    <span>{{app()->getLocale()=='en' ? $cat->name ?? '' : $cat->name ?? ''}}</span>
                                    @endforeach
                                </div>
                                <div class="data-blog-date">
                                    <i class="fas fa-calendar-week"></i>
                                    <span>{{ $v1->created_at ? date('D d, M Y' , strtotime($v1->created_at)) : 'Mon 22, Nov 2021'}}</span>
                                </div>
                                <div class="data-blog-description">
                                    <a href="{{url('/'.app()->getLocale().'/blogs/view/'.$v1->id)}}">
                                        <span>{{app()->getLocale()=='en' ? $v1->title ?? '' : $v1->title_ar ?? ''}}</span>
                                    </a>

                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="all-blogs-news  small-container">
                    <a href="{{url(app()->getLocale().'/all-blogs') }}" class="all-blogs-news-more onmobile-view">
                        <i class="fas fa-arrow-left"></i>
                        {{__('frontend.more_news')}}
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>
