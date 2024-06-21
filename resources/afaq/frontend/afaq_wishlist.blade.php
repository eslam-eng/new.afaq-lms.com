@extends('layouts.front')
@section('content')

<style>
     .card-result{
        margin-top: 150px;
    }
    .card-result.d-flex.flex-wrap .card-details.sm-card-list {
        width: 20vw !important;
    }
</style>

<div class="container">
    <div class="card-result d-flex flex-wrap  justify-content-between">
        @foreach ($wishlist as $list)

        <div class="card-details sm-card-list">
            @include('frontend.partials.topactivity-course-card', [
            'course' => $list->course,
            ])
        </div>
        @endforeach
    </div>
       <!-- **********************end carts-card********************* -->
                <!-- ************************ no carts -->
                <div class="checkout-carts-img mt-3 mb-5">


                        <span class="carts-number">

                            <em><strong> </strong>{{ __('lms.coursesCart') }}</em>
                            <div class="checkout-carts">
                                <div class="checkout-carts-img">

                                    <img src="{{ asset('/afaq/imgs/empty-box@2x.png') }}" alt="">
                                </div>
                                <div class="checkout-title confirming-btn">
                                    <h5>
                                        {{ __('lms.empitywishlist') }}
                                    </h5>
                                    <a
                                        href="{{ url('/' . app()->getLocale() . '/all-courses') }}">{{ __('frontend.eventandactivities') }}</a>
                                </div>



                            </div>
                        </span>

                </div>
</div>


@endsection
