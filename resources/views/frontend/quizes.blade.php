@extends('layouts.exam')
@section('content')
    <style>
        body {
            background-color: rgb(240, 240, 240);
        }

        .main-div {
            background-color: #FFF;
            box-shadow: 0 0 50px #ccc;
            border-radius: 10px;
            /* border-style: double; */
        }

        ol {
            list-style-type: none;
        }

        .submit-content{
            font-size: 2rem;
        }
    </style>
    @if (isset($quize->exam_title->questions))
        <form class="mt-5" action="{{ route('one-course-quize-answer',['locale' => app()->getLocale(),'quize_id' => $quize->id]) }}" method="POST">
            @csrf
            <div class="container main-div mt-5 p-5">
                @foreach ($quize->exam_title->questions as $qkey => $question)
                    <div class="row">
                        <div class="px-5 col-md-12 h3 my-3" id="en_question">
                            {{ $loop->index + 1 }} - {!! $question['title'] !!} <small><span class="subhead-golden"> ({{__('global.select_one_answer')}}) </span></small>
                        </div>
                        <div class="px-5 col-md-12 h3 m-0">
                            <ol class="quiz_list" id="answers">
                                <li class="">
                                    <input type="hidden" name="questions[{{ $qkey }}][question_id]" id="question_id" value="{{ $question['id'] }}">
                                    <input type="hidden" name="questions[{{ $qkey }}][exams_title_id]" id="exams_title_id"
                                        value="{{ $question['exams_title_id'] }}">
                                    <p class="quiz-question"></p>
                                    <ol class="qa-form " type="A">
                                        @foreach ($question['bank_answer'] as $key => $ans)
                                            <li>
                                                <div class="">
                                                    <input  class="qod_option" type="radio"
                                                        name="questions[{{ $qkey }}][answer_id]" value="{{ $ans['id'] }}"
                                                        id="answer_id{{ $key }}">

                                                    <label for="question1_option1">
                                                        <span>
                                                            <p>{!! $ans['answer'] !!}</p>
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="row d-flex justify-content-end">
                    <button class="btn btn-primary m-3 h2 submit-content">
                        {{ __('lms.Submit') }}
                    </button>
                </div>
            </div>

        </form>
    @endif

@endsection
