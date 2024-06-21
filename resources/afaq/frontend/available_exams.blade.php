@extends('layouts.front')
@section('content')
<style>
    .innerheader-nd {
        height: 50vh !important;
    }

    @media screen and (max-width: 1200px) {
        .innerheader-nd {
            height: 65vh !important;
        }

        .home-page-nd.onregister-page {
            z-index: 1;
            position: relative;
        }
    }

    @media screen and (max-width: 830px) {
        .precemp {
            bottom: 30px;
        }
    }
</style>
<section class="idu-programss blog-page-nd testimony-page">
    <div class="container sit-container the-newblogpage-nd">
        <div class="my-testimony-page">
            <div class="row">
                @foreach($exams as $exam)
                <div class="col-lg-4 col-md-6">
                    <div class="testimony-card">
                        <div class="testimony-img">
                            <img src="{{isset($exam->image->url) ? $exam->image->url : '/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg'}}" alt="">
                            <div class="in-row-exam">
                                <span>
                                    @if($exam->available === 'joined_before')
                                    <a href="{{url('/'.app()->getLocale() . '/my_exams')}}">
                                        {{__('lms.'.$exam->available)}}
                                    </a>
                                    @elseif($exam->available == 'join')
                                    <a href="{{url('/'.app()->getLocale() . '/exam_checkout/'.$exam->id)}}">
                                        {{ __('lms.enroll_exam')}}
                                    </a>
                                    @elseif($exam->available == 1)
                                    <a href="{{url(app()->getLocale().'/go-to-exam/'.$exam->id)}}">
                                        {{ __('frontend.complete_exam')}}
                                    </a>
                                    @else
                                    Not Available
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="testimony-title">
                            <h3>{{app()->getLocale()=='en' ? $exam->title_en : $exam->title_ar}} </h3>
                            <p>{{app()->getLocale()=='en' ? substr($exam->description_en,0,150) : substr($exam->description_ar,0,150)}} </p>
                            <p>{{__('lms.pay_method')}}</p>
                            <div class="d-flex justify-content-between">
                                <div class="testimony-price">
                                    <span><em>{{__('lms.price')}} :</em> {{$exam->price}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($exams)
            <div class="p-5">
                {!! $exams->links('vendor.pagination.bootstrap-4') !!}
            </div>
            @endif
        </div>
    </div>
</section>



@endsection
