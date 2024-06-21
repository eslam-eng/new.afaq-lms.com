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
        background-color: #f6ffe7;
        border: solid 2px #0E4C75;
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

    .quiz li {
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
        background-image: linear-gradient(45deg, #0E4C75, #88BD2F);
    }
</style>
<hr>
@if (isset($quize->exam_title->questions))
    <form class="mt-1"
        action="{{ route('one-course-quize-answer', ['locale' => app()->getLocale(), 'quize_id' => $quize->id,'next_id' => $nextId]) }}"
        method="POST">
        @csrf
        <div class="main-div p-5 mb-5">


            <ul class="quiz">
                @foreach ($quize->exam_title->questions as $qkey => $question)
                    <li class="d-block">
                        <input type="hidden" name="questions[{{ $qkey }}][question_id]" value="{{ $question['id'] }}">
                        <input type="hidden" name="questions[{{ $qkey }}][exams_title_id]" value="{{ $question['exams_title_id'] }}">
                        <p>{{ $loop->index + 1 }} - {!! $question['title'] !!} <small><span class="subhead-golden">
                                    (Select
                                    one
                                    answer)
                                </span></small></p>
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
            <div class="row justify-content-start submit-content-container">
                <button class="submit-content col-3">
                    {{ __('lms.Submit') }}
                </button>
            </div>

        </div>
    </form>
@endif
