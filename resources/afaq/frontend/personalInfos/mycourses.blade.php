@extends('frontend.personalInfos.index')
@section('title' ,__('lms.my_courses'))
@section('myprofile')
    <link href="{{ asset('afaq/assests/css/course-card-style.css') }}" rel="stylesheet">
    <section class="mycourse-page-lms">
        <div class="sit-container">
            <div class="all-courses">
                <div class="myprofile-page">
                    @if (session('enroll'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('enroll') }}</div>
                            </div>
                        </div>
                    @endif
                    <div class="mycourse-page d-flex justify-content-between align-items-center">
                        <div class="myprofile-title">
                            <!-- <h3> {{ __('lms.my_courses') }}</h3> -->
                            <div class="tabsContainer">
                                <div id="tabTitle01" class="tabTitle">{{ __('lms.in_progress') }}</div>
                                <div id="tabTitle03" class="tabTitle">{{ __('lms.finished') }}</div>
                                <div id="tabTitle02" class="tabTitle">{{ __('lms.recorded') }}</div>

                            </div>
                        </div>
                        <form class="filter-form search-form" action="{{ route('admin.my_courses', ['locale' => app()->getLocale()]) }}">
                            <input type="hidden" name="sort" class="sort-value">
                        <div   class="mycourse-page-filtter ">
                            <span class="d-flex align-items-center" style="font-size: 16px;">{{ __('lms.sort') }}</span>
                            <div class="lms-filtter-stm">
                                <select  name="" id=""  class="no-search select2-hidden-accessible sort-select"
                                    tabindex="-1" aria-hidden="true">
{{--                                    <option value="">{{ __('afaq.sort_by') }}</option>--}}
                                    <option value="last_create" {{ request('sort') == 'last_create' ? 'selected' : '' }}>
                                        {{ __('lms.release_new') }}
                                    </option>
                                    <option value="first_create"
                                        {{ request('sort') == 'first_create' ? 'selected' : '' }}>
                                        {{ __('lms.release_old') }}
                                    </option>
                                    <option value="most_price" {{ request('sort') == 'most_price' ? 'selected' : '' }}>
                                        {{ __('lms.price_high') }}
                                    </option>
                                    <option value="less_price" {{ request('sort') == 'less_price' ? 'selected' : '' }}>
                                        {{ __('lms.price_low') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- *************************************************************** -->
                    <div class="Other_courses_lms ">
                        <div class="card-result d-flex flex-wrap mt-3">
                            <div class="tabContentContainer w-100">
                                <div id="tabContent01" class="tab">
                                    @forelse($courses as $v1)

                                        @if($v1)
                                        <div class="card-details">
                                            @include('frontend.partials.topactivity-course-card', [
                                                'course' => $v1,
                                            ])

                                            <div class="studentInfoInProfilePage flex-column">

                                                @if (strtotime($v1->start_date) > strtotime(now()))
                                                    <div class="canel-reson-nd mb-2"
                                                        onclick='item_data("{{ $v1->id }}","{{ $v1->payment_details_accepted->payment_id }}")'>
                                                        <span class="c-b-btn"> {{ __('global.cancel_booking') }} </span>
                                                    </div>
                                                @else
                                                    @php
                                                        $user_course = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id, 'course_id' => $v1->id])->first();
                                                    @endphp
                                                    @if($user_course)
                                                    <div class="progressBar">
                                                        <div>{{ __('global.completion_percentage') }} <span
                                                                class="completedCoursesPercentage">{{ $user_course->completion_percentage }}%</span>
                                                        </div>
                                                        <div class="progressBarBody">
                                                            <div class="progressBarHighlight"
                                                                style="width:{{ $user_course->completion_percentage ?? 0 }}% !important;max-width:100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courseContentButton">
                                                        <button
                                                            onclick="location.href='{{ url('/' . app()->getLocale() . '/one-courses-new/' . $v1->id) }}'">{{ __('afaq.content') }}</button>
                                                    </div>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                        @endif
                                    @empty
                                        <div class="empty-section">
                                            <div class="empity-img-section">
                                                <img src="{{ asset('/afaq/imgs/empty-box@2x.png') }}" alt="">
                                            </div>
                                            <div class="btn-empty_">
                                                <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}"> {{ __('lms.gotocourse') }} </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <div id="tabContent02" class="tab">

                                    @forelse($courses as $v1)
                                    @php
                                        if($v1){
                                            $user_course = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id, 'course_id' => $v1->id])->first();
                                        }else {
                                            $user_course = null;
                                        }
                                    @endphp
                                    @if($user_course && ($v1->coursePlace ? $v1->coursePlace->slug == 'recorded' : false))
                                        @if($user_course->completion_percentage >= $v1->success_percentage)
                                            <div class="card-details">
                                                @include('frontend.partials.topactivity-course-card', [
                                                    'course' => $v1,
                                                ])
                                            </div>
                                        @else

                                        @endif
                                    @else

                                    @endif
                                    @empty
                                        <div class="empty-section">
                                            <div class="empity-img-section">
                                                <img src="{{ asset('/afaq/imgs/empty-box@2x.png') }}" alt="">
                                            </div>
                                            <div class="btn-empty_">
                                                <a href=""> {{ __('lms.gotocourse') }} </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <div id="tabContent03" class="tab">

                                    @forelse($courses as $v1)
                                        @php
                                            if($v1){
                                                $user_course = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id, 'course_id' => $v1->id])->first();
                                            }else {
                                                $user_course = null;
                                            }
                                        @endphp
                                        @if($user_course && ($user_course->completion_percentage >= $v1->success_percentage))
                                        <div class="card-details">
                                            @include('frontend.partials.topactivity-course-card', [
                                                'course' => $v1,
                                            ])
                                        </div>
                                        @else

                                        @endif
                                    @empty
                                        <div class="empty-section">
                                            <div class="empity-img-section">
                                                <img src="{{ asset('/afaq/imgs/empty-box@2x.png') }}" alt="">
                                            </div>
                                            <div class="btn-empty_">
                                                <a href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">{{__('lms.go_to_course')}}  </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- {{-- ************************ sayed work****************** --}} -->
    <div class="nd-cancel-reservation-course">
        <div class="canel-card">
            <div class="close-popup-icon">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="cancel-title-card">
                <span>{{ __('global.cancel_booking') }}</span>
            </div>
            <div id="item_data"></div>
            <div class="cance-resone-nd" id="cancel_reason" style="display: none">
                <strong>{{ __('afaq.why_you_want_to_cancel_booking') }}</strong>
                <form method="post" action="{{ route('refund_course_action', ['locale' => app()->getLocale()]) }}">
                    <input type="hidden" name="course_id" id="course_id">
                    <input type="hidden" name="payment_id" id="payment_id">
                    <textarea name="cancel_reason" id="" cols="30" rows="10"></textarea>
                    <button type="submit">{{ __('global.send') }}</button>
                </form>
            </div>
        </div>
    </div>
    <!-- {{-- ************************ sayed work****************** --}} -->

    <script>
        // tabsContainer
        // tabTitle
        $('.tabsContainer .tabTitle:first-of-type').addClass('active')
        $('.tabContentContainer  .tab:nth-of-type(2)').addClass('hide')
        $('.tabContentContainer  .tab:nth-of-type(3)').addClass('hide')
        $('.tabsContainer .tabTitle').click(function() {
            $(this).siblings('.tabTitle').removeClass('active')
            $(this).addClass('active')
            var tabNumber = $(this).attr('id').slice(-2)
            $('#tabContent' + tabNumber).removeClass('hide')
            $('#tabContent' + tabNumber).siblings('.tab').addClass('hide')

            // $('.tabContentContainer .tab')
        })


        function item_data(id,payment_id) {

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/{{ app()->getLocale() }}/get_course_item_data/" + id + '/'+payment_id,
                success: function(data) {
                    if (data.valid == 0) {
                        $('#cancel_reason').hide()
                    }else{
                        $('#cancel_reason').show()
                    }
                    var item = `
                    <div class="d-flex align-items-center justify-content-between small-card-canc">
                        <div class="canc-img-course">
                            <img src="${data.image}" alt="">
                        </div>
                        <div class="details-nd-cours-canc">
                            <strong>${data.name}</strong>
                            <span class="date-nd-card">
                                <i class="fa-regular fa-calendar-days"></i>
                                ${data.date}
                            </span>
                            <span class="date-nd-card">
                                <i class="fa-solid fa-globe"></i>
                                ${data.coursePlace}
                            </span>
                        </div>
                        <div class="card-nd-coust">
                            <span>${data.price}</span>
                            <del>${data.oldprice}</del>
                        </div>
                    </div>
                    <div class="cancel-notes-nd d-flex justify-content-between">
                        <span>
                            <i class="fa-solid fa-circle-exclamation"></i>
                            ${data.msg}
                        </span>
                        <span>
                            <a href="{{ url('/' . app()->getLocale() . '/content/' . 'cancel-policy') }}"> {{ __('cruds.cancelationPolicy.title') }}</a>
                        </span>
                    </div>`

                    $('#item_data').html(item)
                    $('#course_id').val(id)
                    $('#payment_id').val(payment_id)
                }
            });


        }
    </script>


    <script>
        $('select').on('change', function(e) {
            var url = window.location.href;
            var item = $(this).attr('name');
            var value = $('#' + item).val();
            url = updateQueryStringParameter(url, item, value);
            window.location = url;
        });

        // $('#text').on('change', function(e) {
        //    var url = window.location.href;
        //    var item = $(this).attr('name');
        //    var value = $('#' + item).val();
        //    url = updateQueryStringParameter(url, item, value);
        //    window.location = url;
        // });

        $('.filter').on('click', function(e) {
            cleanUrl();
            var url = window.location.href;
            var item = $(this).attr('name');
            var value = $(this).attr('value');
            url = updateQueryStringParameter(url, item, value);
            window.location = url;
        });



        $(document).on('change', '.filter-her', function() {
            $('.filter-form').submit();
        });

        $(document).on('change', '.sort-select', function() {
            $('.sort-value').val($(this).val());
            $('.filter-form').submit();
        });
    </script>
@endsection
