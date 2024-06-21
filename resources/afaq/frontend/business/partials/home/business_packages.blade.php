<style>

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.css"
    integrity="sha512-zar81H5lVN36QFsq/da1hxpOLODXK4/oFwBGOFrvdWX6SBe3NWriWTQS6YQDVfW5fDeb2Vry41YQCELOe8cHww=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<section class="appropriate-package pxa">
    <div class="text-afaq-bs container">
        <strong>{{ __('afaq.Buss_packages') }}</strong>
    </div>
    <div class="container pk-style">
        <div class="row appropriate-package-afaq pt-5 on-web">
            <div class="appropriate-package-slider">
                @foreach ($BusinessPackages as $k1 => $v1)
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <a href="{{ url(app()->getLocale() . '/business-package_details') }}">
                        <div
                            class="@switch($loop->index)
                    @case(0)
                        one-sec-package
                        @break
                    @case(1)
                        two-sec-package
                        @break
                    @case(2)
                        thr-sec-package
                        @break
                    @case(3)
                        for-sec-package
                        @break
                    @default
                    one-sec-package
                @endswitch all-packages ">
                            <span>
                                {{ app()->getLocale() == 'en' ? $v1->package_name_en : $v1->package_name_ar }}
                            </span>
                            <small>{{ __('afaq.packages_best') }}</small>
                            <div class="packages-count">
                                {{--                            @if ($v1->price_package_month) --}}
{{--                                @if ($v1->price_package_month == 0)--}}
{{--                                    <span>{{ __('afaq.packages_free') }} </span>--}}
{{--                                @else--}}
{{--                                    <em class="count-num">{{ $v1->price_package_month }}</em>--}}
{{--                                    <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                    --}}{{-- <em class="count-date">{{__('afaq.packages/mon')}} </em> --}}
{{--                                @endif--}}
                                <em class="count-num">
                                    {{ __('afaq.request_free_offer') }}</em>
                            </div>
                            @if ($v1->online)
                                <div class="packages-details pt-1 pb-1">
                                    <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em>
                                    <span class="package-type">{{ trans('cruds.businessPackage.fields.online') }}</span>
                                </div>
                            @endif
                            @if ($v1->onsite)
                                <div class="packages-details pt-1 pb-1">
                                    <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em>
                                    <span class="package-type">{{ trans('cruds.businessPackage.fields.onsite') }}</span>
                                </div>
                            @endif
                            @if ($v1->hybrid)
                                <div class="packages-details pt-1 pb-1">
                                    <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em>
                                    <span class="package-type">{{ trans('cruds.businessPackage.fields.hybrid') }}</span>
                                </div>
                            @endif
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Mobile Packages ---->
        <div class="appropriate-package-afaq sm-lm-package pt-5 on-mob">



            <div class="swiper mySwiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($BusinessPackages as $k1 => $v1)

                        <div class="swiper-slide">
                            <a href="{{ url(app()->getLocale() . '/business-package_details') }}">
                            <div
                                class="@switch($loop->index)
        @case(0)
            one-sec-package
            @break
        @case(1)
            two-sec-package
            @break
        @case(2)
            thr-sec-package
            @break
        @case(3)
            for-sec-package
            @break
        @default
        one-sec-package
    @endswitch all-packages ">
                                <span>
                                    {{ app()->getLocale() == 'en' ? $v1->package_name_en : $v1->package_name_ar }}

                                </span>
                                <small>best choice for package</small>
                                <div class="packages-count">
{{--                                    @if ($v1->price_package_month == 0)--}}
{{--                                        <span>{{ __('afaq.packages_free') }} </span>--}}
{{--                                    @else--}}
{{--                                        <em class="count-num">{{ $v1->price_package_month }}</em>--}}
{{--                                        <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                        --}}{{-- <em class="count-date">{{__('afaq.packages/mon')}} </em> --}}
{{--                                    @endif--}}
                                    <em class="count-num">
                                        {{ __('afaq.request_free_offer') }}</em>
                                </div>
                                @if ($v1->online)
                                    <div class="packages-details pt-1 pb-1">
                                        <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em>
                                        <span
                                            class="package-type">{{ trans('cruds.businessPackage.fields.online') }}</span>
                                    </div>
                                @endif
                                @if ($v1->onsite)
                                    <div class="packages-details pt-1 pb-1">
                                        <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em>
                                        <span
                                            class="package-type">{{ trans('cruds.businessPackage.fields.onsite') }}</span>
                                    </div>
                                @endif
                                @if ($v1->hybrid)
                                    <div class="packages-details pt-1 pb-1">
                                        <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em>
                                        <span
                                            class="package-type">{{ trans('cruds.businessPackage.fields.hybrid') }}</span>
                                    </div>
                                @endif

                            </div>
                            </a>
                        </div>
                    @endforeach
                    ...

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
        <div class="all-appropriate-package">
            <a href="{{ url(app()->getLocale() . '/business-package_details') }}">
                <span>{{ __('afaq.packages_find_more') }}</span>
                <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
        {{-- <div class="some-details-appropriate-package">
            <label for="">

                <img src="{{ asset('afaq\business/imgs/circle-exclamation-solid.svg') }}" alt="">
                {{__('afaq.packages_VAT')}}
            </label>
            <label for="">
                <img src="{{ asset('afaq\business/imgs/circle-exclamation-solid.svg') }}" alt="">
                {{__('afaq.packages_prices_valid_until')}}
            </label>
        </div> --}}
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.min.js"
    integrity="sha512-+z66PuMP/eeemN2MgRhPvI3G15FOBbsp5NcCJBojg6dZBEFL0Zoi0PEGkhjubEcQF7N1EpTX15LZvfuw+Ej95Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

</script>
