@extends('frontend.business.layout.main')
<link rel="stylesheet" href="{{ asset('afaq/assests/css/contact-us-style.css') }}">

@section('content')

    <section class="idu-programss contact-us-page pg-content">
        <div class="col-12 all-page-details_lms">
            <div class="col-10 offset-1">
                <div class="afaq-logo d-flex justify-content-center align-items-center">
                    <div class="afaq-img-log">
                        <img src="{{ asset('afaq/imgs/Group 41932.png') }}" alt="">
                        <span class="contact-us-title align-center">{!! app()->getLocale() == 'en' ? $page_content->title : $page_content->title_ar !!}</span>
                    </div>
                </div>
                <div class="fake-height"></div>
            </div>
            <div class="container">
                @if (!in_array($page_content->title, ['Trainee Manual', 'Trainers Manual']))
                    {!! app()->getLocale() == 'en' ? nl2br($page_content->page_text) : nl2br($page_content->page_text_ar) !!}
                @else
                    @if ($page_content->title == 'Trainee Manual')
                        @if (app()->getLocale() == 'en')
                            <iframe width="100%" height="100%" scrolling="no"
                                    src="{{ asset('trainee-en.pdf') }}#toolbar=0" frameborder="0"></iframe>
                        @else
                            <iframe width="100%" height="100%" scrolling="no"
                                    src="{{ asset('trainee-ar.pdf') }}#toolbar=0" frameborder="0"></iframe>
                        @endif
                    @elseif($page_content->title == 'Trainers Manual')
                        @if (app()->getLocale() == 'en')
                            <iframe width="100%" height="100%" scrolling="no"
                                    src="{{ asset('trainer-en.pdf') }}#toolbar=0" frameborder="0"></iframe>
                        @else
                            <iframe width="100%" height="100%" scrolling="no"
                                    src="{{ asset('trainer-ar.pdf') }}#toolbar=0" frameborder="0"></iframe>
                        @endif
                    @endif
                @endif

            </div>
        </div>

    </section>
@endsection
