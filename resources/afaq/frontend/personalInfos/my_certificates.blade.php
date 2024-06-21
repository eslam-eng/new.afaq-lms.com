@extends('frontend.personalInfos.index')
@section('title' ,__('lms.my_certificates'))
@section('myprofile')

<section class="mycourse-page-lms">
    <div class="container sit-container">


        <div class="myprofile-page">
            <div class=" myprofile-title">
                <h3> {{__('lms.my_certificates')}}</h3>
            </div>


            <div class="my-testimony-page">
                <div class="row">
                    @forelse($user_certificate as $cert)

                    <div class="col-lg-6 col-md-6">
                        <div class="testimony-card">
                            <div class="testimony-img">
                                <img src="{{isset($cert->certificate->image->url) ? $cert->certificate->image->url : '/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg'}}" alt="">
                                <div class="My-testimony-btn">
                                    <span class="testimony-btn">
                                        <a
                                        href="{{ route('admin.get_certificate', ['locale' => app()->getLocale(), 'course_id' => $cert->course_id, 'exam_id' => $cert->exam_id, 'certificate_id' => $cert->certificate_id]) }}">
                                        {{ __('frontend.show_certificate') }}</a>                                    </span>
                                </div>
                            </div>
                            <div class="testimony-title">
                                <h3> {{app()->getLocale()=='en' ?  ($cert->course->name_en ?? '') : ($cert->course->name_ar ?? '')}}</h3>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-section">
                        <div class="empity-img-section">
                            <img src="{{asset('/afaq/imgs/empty-box@2x.png')}}" alt="">
                        </div>
                        <div class="btn-empty_">
                           <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">{{__('lms.go_to_course')}}  </a>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>


@endsection
