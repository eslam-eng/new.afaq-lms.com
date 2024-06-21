@extends('layouts.front')
@section('content')
<style>
    .innerheader-nd {
        height: 45vh !important;
    }
    .precemp{
      bottom: 170px;
    }
    @media screen and (max-width: 1200px) {
        .innerheader-nd {
        height: 65vh !important;
    }
    }
    @media screen and (max-width: 830px) {
      .precemp {
      bottom: 30px;
   }
}
</style>
<section class="idu-programss">
    <div class="container sit-container">
        <div class="member-ship-lms all-courses-nd mx-5 my-5">
            <span class="member-sna">{{__('lms.membership')}}</span>
        </div>
        <div class="lms-memmber-card courses_filters courses_filters-nd">
            <h2>{{__('lms.subscripe_membership')}}</h2>
            <p>
                {{__('lms.welcome_membership')}}
            </p>

        </div>
        <div class="stm-lms-show-member">
            <div class="stm-lms-text-member">
                <span>
                    <i>{{__('lms.membership_video')}}</i>
                    <em>
                        <i>{{__('lms.membership_membership')}}</i></em>
                </span>
            </div>
            <div class="stm-lms-video">
                <p style="text-align: center;"><iframe style="width: 600px; height: 400px; border-radius: 5%;" title="About-Us" src="https://www.youtube.com/embed/1nvFQOvSfqM?autoplay=1"></iframe></p>
            </div>
        </div>
        <div class="stm-lms-coursgoals">
            <div class="stm-lms-snacoursgoals nd_lms_cours_support">
                <div class="stm_lms_course__content stm-lms-snatitle d-flex justify-content-start align-items-center">
                    <i class="fas fa-plus-circle"></i>
                    <i class="fas fa-minus-circle"></i>
                    <h4 class="description">{{__('lms.Membership_Benefits')}}</h4>
                </div>
                <div class="lms-snacoursgoals-all">
                    <div class="Course_objectives ">

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_1')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_2')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_3')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_4')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_5')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_6')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_7')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_8')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_9')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_10')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_11')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_Benefits_12')}}
                        </p>



                    </div>
                </div>
            </div>
            <div class="stm-lms-snacoursgoals nd_lms_cours_support">
                <div class="stm_lms_course__content stm-lms-snatitle d-flex justify-content-start align-items-center">
                    <i class="fas fa-plus-circle"></i>
                    <i class="fas fa-minus-circle"></i>
                    <h4 class="description">{{__('lms.Membership_responsibility')}}</h4>
                </div>
                <div class="lms-snacoursgoals-all">
                    <div class="Course_objectives ">
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_responsibility_0')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_responsibility_1')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_responsibility_2')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_responsibility_3')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_responsibility_4')}}
                        </p>



{{--                        <p>--}}
{{--                            @if( '{{__(lms.Membership_responsibility_6)}}' ==0)--}}

{{--                            @else--}}
{{--                            <i class="far fa-check-circle"></i>--}}
{{--                            {{__('lms.Membership_responsibility_6')}}--}}
{{--                            @endif--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            @if( '{{__(lms.Membership_responsibility_7)}}' == 0)--}}

{{--                            @else--}}
{{--                            <i class="far fa-check-circle"></i>--}}
{{--                            {{__('lms.Membership_responsibility_7')}}--}}
{{--                            @endif--}}
{{--                        </p>--}}



                    </div>
                </div>
            </div>


            <div class="stm-lms-snacoursgoals nd_lms_cours_support">
                <div class="stm_lms_course__content stm-lms-snatitle d-flex justify-content-start align-items-center">
                    <i class="fas fa-plus-circle"></i>
                    <i class="fas fa-minus-circle"></i>
                    <h4 class="description">{{__('lms.Membership_price')}}</h4>
                </div>
                <div class="lms-snacoursgoals-all">
                    <div class="Course_objectives ">
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_price_1')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_price_2')}}
                        </p>

                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_price_3')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_price_4')}}
                        </p>
                        <p>
                            <i class="far fa-check-circle"></i>
                            {{__('lms.Membership_price_5')}}
                        </p>

                    </div>
                </div>
            </div>

            <span>{{__('lms.fees-type')}}</span>

            @foreach($membershipTypes as $membershipType)
            <div class="stm-lms-snacoursgoals nd_lms_cours_support">
                <div class="stm_lms_course__content stm-lms-snatitle d-flex justify-content-start align-items-center">
                    <i class="fas fa-plus-circle"></i>
                    <i class="fas fa-minus-circle"></i>
                    <h4 class="description">{{app()->getLocale() == 'en' ?  $membershipType->name_en : $membershipType->name_ar }}</h4>
                </div>
                <div class="lms-snacoursgoals-all">
                    <div class="Course_objectives ">
                        {!! app()->getLocale() == 'en' ? $membershipType->description_en : $membershipType->description_ar !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        <div class="fees-Organic" style="margin-top: 100px; margin-bottom: 100px;">
            <div class="stm-fees-Organic">
                <div class="stm-fees-Organic-text ">
                    <span><i>{{__('lms.fees-Organicone')}}</i> <em><i>{{__('lms.fees-Organictwo')}}</i></em></span>
                </div>
                <div class="all-stm-fees-Organic-card">
                    @foreach($memberships as $membership)
                    <div class="fees-Organic-card nd_lms_cours_support">
                        <a href="{{ $membership->link }}">
                            <div class="fees-Organic-icon"><i class="fas fa-user-plus"></i></div>
                            <div class="stm-Organic-time">
                                <span>{{ __('lms.'.$membership->time_type , ['member' => app()->getLocale() == 'ar'  ? $membership->membership_type->name_ar : $membership->membership_type->name_en]) }}</span>
                            </div>
                            <div class="stm-Organic-number">
                                <span>{{ $membership->price }} {{__('lms.SR')}}</span>
                            </div>
                            <div class="stm-Organic-count">
                                <span> {{ __('lms.'.$membership->time_type ,['member' => ''] ) }}  </span>
                            </div>
                            <button id="subscribe-lms" class="subscribe-lms" onclick="increment_count('{{$membership->id}}');"><span>{{__('lms.subscribe_now')}}</span></button>
                            <!-- location.href='{{ $membership->link }}'; -->
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</section>

@endsection

@section('scripts')
<script>
    function increment_count(id) {
        $.ajax({
                headers: {
                    'x-csrf-token': _token
                },
                method: 'POST',
                url: "{{'/'.app()->getLocale().'/subscribe_count/'}}" + id,
                data: {
                    id: id,
                }
            })
            .done(function(data) {
                console.log(data);
            })
    }
</script>
@endsection
