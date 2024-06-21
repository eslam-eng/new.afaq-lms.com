@extends('layouts.front')
@section('content')
    <style>
        .swiper.mySwiper.slider-filtter-activities {
            /* position: absolute;
        top: 220px; */
            position: relative;
            top: -440px;
            height: fit-content;
        }

        .swiper {
            width: 83%;
            height: 100%;
            overflow: hidden !important;
        }

        .swiper-wrapper {
            display: flex !important;
        }

        .rtl .swiper {
            width: 100%;
        }

        .swiper-backface-hidden .swiper-slide:first-child {
            margin: 0 10px;
        }

        .swiper-slide {
            text-align: center;
            /* font-size: 18px; */
            /* background: #fff; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide,
        swiper-slide {
            width: auto !important;
        }

        .btn-filter-activities {
            width: max-content;
        }

        .swiper-slide .items a.nav-link.active {
            background: #88BD2F;
            color: #fff !important;
        }

        .swiper-slide .items a.nav-link {
            color: #0E4C75 !important;
            font-weight: 600;
            margin: 8px 0;
            background: #fff;
            display: flex;
            box-shadow: 0px 0px 2px #d8d8d8;
            align-items: center;
            font-size: 14px;
            padding: 0.7em 3em;
            border-radius: 0.25rem;
            width: max-content;
        }

        /* .order-first{
        order: 9;

    } */

.w-5- {
    width: 5px;
}

.w-10- {
    width: 10px;
}

.w-15- {
    width: 15px;
}

.w-20- {
    width: 20px;
}

.w-25- {
    width: 25px;
}

.w-30- {
    width: 30px;
}

.w-100- {
    width: 100px;
}

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.css"
        integrity="sha512-zar81H5lVN36QFsq/da1hxpOLODXK4/oFwBGOFrvdWX6SBe3NWriWTQS6YQDVfW5fDeb2Vry41YQCELOe8cHww=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="br-div px-5" style="">
        <ul class="br-ul">
            <li><a href="{{ route('site-home', ['locale' => app()->getLocale()]) }}">{{ __('lms.homepage') }}</a> /</li>
            <li><a
                    href="{{ route('all-courses', ['locale' => app()->getLocale()]) }}">{{ __('frontend.my_profile_page') }}</a>
            </li>
        </ul>
    </div>

    <section class="idu-programss container the-card-page myProfileContainer">
        <div class="col-12 cart-page-lms">
            <div class="col-10 offset-1">
                <div class="afaq-logo d-flex justify-content-center align-items-center">
                    <div class="afaq-img-log">
                        <img src="{{ asset('/afaq/imgs/Group 41932.png') }}" alt="">

                    </div>
                </div>


{{--                <!-- <div class="stm-lms-profile-img">--}}
{{--                                <div class="select-chose-file">--}}


{{--                                </div>--}}

{{--                                <div class="stm-lms-profile-name">--}}
{{--                                    <span>{{ app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? '' }}</span>--}}
{{--                                    <em>{{ auth()->user()->job_name ?? '' }}</em>--}}
{{--                                    @if (auth()->user()->country || auth()->user()->city)--}}
{{--    <i>--}}
{{--                                        <i class="fas fa-map-marker-alt"></i>--}}
{{--                                        {{ auth()->user()->country ?? '' }},{{ auth()->user()->city ?? '' }}--}}
{{--                                    </i>--}}
{{--    @endif--}}
{{--                                </div>--}}
{{--                                <div class="out-fitlayer"></div>--}}
{{--                            </div> -->--}}

                <div class="profileTopBar">
                    <div class="studentInfoInProfilePageContainer">
                        <div class="studentInfoInProfilePage">
                            <div class="user-img">
                                <img src="{{ auth()->user()->personal_photo->url ?? '/afaq/imgs/Groupimg.png' }}"
                                    alt="">
                            </div>
                            <div class="userName">
                                <div>
                                    {{ app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? 'لا يوجد الاسم بالعربي' }}
                                </div>
                                <div class="userEmail">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div class="studentInfoInProfilePage">
                            <div class="progressBar">
                                @php
                                    $user_courses_completion = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id])->sum('completion_percentage') ?? (0 / \App\Models\UsersCourse::where(['user_id' => auth()->user()->id])->count() ?? 1);
                                @endphp
                                <div>{{ __('lms.course_percentage') }} <span
                                        class="completedCoursesPercentage">{{ (int) $user_courses_completion }}%</span>
                                </div>
                                <div class="progressBarBody">
                                    <div class="progressBarHighlight"
                                        style="width:{{ $user_courses_completion ? ($user_courses_completion > 100 ? 100 : $user_courses_completion) : 0 }}% !important;max-width:100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="informationForStudentProgress">
                        <div class="informationItemBox">
                            <div class="informationIconContainer">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="informationIconText">
                                <div class="informationIconStatic">{{ __('lms.wallet') }}</div>
                                <div>{{ auth()->user()->wallet ? auth()->user()->wallet->balance : 0 }}
                                    {{ __('lms.currency') }}</div>
                            </div>
                        </div>
                        <div class="informationItemBox">
                            <div class="informationIconContainer">
                                {{--                                <i class="fa-solid fa-book"></i> --}}
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <div class="informationIconText">
                                <div class="informationIconStatic">{{ __('global.enrolled_courses_count') }}</div>
                                <div>
                                    {{ \App\Models\Course::withoutGlobalScopes()->whereNull('deleted_at')->whereHas('payment_details_accepted', function ($q) {
                                            $q->where('user_id', auth()->user()->id);
                                        })->whereHas('user_course')->count() }}
                                </div>
                            </div>
                        </div>
                        <div class="informationItemBox">
                            <div class="informationIconContainer">
                                {{--                                <i class="fa-solid fa-circle-check"></i> --}}
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                            <div class="informationIconText">
                                <div class="informationIconStatic">{{ __('global.completed_courses') }}</div>
                                @php
                                    $users_courses = \App\Models\Course::withoutGlobalScopes()
                                        ->with(['category', 'instructor', 'media', 'course_instructor', 'payment_details_accepted'])
                                        ->whereHas('payment_details_accepted', function ($q) {
                                            $q->where('user_id', auth()->user()->id);
                                        })
                                        ->whereHas('user_course')
                                        ->get();
                                    $count = 0;
                                    foreach ($users_courses as $value) {
                                        $user_course = \App\Models\UsersCourse::where(['user_id' => auth()->user()->id, 'course_id' => $value->id])->first();

                                        if ($user_course && $user_course->completion_percentage >= $value->success_percentage) {
                                            $count += 1;
                                        }
                                    }
                                @endphp
                                <div>
                                    {{ $count }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" profile-tabs-lms d-flex align-items-start mb-5">

                    <div class="right-profile-tabe-lms nav nav-pills on-larg-screen">
                        <a href="{{ url(app()->getLocale() . '/myprofile') }}"
                            class="nav-link {{ Request::segment(2) == 'myprofile' || Request::segment(2) == 'personal-infos' ? 'active' : '' }}"><i
                                class="fas fa-user"></i><span class="w-10-"></span>
                            <em>{{ __('lms.my_account') }}</em></a>
                        {{-- <a href="{{url(app()->getLocale() . '/mymembers')}}" class="nav-link {{Request::segment(2) == 'mymembers' ? 'active' : ''}}"><i class="fas fa-id-card"></i><em>{{__('lms.membership')}}</em></a> --}}
                        <a href="{{ url(app()->getLocale() . '/my_invoices') }}"
                            class="nav-link {{ Request::segment(2) == 'my_invoices' ? 'active' : '' }}"><i
                                class="fas fa-file-invoice"></i><span class="w-10-"></span>
                            <em>{{ __('lms.my_invoices') }}</em></a>
                        <a href="{{ url(app()->getLocale() . '/mycourses') }}"
                            class="nav-link {{ Request::segment(2) == 'mycourses' ? 'active' : '' }}"><i
                                class="fa-sharp fa-solid fa-layer-group"></i> <span
                                class="w-10-"></span><em>{{ __('lms.my_courses') }}</em></a>
                        <a href="{{ url(app()->getLocale() . '/my_certificates') }}"
                            class="nav-link {{ Request::segment(2) == 'my_certificates' ? 'active' : '' }}"><i
                                class="fa-solid fa-certificate"></i><span class="w-10-"></span>
                            <em>{{ __('lms.my_certificates') }}</em></a>
                        <a href="{{ url(app()->getLocale() . '/wallet') }}"
                            class="nav-link {{ Request::segment(2) == 'wallet' ? 'active' : '' }}"><i
                                class="fa-solid fa-wallet"></i><span class="w-10-"></span>
                            <em>{{ __('lms.wallet_and_points') }}</em></a>
                        <a href="{{ url(app()->getLocale() . '/my_exams') }}"
                            class="nav-link {{ Request::segment(2) == 'my_exams' ? 'active' : '' }}"><i
                                class="fa-solid fa-envelope-open-text"></i><span class="w-10-"></span>
                            <em>{{ __('lms.my_exams') }}</em></a>
                        <a href="{{ url(app()->getLocale() . '/my_quizes') }}"
                            class="nav-link {{ Request::segment(2) == 'my_quizes' ? 'active' : '' }}"><i
                                class="fa-solid fa-envelope-open-text"></i><span class="w-10-"></span>
                            <em>{{ __('lms.my_quizes') }}</em></a>
                        <a href="{{ url(app()->getLocale() . '/my_tickets') }}"
                            class="nav-link {{ Request::segment(2) == 'my_tickets' ? 'active' : '' }}"><i
                                class="fa-solid fa-ticket"></i><span class="w-10-"></span>
                            <em>{{ __('lms.myTicket') }}</em></a>
                        <a href="{{ url(app()->getLocale() . '/changemypassword') }}"
                            class="nav-link {{ Request::segment(2) == 'changemypassword' ? 'active' : '' }}"><i
                                class="fas fa-lock-open"></i><span
                                class="w-10-"></span><em>{{ __('lms.change_password') }}</em> </a>
                        <a class="nav-link" href="#"
                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <i class="fas fa-sign-out-alt"></i><span class="w-10-"></span>
                            <em> {{ __('lms.Logout') }}</em>
                        </a>
                        <form id="logoutform" action="{{ route('logout', ['locale' => app()->getLocale()]) }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>

                    <div class="on-small-screen">

                        {{-- **********************************swiper*********************** --}}
                        <div class="swiper mySwiper slider-filtter-activities swiper-acc-setting">
                            <div class="swiper-wrapper ">
                                <div class="swiper-slide {{ Request::segment(2) == 'myprofile' ? 'order-first' : '' }}">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/myprofile') }}"
                                            class="nav-link {{ Request::segment(2) == 'myprofile' || Request::segment(2) == 'personal-infos' ? 'active' : '' }}"><i
                                                class="fas fa-user"></i><span class="w-10-"></span> <em>{{ __('lms.my_account') }}</em></a>
                                    </div>
                                </div>
                                <div class="swiper-slide {{ Request::segment(2) == 'my_invoices' ? 'order-first' : '' }}">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/my_invoices') }}"
                                            class="nav-link {{ Request::segment(2) == 'my_invoices' ? 'active' : '' }}"><i
                                                class="fas fa-file-invoice"></i><span class="w-10-"></span> <em>{{ __('lms.my_invoices') }}</em></a>
                                    </div>
                                </div>
                                <div class="swiper-slide {{ Request::segment(2) == 'mycourses' ? 'order-first' : '' }} ">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/mycourses') }}"
                                            class="nav-link {{ Request::segment(2) == 'mycourses' ? 'active' : '' }}"><i
                                                class="fa-sharp fa-solid fa-layer-group"></i>
                                                <span class="w-10-"></span>
                                            <em>{{ __('lms.my_courses') }}</em></a>
                                    </div>
                                </div>
                                <div class="swiper-slide {{ Request::segment(2) == 'wallet' ? 'order-first' : '' }}">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/wallet') }}"
                                            class="nav-link {{ Request::segment(2) == 'wallet' ? 'active' : '' }}"><i
                                                class="fa-solid fa-wallet"></i><span class="w-10-"></span>
                                            <em>{{ __('lms.wallet_and_points') }}</em></a>
                                    </div>
                                </div>
                                <div
                                    class="swiper-slide {{ Request::segment(2) == 'my_certificates' ? 'order-first' : '' }}">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/my_certificates') }}"
                                            class="nav-link {{ Request::segment(2) == 'my_certificates' ? 'active' : '' }}"><i
                                                class="fa-solid fa-certificate"></i><span class="w-10-"></span>
                                            <em>{{ __('lms.my_certificates') }}</em></a>
                                    </div>
                                </div>
                                <div class="swiper-slide {{ Request::segment(2) == 'my_exams' ? 'order-first' : '' }} ">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/my_exams') }}"
                                            class="nav-link {{ Request::segment(2) == 'my_exams' ? 'active' : '' }}"><i
                                                class="fa-solid fa-envelope-open-text"></i><span class="w-10-"></span>
                                            <em>{{ __('lms.my_exams') }}</em></a>
                                    </div>
                                </div>
                                <div class="swiper-slide {{ Request::segment(2) == 'my_quizes' ? 'order-first' : '' }}">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/my_quizes') }}"
                                            class="nav-link {{ Request::segment(2) == 'my_quizes' ? 'active' : '' }}"><i
                                                class="fa-solid fa-envelope-open-text"></i><span class="w-10-"></span>
                                            <em>{{ __('lms.my_quizes') }}</em></a>
                                    </div>
                                </div>
                                <div class="swiper-slide {{ Request::segment(2) == 'my_tickets' ? 'order-first' : '' }}">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/my_tickets') }}"
                                            class="nav-link {{ Request::segment(2) == 'my_tickets' ? 'active' : '' }}"><i
                                                class="fa-solid fa-ticket"></i><span class="w-10-"></span>
                                            <em>{{ __('lms.myTicket') }}</em></a>
                                    </div>
                                </div>
                                <div
                                    class="swiper-slide {{ Request::segment(2) == 'changemypassword' ? 'order-first' : '' }}">
                                    <div class="items">
                                        <a href="{{ url(app()->getLocale() . '/changemypassword') }}"
                                            class="nav-link {{ Request::segment(2) == 'changemypassword' ? 'active' : '' }}"><i
                                                class="fas fa-lock-open"></i><span class="w-10-"></span>
                                            <em>{{ __('lms.change_password') }}</em>
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide ">
                                    <div class="items">
                                        <a class="nav-link" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <em> {{ __('lms.Logout') }}</em>
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide ">
                                    <div class="items">
                                        <form id="logoutform"
                                            action="{{ route('logout', ['locale' => app()->getLocale()]) }}"
                                            method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- *************************************************************** --}}


                    </div>
                    <div class="left-profile-tabe-lms tab-content">
                        @yield('myprofile')
                    </div>
                </div>


            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(e) {
            function get_sub_specialists() {
                var id = $('#specialty_id').val();
                if (id) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/{{ app()->getLocale() }}/get_specialty/' + id,
                        success: function(data) {
                            var subuser = ` `;
                            for (let index = 0; index < data.length; index++) {
                                const element = data[index];
                                subuser += `<option value="` + element.id + `">` + element.name +
                                    `</option>`
                            }

                            subuser += ``;

                            $('#sub_specialty_id').html(subuser);
                            $("#sub_specialty_id").select2().select2('text', $('#sub_specialty_id')
                                .val());
                        }
                    });
                }
            }

            $('#sort').on('change', function(e) {
                var url = window.location.href;
                var item = $(this).attr('name');
                var value = $('#' + item).val();
                url = updateQueryStringParameter(url, item, value);
                window.location = url;
            });


            $('.filter').on('click', function(e) {
                cleanUrl();
                var url = window.location.href;
                var item = $(this).attr('name');
                var value = $(this).attr('value');
                url = updateQueryStringParameter(url, item, value);
                window.location = url;
            });

            $('.btn_filter').on('click', function(e) {
                var item = $('#text').attr('name');
                var value = $('#text').val();
                if (value != '') {
                    cleanUrl();
                    var url = window.location.href;
                    url = updateQueryStringParameter(url, item, value);
                    window.location = url;
                } else {
                    alert('please, type text in search box ...')
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#personal_photo').change(function() {
                var formData = new FormData();
                var files = $('#personal_photo')[0].files;
                formData.append('personal_photo', files[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('update_personal_photo') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        console.log(response);
                        $('#personal_img').attr('src', response);

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.min.js"
        integrity="sha512-+z66PuMP/eeemN2MgRhPvI3G15FOBbsp5NcCJBojg6dZBEFL0Zoi0PEGkhjubEcQF7N1EpTX15LZvfuw+Ej95Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endsection
