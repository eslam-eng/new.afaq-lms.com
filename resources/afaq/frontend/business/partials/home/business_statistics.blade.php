<section class="afaq-statistics pxa">
    <div class="text-afaq-bs container">
        <strong>{{__('afaq.Business_Statistics')}}</strong>
        <div class="row statistics-row">
                @foreach($statistics as $statistic)
                    <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 card-acc-bs">
                        <div class="sm-card">

                                <div class="sm-icon-card @switch($loop->index)
                    @case(0)
                        one-img
                        @break
                    @case(1)
                        tw-img
                        @break
                    @case(2)
                       thr-img
                        @break
                    @case(3)
                        for-img
                        @break
                    @default
                     one-img
                @endswitch  ">



                                <img src="{{$statistic->satatistic_icon}}" alt="">

                            </div>
                            <div class="sm-card-details">
                                <span>{{$statistic->statistic_count + 1000}}</span>
                                <em>{{$statistic->statistic_name}}</em>
                            </div>
                        </div>
                    </div>
                @endforeach

        </div>
    </div>
</section>
