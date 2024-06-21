<section class="our-work">
    <div class="all-work-type">
        <div class="container">
            <div class="row align-items-start pt-2">
                @foreach($iconTextDes as $k1=>$v1)
                <div class="col-lg-4 col-md-12">
                    <div class="work-type-all d-flex justify-content-between">
                        <div class="work-type-img">
                            <img src="{{asset($v1->icon->url?? '')}}" alt="" />
                        </div>
                        <div style="width: 60px; display: inline-block;"></div>
                        <div class="work-type-details">
                            <h4>{{app()->getLocale() == 'en' ? $v1->text_en :$v1->text_ar}}</h4>
                            <p>
                                {{app()->getLocale() == 'en' ?  $v1->description_en : $v1->description_ar }}
                            </p>
                            <div class="btn-show-more">
                                <button class="show-more" onclick='window.location.href="{{app()->getLocale() == 'en' ?  $v1->link_en : $v1->link_ar}}"'>
                                    {{__('lms.join')}}  </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
