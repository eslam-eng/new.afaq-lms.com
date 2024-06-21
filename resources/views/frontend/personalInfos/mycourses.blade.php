@extends('frontend.personalInfos.index')

@section('myprofile')
    <style>
        .latestcourse-card {
            /* width: 40% !important; */
            width: clamp(250px, 33% - 2rem, 300px);
        }

        .Other_courses_lms {
            justify-content: space-evenly !important;
        }

        @media screen and (max-width: 830px) {
            .precemp {
                bottom: 30px;
            }

            .latestcourse-card {
                /* width: 40% !important; */
                width: 100%;
                max-width: 350px;
            }
        }
    </style>
    <section class="mycourse-page-lms">
        <div class="container sit-container">
            <div class="all-courses">
                <div class="myprofile-page">

                    @if (session('enroll'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('enroll') }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="mycourse-page d-flex justify-content-between">
                        <div class=" myprofile-title">
                            <h3> {{ __('lms.my_courses') }}</h3>
                        </div>
                        @if (count($courses) > 0)
                            <div class="mycourse-page-filtter">
                                <span>{{ __('lms.sort') }}</span>
                                <div class="lms-filtter-stm">
                                    <select name="sort" id="sort" class="no-search select2-hidden-accessible"
                                        tabindex="-1" aria-hidden="true">
                                        <option value="">{{ __('lms.select') }}</option>
                                        <option value="date_high" {{ request('sort') == 'date_high' ? 'selected' : '' }}>
                                            {{ __('lms.release_new') }}</option>
                                        <option value="date_low" {{ request('sort') == 'date_low' ? 'selected' : '' }}>
                                            {{ __('lms.release_old') }}</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                            {{ __('lms.price_high') }}</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                            {{ __('lms.price_low') }}</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- *************************************************************** -->
                    @if (count($courses) > 0)
                        <div class="Other_courses_lms ">
                            @foreach ($courses as $v1)

                                @include('frontend.partials.course-card', ['course' => $v1])

                            @endforeach
                            <div class="cancel_booking_popup hide" >
                                <div class="cancel_course_x fk-popup">
                                    <span></span>
                                </div>
                                <div class="cancel_booking_inner_popup" >

                                    <div class="cancel_course_x">
                                        <span><i class="fa-solid fa-xmark"></i></span>
                                    </div>
                                    <h6>{{ __('global.cancel_booking') }}</h6>
                                    <div id="item_data"></div>
                                    <div class="why_cancel_booking" id="cancel_reason">
                                        <form method="post" class="w-100" action="{{ route('refund_course_action', ['locale' => app()->getLocale()]) }}">
                                            <span>{{ __('global.why_cancel_booking') }}</span>
                                            <input type="hidden" name="course_id" id="course_id">
                                            <input type="hidden" name="payment_id" id="payment_id">
                                            <textarea class="w-100" id="" cols="30" rows="7" name="cancel_reason"
                                                placeholder="{{ __('global.write_cancellation_reason') }}"></textarea>
                                            <div class="send_request_button">
                                                <button type="submit">{{ __('global.send') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($courses)
                        <div class="p-5">
                            {!! $courses->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <script>
        // alert('hi')
        // $('.myprofile-page .latestcourse-card').each(function() {



        // })
        // function goToContent(){
        //   // type here your script
        //   var contentLink = $(this).className
        // alert('clicked') // delete this line
        //   // location.href =
        // }
        // location.href='http://sna.test/ar/one-courses/215'
        $('.go_content_or_cancel_course button.goToContent').click(function() {
            var contentLink = $(this).parent('div.go_content_or_cancel_course').siblings('div').attr('onclick')
                .replace("window.open('", "").replace("')", "")
            window.open(
                contentLink,
                '_blank' // <- This is what makes it open in a new window.
            );
        })

        $(document).on('click','.cancel-btn-sna',function(){
            // type here your script
            $('.cancel_booking_popup.hide').removeClass('hide')
        })

        $('.cancel_booking_popup').click(function(e) {
            target = e.target
            if ($(target).children('.cancel_booking_inner_popup').length) {
                $('.cancel_booking_popup').addClass('hide')
            }
        })
        $('.cancel_booking_popup .cancel_course_x span').click(function() {
            $('.cancel_booking_popup').addClass('hide')
        })

    function item_data(id, payment_id) {

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/{{ app()->getLocale() }}/get_course_item_data/" + id + '/' + payment_id,
            success: function(data) {
                if (data.valid == 0) {
                    $('#cancel_reason').hide()
                } else {
                    $('#cancel_reason').show()
                }
                var item = `<div class="cancel_course_info">
                        <div class="cancel_course_image">
                            <img src="${data.image}" alt="">
                        </div>
                        <div class="cancel_course_under_image">
                            <div class="cancel_course_paragraphs">
                                <h5>${data.name}</h5>
                                <div class="cancel_course_subinfo">
                                    <span><i class="fa-solid fa-calendar-days"></i></span>
                                    <span>${data.date}</span>
                                </div>
                                <div class="cancel_course_subinfo">
                                    <span><i class="fa-solid fa-globe"></i></span>
                                    <span>${data.coursePlace}</span>
                                </div>
                            </div>
                            <div class="cancel_course_price">
                                <span>${data.price}</span>
                                <del>${data.oldprice}</del>
                            </div>
                        </div>
                    </div>
                    <div class="cancel_course_warning">
                        <span class="exclimation_cancel_warning"><i class="fa-solid fa-exclamation"></i></span>
                        <span> ${data.msg}</span>
                    </div>`

                    $('#item_data').html(item)
                    $('#course_id').val(id)
                    $('#payment_id').val(payment_id)
                }
            });


        }
    </script>

@endsection
