<section class="our-work all-icon-test-work">
    <div class="all-work-type container">
        <div class="all-work-type-name">
        <div class="right-side-work-type onmobile">
                <div class="work-type-title">
                    <span>{{__('frontend.subtitle_one')}}</span>
                  <em>

                      <!-- <em>
                      <i class="fas fa-arrow-left"></i>
                      </em> -->
                      {{__('frontend.slider_sub_text')}}
                    </em>
                </div>
            </div>
            <div class=" left-side-work-type">
                @foreach($iconTexts as $k1=>$v1)
                <div class="work-type-description">
                    <div class="work-img">
                        <img src="{{asset($v1->image->url ?? '')}}" alt="" />
                        <!-- <img src="/nazil/imgs/Group 6.png" alt=""> -->
                    </div>
                    <div class="work-name">
                        <span>{{app()->getLocale() == 'en' ? $v1->title_en :$v1->title_ar}}</span>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="right-side-work-type notmobile">
                <div class="work-type-title">
                    <span>{{__('frontend.subtitle_one')}}</span>
                  <em>

                      <!-- <em>
                      <i class="fas fa-arrow-left"></i>
                      </em> -->
                      {{__('frontend.slider_sub_text')}}
                    </em>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <div class="overlay-heaight-"></div> -->
