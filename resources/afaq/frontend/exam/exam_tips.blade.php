@extends('layouts.exam')
@section('content')

@php
$date1 = date('Y-m-d H:i:s',strtotime($exam->start_at));
$date2 = date('Y-m-d H:i:s',strtotime($exam->end_at));
$total = (strtotime($date1) - strtotime($date2));
@endphp

<input type="hidden" id="exam_date_minutes" value="{{(strtotime($date1) - strtotime($date2))}}">
<input type="hidden" id="exam_id" value="{{$exam->id}}">

<div class="row title-bar pt-3 text-white" style="background: #3c3e3c;height:40px;;width:100%">
    <div class="col-lg-8 col-md-5 hidden-sm hidden-xs">
        <h5> SNA - {{ $exam->title}}</h5>
    </div>
    <div class="col-lg-4 col-md-7 col-sm-12 col-xs-12">
        <h5>
            <span>

            </span>
        </h5>
    </div>
</div>

<div class="row copy-panel">

    <div class="col-md-12">


        <div class="panel-body h3 text-left">

            <div class="section-interstitial copy-section-directions"><b>{{ $exam->title }} tips and guidelines<br></b>
                {!! $exam->tips_guidelines !!}
                <p>Select the <strong>Next</strong> button to proceed.</p>
            </div>

        </div>


    </div>

</div>

<div class="copyright py-4 text-white" style="position:fixed;bottom:0;background:#4e514e;width:100%">
    <ul class="list-inline ml-4">
        <button class="btn text-light float-right mr-4" type="button" id="next" onclick="nextQuestion()">
            <h5>Next</h5>
        </button>
    </ul>
</div>
@endsection

@section('scripts')
@parent
<script>
    function nextQuestion() {
        location.href = "/{{app()->getLocale()}}/start_exam/" + parseInt($('#exam_id').val())+'?page=1';
    }
</script>
@endsection
