@extends('layouts.exam')
@section('content')

@php
$date1 = date('Y-m-d H:i:s',strtotime($exam->end_at));
$date2 = date('Y-m-d H:i:s',strtotime($exam->start_at));
$now = strtotime(date('Y-m-d H:i:s'));
$start_at = strtotime(date('Y-m-d H:i:s',strtotime($exam->start_at)));
$end_at = strtotime(date('Y-m-d H:i:s',strtotime($exam->end_at)));
$total = (strtotime($date1) - strtotime($date2));
@endphp

<input type="hidden" id="total" value="{{$total}}">
<input type="hidden" id="end_at" value="{{$end_at}}">
<input type="hidden" id="now" value="{{$now}}">
<input type="hidden" id="exam_date_minutes" value="{{$end_at - $now}}">
<input type="hidden" id="exam_id" value="{{$exam->id}}">
<input type="hidden" id="page" value="{{request('page' , 1)}}">
<input type="hidden" id="all" value="{{$total_questions}}">


<div class="row title-bar pt-3 text-white" style="background: #3c3e3c;height:40px;width:100%">
    <div class="col-lg-8 col-md-5 hidden-sm hidden-xs">
        <h5> SNA - {{ $exam->title}}</h5>
    </div>
    <div class="col-lg-4 col-md-7 col-sm-12 col-xs-12">
        <h5>
            <span>Question <span id="item"> {{request('page' , 1)}}</span> of {{$total_questions}}
                <i class="fa fa-clock ml-4"></i> <span id="time"></span>
                <progress id="progress_bar" class="ml-4" max="{{$total}}" value="{{ $now - $start_at }}"></progress>
            </span>
        </h5>
    </div>
</div>

<div class="row copy-panel" style="width:100%">

    <div class="col-md-12">
        @if(isset($questions))
        @foreach($questions as $question)
        <div class="p-5 col-md-6 h3" id="en_question" style="position:fixed;top:100px;bottom:30px;overflow:auto;left:0;">
            {!! $question['title'] !!}
        </div>
        <div class="p-5 col-md-6 h3" style="position:fixed;top:100px;bottom:30px;overflow:auto;right:0;">
            <ol class="quiz_list" id="answers">
                <li class="mt-4">
                    <input type="hidden" name="question_id" id="question_id" value="{{$question['id']}}">
                    <input type="hidden" name="exams_title_id" id="exams_title_id" value="{{$question['exams_title_id']}}">
                    <p class="quiz-question"><strong><span class="subhead-golden"> ({{__('global.select_one_answer')}}) </span></strong></p>
                    <ol class="qa-form mt-4" type="A" start="1">
                        @foreach($question['bank_answer'] as $key => $ans)
                        <li>
                            <div class="">
                                <input onchange="set_answer()" {{$ans['id'] == $answer_id ? 'checked' : ''}} class="qod_option" type="radio" name="answer_id" value="{{$ans['id']}}" id="answer_id{{$key}}">

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
        @endforeach
        @endif

    </div>

</div>

<div class="copyright py-4 text-white" style="position:fixed;bottom:0;background:#4e514e;width:100%">
    <ul class="list-inline ml-4">
        <button class="btn text-light float-left mr-4" style="display: none;" type="button" id="previous" onclick="previousQuestion()">
            <h5>Previous</h5>
        </button>
        <li><button class="btn text-light" type="button" onclick="show_reviews()">
                <h5>Show Reviews</h5>
            </button><span class="ml-4">|</span></li>

        @php
        $add_flag = '';
        $remove_flag = 'none';
        if(isset($answer['flag'])){
        if($answer['flag'] == 1){
        $add_flag = 'none';
        $remove_flag = '';
        }
        }
        @endphp
        <li id="add_flag" style="display:{{$add_flag}}"><button class="btn text-light" type="button" onclick="add_flag()">
                <h5>Flag For Review </h5>
            </button></li>

        <li id="remove_flag" style="display:{{$remove_flag}}"><button class="btn text-light" type="button" onclick="remove_flag()">
                <h5>Remove Flag</h5>
            </button></li>

        <button class="btn text-light float-right mr-4" type="button" id="next" onclick="nextQuestion()">
            <h5>Next</h5>
        </button>
        <a class="btn text-light float-right mr-4" href="{{route('admin.end_exam' , ['locale' => app()->getLocale(),'exam_id' => $exam->id])}}" id="finish" style="display: none;">
            <h5>End Exam</h5>
        </a>
    </ul>
</div>


<div style="margin-top:-65px;display:none" id="show_review" tabindex="-1" role="dialog" aria-labelledby="show_reviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form id="ExamForm">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <!-- Portfolio Modal - Title-->
                                <h2 class=" text-secondary text-uppercase mb-0" id="portfolioModal1Label">
                                    All Question Reviews
                                </h2>

                                <h4 class="text-danger" id="error"></h4>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <div class="container row col-lg-12" style="height:400px;overflow:auto">

                                    <table class="table h3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#ID</th>
                                                <th scope="col">QUESTION</th>
                                                <th scope="col">STATUS</th>
                                                <th scope="col">FLAG</th>
                                            </tr>
                                        </thead>
                                        <tbody id="reviews">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="button" class="btn btn-secondary text-bold" onclick="$('#show_review').hide()" style="width: 200px;height:40px">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
    // document.addEventListener('contextmenu', function(e) {
    //     e.preventDefault();
    // });

    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }

    window.onload = function() {
        var page = parseInt($('#page').val());
        var all = parseInt($('#all').val());

        check_next_previous(page, all);

        var duration_seconds = parseInt($('#exam_date_minutes').val()),
            display = document.querySelector('#time');

        startTimer(duration_seconds, display);
    };

    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;

        var total = $('#total').val();
        var now = $('#now').val();
        var start_at = $('#start_at').val();
        var end_at = $('#end_at').val();

        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = "00:" + minutes + ":" + seconds;

            $('#progress_bar').val(total - ((parseInt(minutes) * 60) + parseInt(seconds)));

            var url = "{{route('admin.go-to-exam-results' , ['locale' => app()->getLocale(),'exam_id' => $exam->id])}}";// "/{{app()->getLocale()}}/go-to-exam-results/" + parseInt($('#exam_id').val());
            if (--timer <= 0) {
                console.log(url);
                // set_answer();
                window.location.href = url;
                // timer = duration;
            } else if (minutes + ":" + seconds == "00:00") {
                // set_answer();
                location.href = url;
            }
        }, 1000);
    }

    function check_next_previous(page, all) {
        if (parseInt(all) == 1) {
            $('#next').hide();
            $('#previous').hide();
            $('#finish').show();
        }

        if (parseInt(page) == 1 && parseInt(all) != 1) {
            $('#previous').hide();
            $('#finish').hide();
            $('#next').show();

        }

        if (parseInt(page) == parseInt(all) && parseInt(all) != 1) {
            $('#next').hide();
            $('#previous').show();
            $('#finish').show();
        }

        if (parseInt(page) > 1 && parseInt(page) != parseInt(all)) {
            $('#finish').hide();
            $('#next').show();
            $('#previous').show();
        }

        $('#item').html(parseInt(page));
        updateQueryStringParameter(window.location.href, 'page', parseInt(page));

    }

    function nextQuestion() {
        set_answer();
        $.ajax({
            url: "/{{app()->getLocale()}}/start_exam/" + parseInt($('#exam_id').val()) + '?page=' + (parseInt($('#page').val()) + 1),
            type: "GET",
            cache: false,
            success: function(data) {
                // console.log(data);
                location.href = data.url
            },
            error: function(error) {
                console.log(error);
            },
            complete: function() {
                check_next_previous(parseInt($('#page').val()) + 1, parseInt($('#all').val()));
            },
        });
    }

    function set_answer() {
        $.ajax({
            url: "{{ route('admin.set_answer' , ['locale' => app()->getLocale()])}}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                exam_id: parseInt($('#exam_id').val()),
                question_id: parseInt($('#question_id').val()),
                answer_id: $("input[name='answer_id']:checked").val() ? parseInt($("input[name='answer_id']:checked").val()) : null,
                exams_title_id: parseInt($('#exams_title_id').val())
            },
            cache: false,
            success: function(data2) {},
            error: function() {
                $("#answer_id").trigger("reset");
            },
            complete: function() {},
        });
    }

    function previousQuestion() {
        set_answer();
        $.ajax({
            url: "/{{app()->getLocale()}}/start_exam/" + parseInt($('#exam_id').val()) + '?page=' + (parseInt($('#page').val()) - 1),
            type: "GET",
            cache: false,
            success: function(data) {
                // console.log(data);
                location.href = data.url
            },
            error: function(error) {
                console.log(error);
            },
            complete: function() {
                check_next_previous(parseInt($('#page').val()) - 1, parseInt($('#all').val()));
            },
        });
    }

    function updateQueryStringParameter(uri, key, value) {

        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            var url = uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            var url = uri + separator + key + "=" + value;
        }

        window.history.pushState({
            path: url
        }, '', url);
    }

    function show_reviews() {

        $.ajax({
            url: "{{ route('admin.get_reviews' , ['locale' => app()->getLocale()])}}",
            type: "get",
            cache: false,
            data: {
                exam_id: parseInt($('#exam_id').val()),
                exams_title_id: parseInt($('#exams_title_id').val())
            },
            success: function(data) {
                console.log(data);
                $('#reviews').html('');
                var reviews = ``;
                for (j = 0; j < data.length; ++j) {
                    reviews += `
                            <tr onclick="goToQuestion(${j})" style="cursor:pointer">
                                <td>question ${j+1}</td>
                                <th scope="row">${data[j].title}</th>
                                <td>${data[j].answer.answer_id ? 'Answered' : 'not Answered'}</td>
                                <td>${data[j].answer.flag ? '√' : '-'}</td>
                            </tr>
                        `;
                }

                $('#reviews').html(reviews);

            },
            error: function(error) {
                console.log(error);
            },
            complete: function() {
                $('#show_review').show();
            },
        });

    }

    function add_flag() {
        $.ajax({
            url: "{{ route('admin.set_answer' , ['locale' => app()->getLocale()])}}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                flag: 1,
                answer_id: $("input[name='answer_id']:checked").val() ? parseInt($("input[name='answer_id']:checked").val()) : null,
                exam_id: parseInt($('#exam_id').val()),
                question_id: parseInt($('#question_id').val()),
                exams_title_id: parseInt($('#exams_title_id').val())
            },
            cache: false,
            success: function(data) {},
            error: function(error) {
                console.log(error);
            },
            complete: function() {
                $('#add_flag').hide();
                $('#remove_flag').show();
            },
        });
    }

    function remove_flag() {
        $.ajax({
            url: "{{ route('admin.set_answer' , ['locale' => app()->getLocale()])}}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                flag: 0,
                answer_id: $("input[name='answer_id']:checked").val() ? parseInt($("input[name='answer_id']:checked").val()) : null,
                exam_id: parseInt($('#exam_id').val()),
                question_id: parseInt($('#question_id').val()),
                exams_title_id: parseInt($('#exams_title_id').val())
            },
            cache: false,
            success: function(data) {},
            error: function(error) {
                console.log(error);
            },
            complete: function() {
                $('#add_flag').show();
                $('#remove_flag').hide();
            },
        });
    }

    function goToQuestion(page) {
        $('#page').val(page);
        nextQuestion();
    }
</script>
@endsection
