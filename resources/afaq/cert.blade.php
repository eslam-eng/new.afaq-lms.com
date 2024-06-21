@extends('frontend.personalInfos.index')

@section('myprofile')
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
    <section class="" id="section" style="display: none;">
        <div class="container sit-container">
            <div class="all-courses on-attend-course pb-5">
                <div class="container">


                    <div class=" myprofile-title">
                        <h3> {{__('lms.my_certificates')}}</h3>
                    </div>


                    <div id="boxx">
                        <canvas id="c" style="border:1px solid #000000;margin-left:30px" width="850px" height="600px"></canvas>
                    </div>

                    <div class="d-flex justify-content-center mt-4">

                        <button type="button" class="btn btn-primary" onclick="PrintElem()">{{__('global.print_certificate')}}</button>
                    </div>
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
        canvas.loadFromJSON(j, function() {
            canvas.renderAll();
            var dataUrl = canvas.toDataURL();
            console.log(dataUrl);
            document.getElementById('boxx').innerHTML = "<img src='" + dataUrl + "' style='width:800px'>"
            document.getElementById('section').style.display = 'block'

            $.ajax({
                url: "{{ route('admin.save_certificate' , ['locale' => app()->getLocale()])}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    exam_id: "{{$user_certificate->exam_id}}",
                    certificate_id: "{{$user_certificate->certificate_id}}",
                    course_id: "{{$user_certificate->course_id}}",
                    user_id: "{{$user_certificate->user_id}}",
                    certificate_img: dataUrl
                },
                cache: false,
                success: function(data2) {},
                error: function() {
                },
                complete: function() {},
            });
        });


        function PrintElem() {
            // var mywindow = window.open('', 'PRINT', 'height=400,width=800'),
            //     myElement = document.getElementById('boxx'),
            //     myElWidth = myElement.innerWidth,
            //     myElHeight = myElement.innerHeight;


            // mywindow.document.write('<html><head>');
            // mywindow.document.write("<style type='text/css' media='print'> @page { size: auto; margin: 0mm; } </style>");
            // if(myElHeight > myElWidth){
            //     mywindow.document.write("<style type='text/css' media='print'> @page { size: portrait; } </style>");
            // }else{
            //     mywindow.document.write("<style type='text/css' media='print'> @page { size: landscape; } </style>");
            // }
            // mywindow.document.write("</head><body style='width: 100%; height: 100%;'>");
            // mywindow.document.write(myElement.innerHTML);
            // mywindow.document.write('</body></html>');

            // mywindow.document.close(); // necessary for IE >= 10
            // mywindow.focus(); // necessary for IE >= 10*/

            // mywindow.print();
            // mywindow.close();

            var myElement = document.getElementById('boxx'),
                myElWidth = myElement.innerWidth,
                myElHeight = myElement.innerHeight,
                // mywindow = window.open('', 'PRINT', `height=${myElHeight},width=${myElWidth}`);
                mywindow = window.open('', 'PRINT', 'height=400,width=800');

            // mywindow.document.write("<style type='text/css' media='print'> @page { size: auto; margin: 0mm; } html { background-color: #FFFFFF; margin: 0px; width: fit-content; height: fit-content;} body { border: solid 1px blue ; margin: 10mm 15mm 10mm 15mm; width: fit-content; height: fit-content; } </style>");
            mywindow.document.write("<style type='text/css' media='print'> @page { size: auto; margin: 0mm; } body img { width: 100vw !important; background-color: white; margin: 0; padding: 0; position: fixed; object-fit: contain;}</style>");
            mywindow.document.write(myElement.innerHTML);

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }
    </script>
@endsection
