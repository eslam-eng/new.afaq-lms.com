@extends('layouts.front')
@section('title')
    <title>{{ __('global.frequent_questions') }}</title>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('afaq/assests/css/faqs.css') }}">

    <div class="br-div px-5" style="">
        <ul class="br-ul">
            <li><a href="{{ route('site-home', ['locale' => app()->getLocale()]) }}">{{ __('lms.homepage') }}</a> /</li>
            <li><a
                    href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">{{ __('global.frequent_questions') }}</a>
            </li>
        </ul>
    </div>

    <div class="br-div px-5" style="">

    </div>
    <section class="faq_page d-flex">
        <div class="faq_section">
            <div class="m-auto">
                <h3>{{ __('global.repeated_questions') }}</h3>
                <div>
                    <div class="tab_links ">
                        <div class="faqs-slider owl-carousel owl-theme">
                            @foreach ($faqCats as $faqCat)
                                <h5 onclick="openTab('{{ $faqCat->id }}', this)" class="mt-2 faqs-slider-btn">
                                    {{ app()->getLocale() == 'en' ? $faqCat->category_en : $faqCat->category_ar }}</h5>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab_content">
                        @foreach ($faqCats as $faqCat)
                            <div id="tab{{ $faqCat->id }}">
                                @foreach ($faqQuestions as $faqQuestion)

                                    @if (
                                        $faqQuestion->category->category_ar == $faqCat->category_ar ??
                                            $faqQuestion->category->category_en == $faqCat->category_en)
                                        <div class="faq_body">
                                            <div class="faq_question d-flex flex-row justify-content-between"
                                                onclick="show_answer(this)">
                                                <h6>
                                                    {{ app()->getLocale() == 'en' ? $faqQuestion->question_en : $faqQuestion->question_ar }}

                                                </h6>
                                                <i class="fa-solid fa-angle-down .fade"></i>
                                            </div>
                                            <div class="faq_answer .fade">

                                                {!! app()->getLocale() == 'en' ? $faqQuestion->answer_en : $faqQuestion->answer_ar !!}

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('frontend/js/faqs.js') }}"></script>
@endsection
