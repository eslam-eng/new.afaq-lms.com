@extends('layouts.front')
@section('content')
<link rel="stylesheet" href="{{ asset('afaq/ideal_partners/css/partner.css') }}" >

<div class="layer-img" >
            <img src="{{ asset('afaq/ideal_partners/imgs/Group 41932.svg') }}" alt="">
        </div>
    <section class="partner-sec single-page-part details-pg">
        <div class="container">
            <div class="slider-partner">
                <div class="partner-carousel-item active">
                    <img  src="{{asset($testimonial->image->url  ?? '')}}" alt="..." class="d-block ">
                </div>
            </div>
            <div class=" page-details-par">
                <div class="suuport-img">
                    <img   src="{{asset($testimonial->logo->url  ?? '')}}"  alt="...">

                </div>
                <p>
                 {{app()->getLocale() == 'en' ? $testimonial->title_en :$testimonial->title}}
                </p>
                <span>
                    {{app()->getLocale() == 'en' ? $testimonial->description_en :$testimonial->description}}

                </span>
            </div>
        </div>
    </section>
@endsection
