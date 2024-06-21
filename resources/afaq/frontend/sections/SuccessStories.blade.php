<section class="Our-Success-Stories ">
    <div class="Success-Stories-">
        <div class="all-Success d-flex">
            <div class="Success-title">
                <span>{{__('afaq.Success_Stories')}}  </span>
                <p>
                    {{__('afaq.Success_data')}}


                </p>
                <div class="Host-with-Us-Now">
                    {{-- {{ url('/' . app()->getLocale() . '/ideal_partner') }} --}}
                    <a href= {{ url('/' . app()->getLocale() . '/ideal_partner') }}>
                        {{__('afaq.Host_Us')}}
                        <!-- <span style="width:20px ;display: inline-block;"></span> -->
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="card-Success">
                <div class="card-Success-data owl-carousel owl-theme">
{{--                    {{dd($testimonials)}}--}}
                    @foreach($testimonials as $k1=>$v1)
                    <div class="items-card-Success-data" >
                        <a href="{{ url('/' . app()->getLocale() . '/ideal_partner_details/' . $v1->id) }}">
                        <div class="img-card-Success">
                            <img 
                                 src="{{asset($v1->image->url  ?? '')}}" alt="">
                        </div>
                        <div class="deails-card-Success">
                            <div class="logo-card-Success">
                                <img 
                                     src="{{asset($v1->logo->url  ?? '')}}" alt="">
                            </div>
                            <span>
                                {{app()->getLocale() == 'en' ? $v1->title_en :$v1->title}}
                             </span>
                            <p>
                                {{app()->getLocale() == 'en' ? $v1->description_en :$v1->description}}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- *********** end-Our-Success-Stories ******************** -->
