@extends('layouts.front')
@section('content')
<style>
    .innerheader-nd {
        height: 42vh !important;
    }
    .precemp{
      bottom: 150px;
    }
    @media screen and (max-width: 830px) {
      .precemp {
      bottom: 30px;
   }
}
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section class="idu-programss">
    <div class=" sit-container">

        <div class="dontact-us-page container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <div class="title-contactus d-flex justify-content-start align-items-center">
                        <span>{{__('contact.header')}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <div class="contact-us-img">
                        <img src="/nazil/imgs/customer_service_1-061.png" alt="" >
                    </div>
                </div>
            </div>
            <div class="Technical-support-policy">
                <h2>
                    {{__('contact.Technical')}}

                </h2>
                <h3>  {{__('contact.Provided')}}</h3>
                <p>
                    {{__('contact.committed')}}
                </p>
            </div>
            <div class="Technical-support-policy">
                <h2>{{__('contact.Rules')}}
                    </h2>
                <ul>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Clarify')}}

                    </li>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Adhere')}}

                    </li>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.offending')}}
                    </li>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.engage')}}

                    </li>
                </ul>
            </div>
            <div class="Technical-support-policy">
                <h2> {{__('contact.etiquette')}}
                    </h2>
                <ul>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Respond')}}
                    </li>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Adhere')}}

                    </li>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Respect')}}
                    </li>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <i class="far fa-hand-point-left"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.offend')}}
                    </li>
                    <li>
                        <i class="far fa-hand-point-right"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.engage')}}
                    </li>
                </ul>
            </div>
            <div class="Technical-support-policy">
                <h2> {{__('contact.Technical_support')}}
                    </h2>
                <span>
                                    <h2> {{__('contact.provide_technical')}}


                </span>
                <ul>
                    <li>
                        <i class="fas fa-headset"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Direct_phone')}}

                    </li>
                    <li>
                        <i class="far fa-envelope-open"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Technical_email')}}

                    </li>
                    <li>
                        <i class="fas fa-clipboard"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.Manuals_page')}}

                    </li>
                    <li>
                        <i class="far fa-question-circle"></i>
                        <em style="width: 20px; display:block"></em>
                        {{__('contact.FAQ_page')}}

                    </li>
                    <li>
                        <strong>
                            {{__('contact.problem')}}

                        </strong>
                    </li>
                </ul>
            </div>
            <div class="elementor-widget-container">
                <div class="multiseparator masterstudy_elementor_multy_separator_ contactus-page"></div>
            </div>
            <div class="get-all-information">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="get-info">
                            <h2>
                                {{__('contact.Contact_Info')}}

                            </h2>
                            <div class="the-info">
                                <div class="information-details">
                                    <span class="icon-info"><i class="fas fa-location-arrow"></i></span>
                                    <div class="title-info">
                                        <strong>
                                            {{__('contact.Address_address')}}:

                                        </strong>
                                        <p>
                                            {{__('contact.Address')}}:

                                        </p>
                                    </div>
                                </div>
                                <div class="information-details">
                                    <span class="icon-info"><i class="fas fa-at"></i></span>
                                    <div class="title-info">
                                        <strong>
                                            {{__('contact.Email')}}
                                        </strong>
                                        <p>
                                            <a href="/">
                                                Support@sna-academy.com
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="information-details">
                                    <span class="icon-info"><i class="fab fa-whatsapp"></i></span>
                                    <div class="title-info">
                                        <strong>
                                            {{__('contact.Whatsapp')}}

                                        </strong>
                                        <p>
                                            <a href="">
                                                0557527232
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="information-details">
                                    <span class="icon-info"><i class="fas fa-mail-bulk"></i></span>
                                    <div class="title-info">
                                        <strong>
                                            {{__('contact.Postal_code')}}

                                        </strong>
                                        <!-- <p>
                                            Postal_code
                                        </p> -->
                                    </div>
                                </div>
                                <div class="information-details">
                                    <span class="icon-info"><i class="fas fa-envelope"></i></span>
                                    <div class="title-info">
                                        <strong>
                                            {{__('contact.Mail_box')}}

                                        </strong>
                                        <!-- <p>
                                            Mail_box
                                        </p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">--}}
{{--                        <div class="get-info">--}}
{{--                            <h2>--}}
{{--                                {{__('contact.Location_Info')}}:--}}

{{--                            </h2>--}}
{{--                            <div class="google-map">--}}
{{--                                <div class="mapouter">--}}
{{--                                    <div class="gmap_canvas">--}}
{{--                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.6752168289886!2d46.754831415001824!3d24.806572484079336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd50a13daf5a86e98!2zMjTCsDQ4JzIzLjciTiA0NsKwNDUnMjUuMyJF!5e0!3m2!1sen!2seg!4v1644331644742!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" ></iframe>--}}
{{--                                    <a href="https://123movies-to.org"></a><br>--}}
{{--                                        <style>--}}
{{--                                            .mapouter {--}}
{{--                                                position: relative;--}}
{{--                                                text-align: right;--}}
{{--                                                height: 500px;--}}
{{--                                                width: 600px;--}}
{{--                                            }--}}
{{--                                        </style><a href="https://www.embedgooglemap.net"></a>--}}
{{--                                        <style>--}}
{{--                                            .gmap_canvas {--}}
{{--                                                overflow: hidden;--}}
{{--                                                background: none !important;--}}
{{--                                                height: 500px;--}}
{{--                                                width: 600px;--}}
{{--                                            }--}}
{{--                                        </style>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="elementor-widget-container">
                <div class="multiseparator masterstudy_elementor_multy_separator_ contactus-page"></div>
            </div>
            <div class="get-all-information">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                        <div class="get-info">
                            <h2>
                                {{__('contact.Touch')}}

                            </h2>
                            <div class="contact-form-box rounded p-lg-5 mb-5">
                                <!-- <form id="contact-form" class="contact-form" action="../contact/index.php" method="post"> -->
                                @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                </div>
                                @endif
                                @if(Session::has('fail'))
                                <div class="alert alert-danger">
                                    {{Session::get('fail')}}
                                </div>
                                @endif
                                <form id="contact-form" class="contact-form" action="{{ route('enquiry_create') }}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group have-input">
                                            <label class="sr-only" for="name"> {{__('contact.name')}}</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="{{__('contact.name')}}" minlength="2" maxlength="45" required="required" pattern="[A-zÀ-ž]([A-zÀ-ž\s]){2,}">
                                        </div>
                                        <div class="form-group have-input">
                                            <label class="sr-only" for="email">{{__('contact.email')}}</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="{{__('contact.email')}}" required="required">
                                        </div>
                                        <div class="form-group have-input" >
                                            <label class="sr-only" for="phone">{{__('contact.phone')}}</label>
                                            <input id="phone" name="mobile" type="tel">
                                            <span id="valid-msg" class="hide">{{__('contact.valid')}}</span>
                                            <span id="error-msg" class="hide">{{__('contact.invalid')}}</span>
                                        </div>
                                        <div class="form-group all">
                                            <label class="sr-only" for="cmessage">{{__('contact.your_meassage')}}</label>
                                            <textarea class="form-control" id="cmessage" name="message" placeholder="{{__('contact.your_meassage')}}" rows="10" required="required"></textarea>
                                        </div>


                                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
                                             data-callback="enableBtn" ></div>

                                        <div class="form-group all">
                                            <input type="submit" name="submit" id="submit" value="{{__('contact.send')}}"
                                                   disabled class="btn btn-block btn-primary py-2 active-send-btn">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="get-info">
                            <h2>
                                {{__('contact.follow')}}

                            </h2>
                            <ul class="contactus-social-info p-lg-5 mb-5">
                                <li>
                                    <a href="https://twitter.com/Saudi_Nurses">
                                        <i class="fab fa-twitter"></i>
                                        <em style="width: 30px; display:block"></em>
                                        <strong>  {{__('contact.AfaqLms')}}
                                            </strong>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UCSfj5r6YjItuB0Ltfslm6dA">
                                        <i class="fab fa-youtube"></i>
                                        <em style="width: 30px; display:block"></em>
                                        <strong>{{__('contact.Youtube')}}</strong>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/saudinursing">
                                        <i class="fab fa-facebook-f"></i>
                                        <em style="width: 30px; display:block"></em>
                                        <strong>{{__('contact.Facebook')}}</strong>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.snapchat.com/add/Saudi_Nurses">
                                        <i class="fab fa-snapchat"></i>
                                        <em style="width: 30px; display:block"></em>
                                        <strong>{{__('contact.snapchat')}}</strong>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row background-row row background-row space-row">

                <div class="tabcontent">
                    <div class="contact-form-box rounded p-lg-5 mb-5">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                        @endif
                        <form id="contact-form" class="contact-form" action="{{ route('enquiry_create') }}" method="post">
                            @csrf
                            <h2 class="text-center mb-3">How Can We Help?</h2>
                            <div class="text-center mb-4">Want to get in touch with us or have a question? Fill out this form</div>
                            <div class="form-row">
                                <div class="form-group have-input">
                                    <label class="sr-only" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" minlength="2" maxlength="45" required="required" pattern="[A-zÀ-ž]([A-zÀ-ž\s]){2,}">
                                </div>
                                <div class="form-group have-input">
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
                                </div>

                                <div class="form-group all">
                                    <label class="sr-only" for="cmessage">Your message</label>
                                    <textarea class="form-control" id="cmessage" name="message" placeholder="Enter your message" rows="10" required="required"></textarea>
                                </div>

                                <input type="hidden" name="g-recaptcha-response" id='g-recaptcha-response'>

                            <script>
                                document.getElementById('sesskey').value = M.cfg.sesskey;
                            </script>
                                <div class="form-group all">
                                    <input type="submit" name="submit" id="submit" value="Send" class="btn btn-block btn-primary py-2">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->

        </div>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                async defer>
        </script>
        <script>
            function enableBtn(){
                document.getElementById("submit").disabled = false;
            }
        </script>
    </div>
</section>
@endsection
