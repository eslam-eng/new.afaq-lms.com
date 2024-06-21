@extends('frontend.personalInfos.index')
@section('myprofile')
    <section class="mycourse-page-lms">
        <div class="container sit-container">


            <div class="myprofile-page">
                <div class=" myprofile-title">
                    <h3> {{ __('lms.my_certificates') }}</h3>
                </div>


                <div class="my-testimony-page">
                    <div class="row">
                        @foreach ($user_certificate as $cert)
                            <div class="col-lg-6 col-md-6">
                                <div class="testimony-card">
                                    <div class="testimony-img">
                                        <img src="{{ isset($cert->certificate->image->url) ? $cert->certificate->image->url : '/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg' }}"
                                            alt="">
                                        <div class="My-testimony-btn">
                                            <span class="testimony-btn">
                                                <a
                                                    href="{{ route('admin.get_certificate', ['locale' => app()->getLocale(), 'course_id' => $cert->course_id, 'exam_id' => $cert->exam_id, 'certificate_id' => $cert->certificate_id]) }}">
                                                    {{ __('frontend.show_certificate') }}</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="testimony-title text-center">
                                        {{-- <h3> {{ app()->getLocale() == 'en' ? $cert->certificate->name_en ?? '' : $cert->certificate->name_ar ?? '' }}
                                        </h3> --}}
                                        <h3> {{ app()->getLocale() == 'en' ? $cert->course->name_en . ' Certificate' ?? '' :  ' شهادة ' . $cert->course->name_ar  ?? '' }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($user_certificate)
                            <div class="p-5">
                                {!! $user_certificate->links('vendor.pagination.bootstrap-4') !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
