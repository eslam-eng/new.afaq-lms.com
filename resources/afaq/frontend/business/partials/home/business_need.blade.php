<section class="afaq-business-details pxa">
    <div class="text-afaq-bs container">
        <strong>{{ __('afaq.Business_Is_Just') }}</strong>
        <p>{{ __('afaq.Business_paragraph') }}</p>
        {{--        @foreach ($BusinessNeed as $blog) --}}
        <div class="afaq-details-cards on-web">
            <div class="one-card card-bk">
                <div class="icon-card">

                    {{--                    <img src="{{ asset('afaq\business/imgs/globe-light.png') }}" alt=""> --}}
                    <img src="{{ $BusinessNeed[0]->icon->getUrl() }}" alt="Broken">
                </div>
                <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[0]->short_description_en ?? '' : $BusinessNeed[0]->short_description_ar ?? '' }}
                </p>

            </div>
            <div class="d-flex justify-content-between">
                <div class="two-card card-bk">
                    <div class="icon-card">
                        {{--                        <img src="{{ asset('afaq\business/imgs/user-doctor-regular.svg') }}" alt=""> --}}
                        <img src="{{ $BusinessNeed[1]->icon->getUrl() }}" alt="">
                    </div>
                    <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[1]->short_description_en ?? '' : $BusinessNeed[1]->short_description_ar ?? '' }}
                    </p>
                </div>
                <div class="thr-card card-bk">
                    <div class="icon-card">
                        <img src="{{ $BusinessNeed[2]->icon->getUrl() }}" alt="">
                        {{--                        <img src="{{ asset('afaq\business/imgs/sheet-plastic-regular.png') }}" alt=""> --}}

                    </div>
                    <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[2]->short_description_en ?? '' : $BusinessNeed[2]->short_description_ar ?? '' }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="for-card card-bk">
                    <div class="icon-card">
                        <img src="{{ $BusinessNeed[3]->icon->getUrl() }}" alt="">

                    </div>
                    <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[3]->short_description_en ?? '' : $BusinessNeed[3]->short_description_ar ?? '' }}
                    </p>
                </div>
                <div class="fiv-card card-bk">
                    <div class="icon-card">
                        <img src="{{ $BusinessNeed[4]->icon->getUrl() }}" alt="">

                    </div>
                    <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[4]->short_description_en ?? '' : $BusinessNeed[4]->short_description_ar ?? '' }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="sx-card card-bk">
                    <div class="icon-card">
                        <img src="{{ $BusinessNeed[5]->icon->getUrl() }}" alt="">

                    </div>
                    <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[5]->short_description_en ?? '' : $BusinessNeed[5]->short_description_ar ?? '' }}
                    </p>
                </div>
                <div class="svn-card card-bk">
                    <div class="icon-card">
                        <img src="{{ $BusinessNeed[6]->icon->getUrl() }}" alt="">

                    </div>
                    <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[6]->short_description_en ?? '' : $BusinessNeed[6]->short_description_ar ?? '' }}
                    </p>
                </div>
            </div>
            <div class="last-card card-bk">
                <div class="icon-card">
                    <img src="{{ $BusinessNeed[7]->icon->getUrl() }}" alt="">

                </div>
                <p>{{ app()->getLocale() == 'en' ? $BusinessNeed[7]->short_description_en ?? '' : $BusinessNeed[7]->short_description_ar ?? '' }}
                </p>
            </div>
            <div class="img-afaq-bs">
                <img src="{{ asset('afaq\business/imgs/Group 43644.svg') }}" alt="">

            </div>
        </div>
        {{--        @endforeach --}}




        <!---Web Card---Loop Here--------------------->
        <div class="afaq-details-cards on-mob">
            <div class="afa-details-slider owl-carousel owl-theme">
{{--                {{dd($BusinessNeed)}}--}}
                @foreach ($BusinessNeed as $bu_need)

{{--                    @if ($loop->index > 8)--}}
                        <div class=" card-bk">
                            <div class="icon-card">
                                <img src="{{ $bu_need->icon->getUrl() }}" alt="">

                            </div>
                            <p>{{ $bu_need->short_description_en }}</p>
                        </div>
{{--                    @endif--}}
                @endforeach

            </div>
        </div>
        <!--End Mobile cards ------------>
    </div>
</section>
