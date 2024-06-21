<section class="Trusted-By">
    <div class="Trusted-By-section">
        <div class="col-12">
            <div class="col-10 offset-1">
                <div class="Trusted-By_">
                    <div class="section-Trusted-title">
                        <span>{{__('afaq.Trusted_by')}}</span>
                    </div>
                    {{-- @if (count($courseSponsors)> 4)

                    @else

                    @endif --}}
                    <div class="Trusted-By-logo owl-carousel">
                        @foreach($courseSponsors as $v1)
                        <div class="Trusted-By-img">
                            <img  src="{{asset($v1->image_url  ?? '')}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- *********** end-Trusted-By ******************** -->
