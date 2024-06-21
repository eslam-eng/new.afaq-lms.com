<section class="bunner">
    <div class="container">
        <div class="bunner-row">
            <div class="bunner-left-side">
{{--                {{dd($Banner)}}--}}
                <h2>{{app()->getLocale()=='en' ? $Banner->title_en ?? '' : $Banner->title_ar ?? ''}}</h2>
                <strong>{!! app()->getLocale()=='en' ? $Banner->description_en ?? '' : $Banner->description_ar ?? '' !!}</strong>


                <p>{!!  app()->getLocale()=='en' ? $Banner->short_description_en ?? '' : $Banner->short_description_ar ?? ''!!}</p>
            </div>
            <div class="bunner-right-side">
                <div class="bunner-img">
                    <img src="{{ asset('afaq\business/imgs/Group 43643.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
