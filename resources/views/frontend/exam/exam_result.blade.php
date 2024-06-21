@extends('frontend.personalInfos.index')
@section('myprofile')
<section class="mycourse-page-lms">
    <div class="container sit-container">
        <div class="my-testimony-page">
            <div class="row">
                @php $result = 0; $exam_question_count = 0; @endphp
                @if($exam->exam_content)
                @foreach($exam->exam_content as $content)
                <h2>{{ app()->getLocale() == 'en' ? $content->exam_title->name_en : $content->exam_title->name_ar }}</h2>
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('frontend.exam.question_title')}}</th>
                            <th scope="col">{{__('frontend.exam.correct_answer')}}</th>
                            <th scope="col">{{__('frontend.exam.answer')}}</th>
                            <th scope="col">{{__('frontend.exam.correct')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($content->exam_title->questions->take($exam->number_question ?? 1000) as $question)
                        @php
                        $correct_answer = isset($question->bank_answer->where('correct_answer' , 1)->first()->answer) ? $question->bank_answer->where('correct_answer' , 1)->first()->answer : '';
                        $correct = isset($question->answer->question_answer->correct_answer) && $question->answer->question_answer->correct_answer ? 1 : 0;
                        $result = $correct ? $result + 1 : $result;
                        $exam_question_count++;
                        @endphp
                        <tr class="{{ $correct ? 'alert alert-success' : 'alert alert-danger'}}">
                            <th scope="row">{{$question->id}}</th>
                            <td>{{$question->title}}</td>
                            <td>{{$correct_answer}}</td>
                            <td>{{isset($question->answer->question_answer->answer) ? $question->answer->question_answer->answer : '-'}}</td>
                            <td>{{$correct ? 'true' : 'false'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endforeach
                @endif

                <div class="row col-12 " style="text-align: center;">
                    <h5 class="col-6"> Result Percentage : {{ $result < 1 ? $result.'%' : round($result/$exam_question_count*100 , 1).'%' }} </h5>
                    <h5 class="col-6"> Success Percentage : {{ $exam->success_percentage . '%' }} </h5>
                </div>
                <div class="text-center"  style="text-align: center;">
                    <h5 class="col-12"> Final Result : {!! round($result/$exam_question_count*100 , 1) < $exam->success_percentage ? '<span class="alert alert-danger">fail</span>': '<span class="alert alert-success">Pass</span>' !!} </h5>
                </div>
                @if($exam->certificate_id && round($result/$exam_question_count*100 , 1) >= $exam->success_percentage)
                <div class="text-center"  style="text-align: center;">
                    <a href="{{ route('admin.get_certificate' , ['locale' => app()->getLocale() , 'exam_id' => $exam->id , 'certificate_id' => $exam->certificate_id]) }}"> take a certificate </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
