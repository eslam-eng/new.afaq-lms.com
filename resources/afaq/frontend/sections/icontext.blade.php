<section class="Quick-Access">
    <div class="col-12">
        <div class="col-10 offset-1">
            <div class="Quick-Access-category d-flex align-items-center">
                <span>{{__('afaq.Quick_categories')}}</span>
                <div class="our-Quick-Access ">
                    <div class="owl-carousel owl-theme Quick-Access-slider">

                        @foreach($coursePlaces as $v1)

                        <div class="Quick-Access-partner">

                            <a href="{{ route('all-courses', ['locale' => app()->getLocale(),'type_id'=>array($v1->id)]) }}">

                            <picture>
                                <img 
                                     src="{{asset($v1->image_url  ?? '')}}" alt="">

                            </picture>
                        </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- *********** end-Quick-Access-categories ******************** -->
