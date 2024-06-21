<html>
@php
    $domain = env('APP_URL');
@endphp

<head>
    <meta property="og:title" content="{{ $name }}">
    <meta property="og:site_name" content="AFAQ|آفاق">
    <meta property="og:description" content="{{ strip_tags($description ?? '') }}">
    <meta property="og:url" content="{{ $domain }}/{{ $lang }}/one-courses/{{ $id }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ $lang }}">
    <meta property="og:image" content="{{ asset($image) }}">
    <meta property="og:image:width" content="668">
    <meta property="og:image:height" content="444">
    <!-- <meta property="og:price:amount" content="130"> -->
    <meta property="og:price:currency" content="EGP">

    <meta property="fb:app_id" content="269713445111381">
    <meta property="al:ios:url" content="afaq://course?id={{ $id }}">
    <meta property="al:ios:app_store_id" content="com.afaq.afaq">
    <meta property="al:ios:app_name" content="AFAQ|آفاق">
    <meta property="al:android:url" content="afaq://course?id={{ $id }}">
    <meta property="al:android:app_name" content="afaq">
    <meta property="al:android:package" content="com.afaq.devewest">
    <meta property="al:web:url" content="{{ $domain }}/{{ $lang }}/one-courses/{{ $id }}">
    <meta property="al:web:should_fallback" content="false">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://afaq-lms.com/afaq/imgs/Logo-Type-1v-2.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Optional theme -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>afaq</title>
    <style>
        @media screen and (max-device-width: 480px) {
            body {
                -webkit-text-size-adjust: none
            }

            .fb-brwoser {
                border-radius: 30px !important;
            }
        }
    </style>
</head>

<body
    style="
    background-image: url('/afaq-background.png');
    background-size: contain;
    background-color:#425A87;
    background-repeat: no-repeat;
    background-position: center;">

    <!--Start Login & Register Tabs-->
    <section class="Landing_Page_Custom" style="text-align: center;">

        <div class="container" style="text-align: center">
            <div id="fb-in-browse" style="display: none">
                <div class="row" style="text-align: center">
                    <div style="text-align: center">
                        <div>
                            <a style="width:130px;  padding-bottom:10px;" href="#" onclick="goToApp()"
                                class="btn fb-brwoser">
                                افتح العرض
                            </a>
                        </div>
                        <p style="text-align:center;font-weight:bold; color:#000; padding-top:10px;"> لو مش منزل
                            الابلكيشن <br>نزله الاول من هنا</p>
                        <div>
                            <a style="width:130px;padding-bottom:10px;" href="#" onclick="goToApp()"
                                class="btn fb-brwoser">
                                حمل الآبلكيشن
                            </a>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div id="not-fb-in-browse">
                <div class="" style="text-align: center">
                    <div style="text-align: center;" class="row justify-content-center w-100">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6" onclick="goToApp()"
                            style="cursor: pointer;">
                            <img src="https://afaq-lms.com/afaq/imgs/Group loi41627.png" width="100" style="margin:4px">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6" onclick="goToApp()"
                            style="cursor: pointer;">
                            <img src="https://afaq-lms.com/afaq/imgs/Group 41626lkj.png" width="100">
                        </div>
                    </div>
                    <br>
                </div>
                <a href="#" onclick="goToApp()" class="btn Redirect_btn"
                    style="
                border: 1px solid #f0ad4e;
    font-size: 24px;
    background: #4e94f0;
    color: #fff;
    position: absolute;
    bottom: 10%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    cursor: pointer;
    border-radius: 5px;
    text-align: center;">
                    Go to the app
                </a>
            </div>

        </div>
    </section>
    <!--End Login & Register Tabs-->


    <script>
        function getMobileOperatingSystem() {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            // Windows Phone must come first because its UA also contains "Android"
            if (/windows phone/i.test(userAgent)) {
                return "android";
            }
            if (/android/i.test(userAgent)) {
                return "android";
            }
            // iOS detection from: http://stackoverflow.com/a/9039885/177710
            if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                return "ios";
            }
            return "web";
        }

        console.log(getMobileOperatingSystem());

        window.location = 'afaq://course?id={{ $id }}';

        switch (getMobileOperatingSystem()) {
            case 'ios':
                var url = "https://apps.apple.com/eg/app/afaq-%D8%A7%D9%81%D8%A7%D9%82/id6444857032";
                break;
            case 'android':
                var url = "https://play.google.com/store/apps/details?id=com.afaq.application";
                break;
            case 'web':
                var url = "{{ $domain }}/{{ $lang }}/one-courses/{{ $id }}";
                break;
            default:
                var url = "{{ $domain }}";
                break;
        }

        setTimeout(function() {
            console.log(url);
            window.location = url;
        }, 1000);

        function goToApp() {
            switch (getMobileOperatingSystem()) {
                case 'ios':
                    var url = "https://apps.apple.com/eg/app/afaq-%D8%A7%D9%81%D8%A7%D9%82/id6444857032";
                    break;
                case 'android':
                    var url = "https://play.google.com/store/apps/details?id=com.afaq.application";
                    break;
                case 'web':
                    var url = "{{ $domain }}/{{ $lang }}/one-courses/{{ $id }}";
                    break;
                default:
                    var url = "{{ $domain }}";
                    break;
            }
            window.location = url;
        }
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </script>
</body>

</html>
