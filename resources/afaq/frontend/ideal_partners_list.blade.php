@extends('layouts.front')
@section('content')
    <link rel="stylesheet" href="{{ asset('afaq/ideal_partners/css/partner.css') }}" >
    <div class="layer-img" >
{{--        <img src="afaq/ideal_partners/imgs/Group 41932.svg" alt="">--}}
        <img src="{{ asset('afaq/ideal_partners/imgs/Group 41932.svg') }}" alt="">
    </div>
    <section class="partner-sec">
        <div class="container">
            <div class="partiner-title"   style="text-align:center;">
                <span>
                    {{ __('afaq.perfectpartner') }}
                </span>
                 </div>
            <div class="partner-row">
                @foreach($testimonials as $k1=>$v1)
                <div class="partner-card">
                    <a href="{{ url('/' . app()->getLocale() . '/ideal_partner_details/' . $v1->id) }}">

                        <div class="partner-img">
                            <img  src="{{asset($v1->image->url  ?? '')}}" alt="">
                        </div>
                        <div class="partner-details">
                            <div class="suuport-img">
{{--                                <img src="imgs/big3.png" alt="">--}}
{{--                                <img src="{{ asset('afaq/ideal_partners/imgs/big3.png') }}" alt="">--}}
                                <img   src="{{asset($v1->logo->url  ?? '')}}" alt="">
                            </div>
                            <span>
                 {{app()->getLocale() == 'en' ? $v1->title_en :$v1->title}}
                </span>
                            <p>
                                {{app()->getLocale() == 'en' ? $v1->description_en :$v1->description}}
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- *********** end-bunner ******************** -->

@endsection
