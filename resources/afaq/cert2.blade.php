@extends('frontend.personalInfos.index')

@section('myprofile')
    <section class="" id="section">
        <div class="container sit-container">
            <div class="all-courses">
                <div class="container">

                    <div class=" myprofile-title">
                        <h3> {{__('lms.my_certificates')}}</h3>
                    </div>

                    <div id="boxx">
                        <img src="{{$user_certificate->certificate_img}}">
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="button" class="btn btn-primary" onclick="PrintElem()">طباعه الشهاده</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
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
@endsection
