<style>
    .coust-before h5 {
        padding: 8px;
        border-radius: 30px;
        color: #000;
        font-weight: 600;
        font-size: 15px;
        margin: 15px 10px;
        cursor: pointer;
        background: #DEDD33;
        width: max-content;
        margin: 15px auto;
    }

    .coust-before .time-offer {
        padding: 10px 20px;
    }

    .termis-data {
        position: relative;
        background: #ffffff;
        padding: 50px;
        width: 60%;
        height: auto;
        margin: 50px auto;
        border-radius: 10px;
        box-shadow: 0px 5px 16px #d8d8d84a;
        overflow-y: scroll;
        max-height: 600px;
    }

    .test-tabby {
        display: flex;
        align-items: center;
        justify-content: start;
    }

    .tabby-img {
        width: 70px;
        height: 34px;
    }

    .tabby-img img {
        width: 100%;
        max-width: 100%;
        min-width: 100%;
    }

    .tabby-termise {
        padding: 10px;
        background: #fff;
        border: 1px solid #CBCBCB;
        border-radius: 6px;
        box-shadow: 0px 8px 26px #b0b0b0c2;
        cursor: pointer;
    }

    span.text-termise- {
        font-size: 12px;
        color: #5F5F5F;
        font-weight: 600;
        margin: 0 10px;
    }

    span.text-termise- em {
        color: #1968FB;
    }

    .tabby-popup {
        position: fixed;
        width: 100%;
        height: 100%;
        background: #737373a6;
        top: 0;
        left: 0;
        z-index: 9;
        display: none;
    }

    .body-tabby- {
        width: 42%;
        height: 50%;
        margin: 5% auto;
        background: #fff;
        border-radius: 6px;
        padding: 40px;
    }

    .close-tabby {
        display: flex;
        justify-content: start;
        margin: 0px 0 20px 0;
        font-size: 30px;
        cursor: pointer;
    }

    .body-taby-content {
        font-size: 16px;
        font-weight: 500;
    }

    .tabby-popup.active {
        display: block;
    }

    /* Dropdown Button */
    /* .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    } */

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #ddd;
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */


    div#atcb-btn-1-modal-host {
    background: #bbbbbba3;
}
.atcb-list-item .atcb-icon {
    margin: 0 0.6em !important;
}
</style>

<div class="Introduction-card-details">
    <div class="created-by-bunner ">
        <!-- <span>Created By</span> -->
        <div class="lms-img-created-by-bunner">{{-- {{ $oneCourse->courseTrack->title ?? '' }} --}}

            <img src="{{ isset($oneCourse->image) ? $oneCourse->image->url : '' }}" alt="">
        </div>
    </div>
    <div class="bc-g lms">
        <div class=" coust-before ">
            <div class="d-flex justify-content-between b_before padding_lms">
                {{--                <span>Before</span> --}}
                <div class="new-D d-flex justify-content-end w-100">
                    {{--                    <del>950</del> --}}

                    @if ($oneCourse->courseAvailability)
                        <span>
                            {{ $oneCourse->courseAvailability->title ?? '' }}
                        </span>
                    @endif
                </div>
            </div>

            @if (!$reserved && !$check_exist)
                @if (auth()->check() &&
                        count(auth()->user()->memberships) &&
                        auth()->user()->active_membership &&
                        $oneCourse->member_price)
                    <div class="physicians_ padding_lms">
                        <div class="d-flex justify-content-between btn_physicians_">
                            <span><em>{{ __('lms.price') }}</em> </span>
                            <span class="cost_lamss">
                                {{ $oneCourse->member_price . ' ' . __('lms.SR') }}
                            </span>
                        </div>
                        <div class="time-offer">
                            <img src="/afaq/imgs/info.png" alt="">
                            <span>{{ __('global.timeFrom') }}
                                {{ date('j F', strtotime($oneCourse->start_register_date)) }}</span>
                        </div>
                    </div>
                @elseif($oneCourse->has_general_price && $oneCourse->price > 0)
                    <div class="physicians_  padding_lms">
                        <div class="d-flex justify-content-between btn_physicians_">
                            <span><em>{{ __('lms.price') }}</em> </span>
                            <span class="cost_lamss">
                                {{ $oneCourse->price . ' ' . __('lms.SR') }}
                            </span>
                        </div>
                        <div class="time-offer">
                            <img src="/afaq/imgs/info.png" alt="">
                            <span>{{ __('global.timeFrom') }}
                                {{ date('j F', strtotime($oneCourse->start_register_date)) }}</span>
                        </div>
                    </div>
                @elseif(count($oneCourse->prices) && !$oneCourse->has_general_price)
                    @include('frontend.oneCoursePage.partials.prices')
                @elseif (strtotime($oneCourse->end_register_date) > $today)
                    @if (auth()->check())
                        <span
                            style="
                    color: #845097;
                    background-color: #fff;
                    border: solid #845097 1px;
                    text-transform: none;
                    display: block;
                    border-radius: 50px;
                    padding: 7px;
                    text-align: center;
                    width: 60%;
                    margin: 20px auto;
                    font-weight: bold;
                    ">
                            {{ __('lms.free') }} </span>
                    @else
                        <span onclick="window.location.href='{{ route('login') }}'"
                            style="
                    color: #845097;
                    background-color: #fff;
                    border: solid #845097 1px;
                    text-transform: none;
                    display: block;
                    border-radius: 50px;
                    padding: 7px;
                    text-align: center;
                    width: 60%;
                    margin: 20px auto;
                    font-weight: bold;
                    cursor: pointer;
                    ">
                            {{ __('lms.free') }} </span>
                    @endif
                @endif
            @elseif(!$reserved && $check_exist)
                @if (auth()->check())
                    <div class="padding_lms book-btn_ padding_lms">
                        <button type="button" class="on-book-now border-0"
                            onclick="window.location.href = '{{ url(app()->getLocale() . '/my_invoices') }}'">
                            <strong>{{ __('lms.goto_invoices') }}</strong>
                        </button>

                    </div>
                @else
                @endif
            @else
                @if (
                    $oneCourse->sections->count() &&
                        $oneCourse->sections()->first()->id &&
                        $oneCourse->sections()->first()->lectures->count() &&
                        $oneCourse->sections()->first()->lectures()->first()->id)
                    <div class="reservation_action row justify-content-center padding_lms">
                        <button class="add-card-btn on-book-now border-0"
                            @if ($oneCourse->sections->count()) onclick="window.location.href ='{{ route('one-course-content', ['locale' => app()->getLocale(),'course_id' => $oneCourse->id,'section_id' => $oneCourse->sections()->first()->id,'lecture_id' => $oneCourse->sections()->first()->lectures()->first()->id]) }}'" @endif>
                            {{ __('global.go_course_detials') }} </button>
                    </div>
                @endif
            @endif

        </div>

        <div class="padding_lms Money-Back-Guarantee time-offer">
            {{--            <img src="/afaq/imgs/security.png" alt=""> --}}
            {{--            <span> --}}
            {{--             30-Day Money-Back Guarantee --}}
            {{--            </span> --}}
        </div>
        <div class="padding_lms book-btn_">
            @if (!$oneCourse->has_general_price && count($oneCourse->prices) && !auth()->check())
                <div class="on-book-now">

                    <span onclick="$('.early_booking-btn').click()">
                        {{ __('lms.depends_on') }} </span>

                    {{--                <div class="add-card-btn"> --}}
                    {{--                    <span>Add to Cart</span> --}}
                    {{--                </div> --}}
                    {{--                <div class="wishlist-nd"> --}}
                    {{--                    <i class="fa-regular fa-heart"></i> --}}
                    {{--                    <img src="/afaq/imgs/Grouplikeoo.png" alt=""> --}}
                    {{--                </div> --}}
                </div>
            @endif
            @if (
                (!$reserved &&
                    isset($end_register_date) &&
                    $today < $end_register_date &&
                    auth()->check() &&
                    !$check_exist &&
                    ($current_specialty || $oneCourse->has_general_price))&& !$is_completed &&($spe && $sub_spe))
                <div class="on-book-now" onclick="addToCart('redirect')">
                    <span>{{ __('global.book') }}</span>
                </div>
                @if (empty($check_cart) && !$check_exist)
                    <div class="add-card-btn  justify-content-center" onclick="addToCart('open')">
                        <span>{{ __('global.add_to_cart') }}</span>
                    </div>
                @endif
            @elseif(!auth()->check())
                <div class="on-book-now" onclick="addToCart('redirect')">
                    <span>{{ __('global.book') }}</span>
                </div>
            @endif
            @if($is_completed &&  auth()->check() && !$reserved)
            <div class="coust-before">
                <h5 class="text-danger">{{__('cruds.course_messages.seats_booked')}}</h5>
            </div>

            @endif



            {{--            <div class="on-book-now"> --}}
            {{--                <span>Book Now</span> --}}
            {{--            </div> --}}

            <div class="from-to-date d-flex align-items-center pt-1 pb-1">
                <i class="fa-solid fa-calendar-days"></i>
                <span> {{ date('j- m -Y', strtotime($oneCourse->start_date)) }}</span>
                <em>{{ __('lms.to') }}</em>
                <span>{{ date('j -m -Y', strtotime($oneCourse->end_date)) }}</span>
            </div>

            <div class=" Course_features d-flex align-items-center pt-1 pb-1">
                <img src="/afaq/imgs/Shapeok27.png" alt="">
                <span> {{ __('global.course_features') }}</span>
            </div>
            <div class=" sollection-dta-card pt-1 pb-1">
                <div class="lms-bord d-flex justify-content-between">
                    <span>
                        <i class="fa-solid fa-graduation-cap"></i>
                        {{ __('afaq.reservation_number') }}
                    </span>
                    <em>{{ $reservation_course  }}</em>
                </div>
                <div class="lms-bord d-flex justify-content-between">
                    <span>
                        <i class="fa-regular fa-clock"></i>
                        {{ trans('global.training_hours') }}
                    </span>
                    <em>{{ $oneCourse->lecture_hours }}</em>
                </div>

                @if ($oneCourse->course_accreditation_id == 12 && $oneCourse->accredit_hours)
                    <div class="lms-bord d-flex justify-content-between">

                        <span>
                            <i class="fa-sharp fa-solid fa-school-circle-check"></i>
                            {{ __('global.certified_training_hours') }}
                        </span>
                        <em>{{ $oneCourse->accredit_hours }}</em>

                    </div>
                @endif
                @if ($oneCourse->course_accreditation_id == 14)
                    <div class="lms-bord d-flex justify-content-between">

                        <span>
                            <i class="fa-sharp fa-solid fa-school-circle-exclamation"></i>
                            {{ $oneCourse->courseAccreditation->title }}
                        </span>

                    </div>
                @endif
                <div class="lms-bord d-flex justify-content-between">

                    @if ($oneCourse->certificate_price)
                        <span>
                            <i class="fa-solid fa-certificate"></i>
                            {{ __('lms.Certificate_fees') }}
                        </span>
                        <em>{{ $oneCourse->certificate_price }}</em>
                    @else
                        <span>
                            <i class="fa-solid fa-certificate"></i>
                            {{ __('lms.Certificate') }}
                        </span>
                    @endif
                </div>
                <div class="lms-bord d-flex justify-content-between">
                    @if ($oneCourse->coursePlace)
                        <span>
                            <i class="fa-solid fa-globe"></i>
                            {{ $oneCourse->coursePlace->title ?? '' }}
                        </span>
                    @endif

                </div>

            </div>
        </div>
        {{--        {{dd($oneCourse)}} --}}
        <div class="d-flex justify-content-center add-pay-card pt-1 pb-3">
            {{--            <a href="https://calendar.google.com/calendar?authuser={{auth()->user()->email}}&text"> --}}
            {{--                <a href="https://calendar.google.com/calendar/?authuser={{auth()->user()->email}} --}}
            {{--                   &text={{$oneCourse->title_en }}"> --}}



            {{-- <div class="dropdown">
                <span class="add-date_ dropbtn">
                    <i class="fa-solid fa-calendar-days"></i>
                    <em>{{ __('afaq.addcalender') }}</em>
                </span>
                <div class="dropdown-content">
                    <a href="http://www.google.com/calendar/event?
                    action=TEMPLATE
                    &text={{ $oneCourse->name_en }}
                    &dates={{ date('Ymd', strtotime($oneCourse->start_date)) }}/{{ date('Ymd', strtotime($oneCourse->end_date)) }}
                    &details=AFAQ Course Will Start soon
                    &trp=false
                    &sprop=
                    &sprop=name:AFAQ"><img src="{{asset('afaq/icons/cal/search.png')}}" width="20" alt="">  Google</a>
                    <a href="#">Link 2</a>
                    <a href="#"><i class="fab fa-apple"></i> Apple</a>
                </div>
            </div> --}}<span class=" d-flex" style="padding: 7px;">
                <div class="col-2" style="text-align: center;
                justify-content: center;
                font-size: 1.6rem;padding:10px">
                    <i class="fa-solid fa-calendar-days "></i>
                </div>
                <add-to-calendar-button class="col-9" style="background: transparent !important;
                border: none !important;
                padding: 0 !important; "
            name="{{ $oneCourse->name_en }}"
            description="AFAQ Course Will Start soon"
            startDate="{{ date('Y-m-d', strtotime($oneCourse->start_date)) }}"
            startTime="10:15"
            endDate="{{ date('Y-m-d', strtotime($oneCourse->end_date)) }}"
            endTime="23:00"
            timeZone="Asia/Riyadh"
            location="World Wide Web"
            options="'Apple','Google','iCal','Outlook.com','Yahoo','MicrosoftTeams','Microsoft365'"
            label=' <em>{{ __('afaq.addcalender') }}</em>'
            hideIconButton
            hideBackground
            inline
                                        listStyle="modal"
                                        lightMode="bodyScheme"
            >
        </add-to-calendar-button>
                </span>


        </div>

        <div class="InviteFriends share-course  d-flex justify-content-center align-items-center"
            onclick="shareCourse()">
            <span>
                <i class="fa-solid fa-share-nodes"></i>
                <em onclick="shareCourse()">{{ __('global.share_course') }}</em>
            </span>
        </div>
        <div class="InviteFriends-popup">
            <span class="fk-popup"></span>
            <div class="card-share">
                <span class="close-window">
                    <i class="fa-solid fa-circle-xmark"></i>
                </span>
                <div class="share-pointss">
                    <div id="share_course_popup">
                        <div class="share_to_social_media">
                            {{ __('global.share_to_social_media') }}

                            <div class="social-icons">
                                <!-- Twitter -->
                                <a style="color: #55acee !important;"
                                    href="https://twitter.com/intent/tweet?text=afaq&url={{ url()->current() }}"
                                    role="button">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <!-- Facebook -->
                                <a style="color: #3b5998 !important;"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&quote=afaq"
                                    role="button">
                                    <i class="fab fa-facebook-f fa-lg"></i>
                                </a>
                                <!-- Whatsapp -->
                                <a style="color: #25d366 !important;"
                                    href="https://wa.me/?text=afaq {{ url()->current() }}" role="button">
                                    <i class="fab fa-whatsapp fa-lg"></i>
                                </a>
                                <!-- Linkedin -->
                                <a style="color: #0e76a8 !important;"
                                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                                    role="button">
                                    <i class="fab fa-linkedin fa-lg"></i>
                                </a>
                                <!-- Gmail -->
                                <a style="color: #bb001b !important;"
                                    href="https://mail.google.com/mail/u/0/?view=cm&to&su=Awesome+Blog!&body=https%3A%2F%2F{{ url()->current() }}%0A&bcc&cc&fs=1&tf=1"
                                    role="button">
                                    <i class="fa-brands fa-google"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
    <br>

    {{--    <div class="tabby-termise"> --}}
    {{--        <div class="test-tabby"> --}}
    {{--            <div class="tabby-img"> --}}
    {{--                <img src="{{ asset('/afaq/imgs/Group 43432@2x.png ') }}" alt=""> --}}
    {{--            </div> --}}
    {{--            <span class="text-termise-"> --}}
    {{--                                    {{ __('lms.InterestFreePayments') }} --}}
    {{--                                    <em>{{ __('lms.LearnMore') }}</em> --}}
    {{--                                </span> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    @include('frontend.oneCoursePage.partials.collaborations')
</div>
