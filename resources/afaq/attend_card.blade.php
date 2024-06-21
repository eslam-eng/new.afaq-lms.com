@extends('layouts.front')
<style>
.on-attend-course{
    padding-top: 200px
}
@media only screen and (max-width: 850px) {
    .on-attend-course{
    padding-top: 90px
}
.on-attend-course div#boxx img {
    width: 100% !important;
}
}
</style>
@section('content')
    <div class="br-div px-5" style="">
        <ul class="br-ul">

            <li><a href="#">My Attendance Card</a></li>
        </ul>
    </div>
    <section class="" id="section" style="display: none;">
        <div class="container sit-container">
            <div class="all-courses  on-attend-course pb-5" >
                <div class="container ">


                    <div id="boxx">
                        <canvas id="c" style="border:1px solid #000000;margin-left:30px" width="874" height="1240"></canvas>
                    </div>

                    <div class="d-flex justify-content-center mt-4">

                        <button type="button" class="btn btn-primary" onclick="PrintElem()">طباعه الكارت</button>
                    </div>

                    @can('can_attend')
                        @if($attend)
                            @if(is_null($attend->leave_time))
                                <div class="d-flex justify-content-center mt-4">
                                    <button type="button" class="btn btn-danger" onclick="leave_course()">{{ trans('cruds.course.fields.Leave')}}</button>
                                </div>
                            @endif
                        @else
                            <div class="d-flex justify-content-center mt-4">
                                <button type="button" class="btn btn-success" onclick="attend_course()">{{ trans('cruds.course.fields.Attend')}}</button>
                            </div>
                        @endif

                    @endcan

                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{asset('fabric.min.js')}}"></script>
    <script src="{{asset('fab.js')}}"></script>
    <script>
        var canvas = new fabric.Canvas('c');
        var json = '<?php echo json_encode($canvas_json); ?>'
        let j = JSON.parse(json);
        canvas.loadFromJSON(j, function () {
            canvas.renderAll();
            var dataUrl = canvas.toDataURL();
            console.log(dataUrl);
            document.getElementById('boxx').innerHTML = "<img src='" + dataUrl + "' style='width:800px'>"
            document.getElementById('section').style.display = 'block'

            $.ajax({
                url: "{{ route('admin.save_attendance_design' , ['locale' => app()->getLocale()])}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    course_id: "{{$user_attendance->course_id}}",
                    attendance_design_id: "{{$user_attendance->attendance_design_id}}",
                    attendance_design_img: dataUrl
                },
                cache: false,
                success: function (data2) {
                },
                error: function () {
                },
                complete: function () {
                },
            });
        });


        function PrintElem() {
            var mywindow = window.open('', 'PRINT', 'height=400,width=800');

            mywindow.document.write('<html><head>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(document.getElementById('boxx').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }
    </script>
    <script>
        function attend_course() {
            $.ajax({
                url: "{{ route('admin.attend_course' , ['locale' => app()->getLocale()])}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    course_id: "{{$user_attendance->course_id}}",
                    attendance_design_id: "{{$user_attendance->attendance_design_id}}",
                    user_id: "{{$user_attendance->user_id}}",
                    lecture_id: "{{$user_attendance->lecture_id}}",
                },
                success: function (data) {
                    window.location.reload()
                }
            });
        }

        @if($attend)
        function leave_course() {
            $.ajax({
                url: "{{ route('admin.leave_course' , ['locale' => app()->getLocale()])}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: "{{$attend->id}}"
                },
                success: function (data) {
                    window.location.reload()
                }
            });
        }
        @endif
    </script>
@endsection
