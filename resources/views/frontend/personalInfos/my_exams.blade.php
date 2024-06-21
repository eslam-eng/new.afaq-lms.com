@extends('frontend.personalInfos.index')
@section('myprofile')
<style>
    @media screen and (max-width: 830px) {
        .precemp {
            bottom: 30px;
        }
    }
</style>
<section class="mycourse-page-lms">
    <div class="container sit-container">
        <div class="my-testimony-page">
            <div class="row">
                @foreach($my_exam as $exam)
                @if(isset($exam->exam))
                <div class="col-lg-6 col-md-6">
                    <div class="testimony-card">
                        <div class="testimony-img">
                            <img src="{{isset($exam->exam->image->url) ? $exam->exam->image->url :
                                    '/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg'}}" alt="">
                            <div class="My-testimony-btn">
                                <span class="testimony-btn">
                                    @if(isset($exam->exam->start_at) && isset($exam->exam->end_at) && strtotime(now()) >= strtotime($exam->exam->start_at) && strtotime(now()) < strtotime($exam->exam->end_at) && !$exam->complete)
                                        <a href="{{url(app()->getLocale().'/go-to-exam/'.$exam->exam->id)}}"> {{__('frontend.complete_exam')}}</a>
                                        @elseif(isset($exam->exam->start_at) && strtotime(now()) < strtotime($exam->exam->start_at) )
                                            <a href="#">Exam Will Start at {{ $exam->exam->start_at }}</a>
                                            @elseif(isset($exam->exam->end_at) && strtotime(now()) > strtotime($exam->exam->end_at) || $exam->complete)
                                            <a href="{{url(app()->getLocale().'/go-to-exam-results/'.$exam->exam->id)}}"> {{__('frontend.exam_result')}}</a>
                                            @endif
                                </span>
                            </div>
                        </div>
                        <div class="testimony-title">
                            <h3> {{app()->getLocale()=='en' ? $exam->exam->title_en : $exam->exam->title_ar}}</h3>
                            <p>{{__('lms.pay_method')}}</p>
                            <div class="d-flex justify-content-between">
                                <div class="testimony-price">
                                    <span><em>{{__('lms.price')}} :</em> {{$exam->exam->price}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

                @if($my_exam)
                <div class="p-5">
                    {!! $my_exam->links('vendor.pagination.bootstrap-4') !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
