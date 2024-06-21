@extends('layouts.front')
@section('content')

<link rel="stylesheet" href="{{ asset('frontend/css/faqs.css ')}}">

<section class="faq_page d-flex">
    <div class="left_white_space"></div>
    <div class="faq_section">
        <div class="m-auto">
            <h3>{{__('global.repeated_questions')}}</h3>
            <div>
                <div class="tab_links d-flex flex-row">

                        @foreach($faqCats as $faqCat)
                            <h5 onclick="openTab('{{$faqCat->id}}', this)">{{app()->getLocale() == 'en' ? $faqCat->category_en : $faqCat->category_ar}}</h5>

                        @endforeach
                </div>
                <div class="tab_content">
                @foreach($faqCats as $faqCat)

                    <div id="tab{{$faqCat->id}}">
                            @foreach($faqQuestions as $faqQuestion)
                            @if($faqQuestion->category->category_ar == $faqCat->category_ar ??$faqQuestion->category->category_en == $faqCat->category_en )
                        <div class="faq_body">
                            <div class="faq_question d-flex flex-row justify-content-between" onclick="show_answer(this)">
                                <h6>
                                    {{ app()->getLocale() == 'en' ? $faqQuestion->question_en : $faqQuestion->question_ar }}

                                </h6>
                                <i class="fa-solid fa-angle-down .fade"></i>
                            </div>
                            <div class="faq_answer .fade">

                                {!!   app()->getLocale() == 'en' ? $faqQuestion->answer_en : $faqQuestion->answer_ar !!}

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
<script src="{{asset('frontend/js/faqs.js')}}"></script>
@endsection
