<section class="about-us container">
    <div class="all-card-newslider">
        <div class="container about-us-cards">
            <!-- <div class="d-flex justify-content-center">
                @foreach($sliderCards as $k1=>$v1)
                <div class="the-cards first-cad">
                    <div class="card-details">
                        <div class="card-icon">
                            <img src="{{asset($v1->image->url ?? '')}}" alt="" />
                            {{--<i class="fas fa-calendar-check"></i>--}}
                        </div>
                        <div class="card-title">
                            <h3>{{app()->getLocale() == 'en' ? $v1->title_en :$v1->title_ar}}</h3>
                            <p>
                                {{app()->getLocale() == 'en' ?  $v1->description_en : $v1->description_ar }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> -->
            <div class="card-about-us">
                <div class="title-about-uscard">
                <img src="/nazil/imgs/logo.png" alt="">
                    <div class="title-about-description">
                        <span>{{__('frontend.why')}}</span>
                        <em> {{__('frontend.why2')}}</em>
                    </div>

                </div>
                <div class="all-card-details ">
                    <div class="single-card-details">
                    <div class="single-card-details-img">
                            <img src="{{asset('/nazil/imgs/new-page/noun_budget_2380707.png')}}" alt="">
                        </div>
                        <div class="single-card-details-description">
                            <span>{{__('frontend.best_price')}}</span>
                            <em> {{__('frontend.best_price2')}}</em>
                        </div>


                    </div>
                    <div class="single-card-details">
                    <div class="single-card-details-img">
                            <img src="{{asset('/nazil/imgs/new-page/noun_quality_1078235.png')}}" alt="">
                        </div>
                        <div class="single-card-details-description">
                            <span>{{__('frontend.best')}}</span>
                            <em>{{__('frontend.best2')}}</em>
                        </div>


                    </div>
                    <div class="single-card-details">
                    <div class="single-card-details-img">
                            <img src="{{asset('/nazil/imgs/new-page/noun_protect_2632608.png')}}" alt="">
                        </div>
                        <div class="single-card-details-description">
                            <span>{{__('frontend.payment')}}</span>
                            <em> {{__('frontend.payment2')}}</em>
                        </div>


                    </div>
                    <div class="single-card-details">
                    <div class="single-card-details-img">
                            <img src="{{asset('/nazil/imgs/new-page/noun_support_1614138.png')}}" alt="">
                        </div>
                        <div class="single-card-details-description">
                            <span>{{__('frontend.support')}}</span>
                            <em>24/7</em>
                        </div>


                    </div>
                </div>
            </div>
            <div class="last-section-traning onweb-view">
                <div class="our-training">
                    <div class="trining-description">
                        <div class="trainnng">
                            <span>{{__('frontend.train')}}</span>
                            <em>{{__('frontend.train2')}}</em>

                        </div>
                        <div class="on-join">
                            <a href="https://forms.gle/WUrhBx6nuhjsH8Zg8" target="_blank">
                            <i class="fas fa-arrow-left"></i>
                                {{__('frontend.join')}}
                            </a>
                        </div>
                    </div>

                    <div class="trining-img">
                        <img src="{{asset('/nazil/imgs/new-page/Mask Group 6.png')}}" class="trining-img-first" alt="">
                        <img src="{{asset('/nazil/imgs/new-page/Mask Group 6 - Copy.png')}}" class="trining-img-last" alt="">
                    </div>

                </div>
            </div>
            <div class="last-section-traning onmobile-view">
                <div class="our-training">
                <div class="trining-img">
                        <img src="{{asset('/nazil/imgs/new-page/Mask Group 6.png')}}" alt="">
                    </div>
                    <div class="trining-description">
                        <div class="trainnng">
                            <span>{{__('frontend.train')}}</span>
                            <em>{{__('frontend.train2')}}</em>

                        </div>
                        <div class="on-join">
                            <a href="https://forms.gle/WUrhBx6nuhjsH8Zg8">
                            <i class="fas fa-arrow-left"></i>
                                {{__('frontend.join')}}
                            </a>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>
