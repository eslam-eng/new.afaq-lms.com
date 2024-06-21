<section class="next-afaq-bs pxa">
    <div class="text-afaq-bs container">
        <strong>{{__('afaq.Wide_Range')}} </strong>
        <div class="details-tabs pt-5">
            @foreach($BusinessSlider as $bus)
                <div class="d-flex ">
                    @if($loop->index % 2)
                    <div class="img-side-details {{$loop->index % 2 == 1 ? 'first-img-': 'sec-img-'}}">
                        <!-- <img src="imgs/anastasia-nelen-8JKNDO0Jtcc-unsplash22.png" alt=""> -->
                        <div class="carusel-one-img owl-carousel owl-theme">
                            {{-- For each slider images --}}
                            {{--                        @foreach ($BusinessSlider as $k1 => $v1)--}}
                            {{--                        <div class="item-img-carusel">--}}
                            {{--                            <img  src="{{ asset( $v1->image->url ?? '' ) }}"--}}
                            {{--                                 alt="First slide">--}}
                            {{--                        </div>--}}
                            {{--                        @endforeach--}}

                            @foreach($bus->image as $key => $media)
                                <div class="item-img-carusel">
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl() }}" alt="First">
                                    </a>
                                </div>
                            @endforeach

                            {{-- end ForEach slider images --}}


                        </div>

                    </div>
                    <div class="w-100-"></div>
                    <div class="details-side-content">
                        {{--                    <span>{{__('afaq.Wide_Range_title')}}</span>--}}
                        <span>{{app()->getLocale() == 'en' ? $bus->title_en ?? '' : $bus->title_ar ?? ''}}</span>

                        <p>
                            {{app()->getLocale() == 'en' ? $bus->short_description_en ?? '' : $bus->short_description_ar ?? ''}}
                        </p>
                    </div>
                    @else
                        <div class="details-side-content">
                            {{--                    <span>{{__('afaq.Wide_Range_title')}}</span>--}}
                            <span>{{app()->getLocale() == 'en' ? $bus->title_en ?? '' : $bus->title_ar ?? ''}}</span>

                            <p>
                                {{app()->getLocale() == 'en' ? $bus->short_description_en ?? '' : $bus->short_description_ar ?? ''}}
                            </p>
                        </div>
                        <div class="w-100-"></div>

                        <div class="img-side-details {{$loop->index % 2 == 1 ? 'first-img-': 'sec-img-'}}">
                            <!-- <img src="imgs/anastasia-nelen-8JKNDO0Jtcc-unsplash22.png" alt=""> -->
                            <div class="carusel-one-img owl-carousel owl-theme">
                                {{-- For each slider images --}}
                                @foreach($bus->image as $key => $media)
                                    <div class="item-img-carusel">
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl() }}" alt="First">
                                        </a>
                                    </div>
                                @endforeach

                                {{-- end ForEach slider images --}}


                            </div>

                        </div>

                    @endif
                </div>

            @endforeach
        </div>
    </div>
</section>
