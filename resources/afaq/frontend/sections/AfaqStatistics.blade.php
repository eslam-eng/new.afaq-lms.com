<section class="Afaq-Statistics ">
    <div class="data-Afaq-Statistics">
        <div class="col-12">
            <div class="col-10 offset-1">
                <div class="section-Afaq-Statistics-title">
                    <span>{{__('afaq.Afaq_Statistics')}} </span>
                </div>
{{--                {{dd($statistics)}}--}}
                <div class="Afaq-Statistics-cards d-flex">
                    <div class="owl-carousel owl-theme Afaq-Statistics-slider">
                        @foreach($statistics as $statistic)
                        <div class="card-Statistics">
                            <em>{{__('afaq.More_Than')}} </em>
                            <div class="d-flex justify-content-between align-items-center img-Afaq-Statistics">
                                <span>{{$statistic->statistic_count + 1000}}</span>
                                <img src="{{$statistic->satatistic_icon}}" alt="">
                            </div>
                            <p>{{$statistic->statistic_name}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- *********** end-Afaq-Statistics ******************** -->
