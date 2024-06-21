{{-- <link href="{{ asset('css/custom_exam.css') }}" rel="stylesheet" /> --}}

<style>
    body {
        background-color: rgb(240, 240, 240);
    }

    .main-div {
        /* background-color: #FFF; */
        /* box-shadow: 0 0 50px #ccc; */
        border-radius: 10px;
        /* border-style: double; */
        background-color: #f6f5fb;
        border: solid 2px #845097;
    }


    .quiz,
    .choices {
        list-style-type: none;
        padding: 0;
    }

    .choices li {
        margin-bottom: 5px;
        display: block;
    }

    /* .choices label {
        display: flex;
        align-items: center;
    } */

    .choices label,
    input[type="radio"] {
        cursor: pointer;
    }

    input[type="radio"] {
        margin-right: 8px;
    }

    .view-results {
        padding: 1rem;
        cursor: pointer;
        font-size: inherit;
        color: white;
        background: teal;
        border-radius: 8px;
        margin-right: 5px;
    }

    .my-results {
        padding: 1rem;
        border: 1px solid goldenrod;
    }

    ul li {
        list-style: circle !important;
    }

    label {
        position: relative;
        align-items: center;
    }

    label input {
        position: relative !important;
        opacity: 1 !important;
    }

    label:focus-within {
        outline: 1px solid orange;
        width: auto !important;
        height: auto !important;
        left: auto !important;
        cursor: pointer;
    }
    .submit-content-container{
        padding: 20px;
    }
    .submit-content-container .submit-content{
        border-radius: 5px;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
        padding: 5px;
        background-image: linear-gradient(45deg, #081839, #845097);
    }
</style>
<hr>
@if (isset($quize->exam_title->questions))
    <form class="mt-1"
        action="{{ route('one-course-quize-answer', ['locale' => app()->getLocale(), 'quize_id' => $quize->id]) }}"
        method="POST">
        @csrf
        <div class="main-div quiz-container p-3 mb-5">


            <ul class="quiz">
                @foreach ($quize->exam_title->questions as $qkey => $question)
                    <li class="d-block">
                        <input type="hidden" name="questions[{{ $qkey }}][question_id]" value="{{ $question['id'] }}">
                        <input type="hidden" name="questions[{{ $qkey }}][exams_title_id]" value="{{ $question['exams_title_id'] }}">
                        <p>{{ $loop->index + 1 }} - {!! $question['title'] !!} <small><span class="subhead-golden"> ({{__('global.select_one_answer')}}) </span></small></p>
                        <ul class="choices">
                            @foreach ($question['bank_answer'] as $key => $ans)
                                <li><label class="d-flex"><input id="answer_id{{ $key }}" class="col-1" type="radio"
                                            name="questions[{{ $qkey }}][answer_id]"
                                            value="{{ $ans['id'] }}"><span class="col-11">{!! $ans['answer'] !!}</span></label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
            <div class="row justify-content-center submit-content-container">
                <button class="submit-content">
                    {{ __('lms.Submit') }}
                </button>
            </div>

        </div>
    </form>
@endif
