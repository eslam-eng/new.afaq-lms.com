<section class="wide-range pxa">
    <div class="text-afaq-bs container">
        <strong>{{__('afaq.Business_Wide_Range')}}</strong>
    </div>
    <div class="container">
        <div class="wide-range-sec  pt-5">
            @foreach($BusinessFeature as $k1=>$v1)
            <div class="afaq-sec-wide">
                <div class="wide-range-icon">
                    <div class="range-img">
                        <img src="{{asset($v1->icon->url?? '')}}" alt="" />
                    </div>
                    <span class="range-title">{{app()->getLocale() == 'en' ? $v1->text_en :$v1->text_ar}}</span>
                </div>
            </div>
            @endforeach




        </div>
    </div>
</section>
