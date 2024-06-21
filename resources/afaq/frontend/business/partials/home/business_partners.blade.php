<section class="Our-Clients pxa">
    <div class="text-afaq-bs container">
        <strong>{{__('afaq.Our_Clients')}}</strong>
    </div>
    <div class="container">
        <div class=" afaq-Our-Clients">
            <div class="owl-carousel owl-theme Our-Clients-slider ">
                @foreach($BusinessPartners as $k1=>$v1)
                <div class="afaq-client-skider">
                    <div class="sec-img-afaq-client">
                        <img src="{{asset($v1->image->url?? '')}}" alt="" />
                    </div>
                </div>
                @endforeach


            </div>
        </div>

    </div>
</section>
