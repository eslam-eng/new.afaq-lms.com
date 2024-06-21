@extends('frontend.business.layout.main')
@section('title' ,__('afaq.afaq_business'))
@section('content')
<!-- *********** start-bunner ******************** -->
@include('frontend.business.partials.home.banner')
<!-- *********** end-bunner ******************** -->


<!-- *********** start-wide-range * Medical type******************* -->
@include('frontend.business.partials.home.business_feature_widerange')
<!-- *********** end-wide-range ******************** -->

<!-- *********** start-Our-Packages ******************** -->
@include('frontend.business.partials.home.business_packages')

<!-- *********** end-Packages ******************** -->

<!-- ***********start-afaq-business ******************** -->
@include('frontend.business.partials.home.business_need')
<!-- *********** end-afaq-business ******************** -->


<!-- *********** start-Slider activities ******************** -->
@include('frontend.business.partials.home.business_slider')
<!-- *********** end-Top-activities ******************** -->

<!-- *********** start-afaq-statistics ******************** -->
@include('frontend.business.partials.home.business_statistics')
<!-- *********** end-afaq-statistics ******************** -->

@include('frontend.business.partials.home.business_partners')
<!-- *********** end-Our-partners ******************** -->

<!-- *********** start-next-afaq-testminals ******************** -->
@include('frontend.business.partials.home.business_testimonials')

<!-- *********** end-next-afaq-statistics ******************** -->



<!-- *********** end-Our-Clients ******parteners************** -->



@endsection
