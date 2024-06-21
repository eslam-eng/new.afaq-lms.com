<div id="sidebar" class="c-sidebar c-sidebar-fixed {{ app()->getLocale() == 'en' ? ' c-sidebar-lg-show' : ''}}">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="/">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('home_page_access')
            <li class="c-sidebar-nav-dropdown
             {{ request()->is("admin/sliders*") ? "active" : "" }}
             {{ request()->is("admin/slider-cards*") ? "c-show" : "" }}
             {{ request()->is("admin/icon-texts*") ? "active" : "" }}
             {{ request()->is("admin/partners*") ? "c-show" : "" }}
              {{ request()->is("admin/icon-text-des*") ? "c-show" : "" }}
              {{ request()->is("admin/accreditation-sponsors/*") ? "c-show" : "" }}
            {{ request()->is("admin/universities/*") ? "c-show" : "" }}
            {{  request()->is("admin/hospitals/*") ? "c-show" : "" }}
            {{ request()->is("admin/nationalities/*") ? "c-show" : "" }}




            ">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.homePage.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('slider_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "active" : "" }}">
                                <i class="fa-fw fab fa-slideshare c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.slider.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('slider_card_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.slider-cards.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/slider-cards") || request()->is("admin/slider-cards/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sliders-h c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.sliderCard.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('icon_text_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.icon-texts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/icon-texts") || request()->is("admin/icon-texts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sliders-h c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.iconText.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('partner_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.partners.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/partners") || request()->is("admin/partners/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.partner.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('icon_text_de_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.icon-text-des.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/icon-text-des") || request()->is("admin/icon-text-des/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-slideshare c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.iconTextDe.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('accreditation_sponsor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.accreditation-sponsors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/accreditation-sponsors") || request()->is("admin/accreditation-sponsors/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.accreditationSponsor.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('university_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.universities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/universities") || request()->is("admin/universities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-university c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.university.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('hospital_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.hospitals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hospitals") || request()->is("admin/hospitals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-h-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.hospital.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('memberships_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/reservations*") ? "c-show" : "" }} {{ request()->is("admin/enrollments*") ? "c-show" : "" }} {{ request()->is("admin/course-invoices*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.memberships.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">

                    @can('membership_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.membership-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/membership-types") || request()->is("admin/membership-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase-medical c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.membershipType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('membership_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.memberships.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/memberships") || request()->is("admin/memberships/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-band-aid c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.membership.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_membership_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-memberships.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-memberships") || request()->is("admin/user-memberships/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-monument c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userMembership.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('student_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.student.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('Unverified_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.Unverified") }}" class="c-sidebar-nav-link {{ request()->is("admin/Unverified-student") || request()->is("admin/Unverified-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.Unverified') }}
                            </a>
                        </li>
                    @endcan
                    @can('unchecked_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.Unchecked") }}" class="c-sidebar-nav-link {{ request()->is("admin/Unchecked-student") || request()->is("admin/Unchecked-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.Unchecked') }}
                            </a>
                        </li>
                    @endcan
                    @can('binding_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.binding") }}" class="c-sidebar-nav-link {{ request()->is("admin/binding-student") || request()->is("admin/binding-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.binding') }}
                            </a>
                        </li>
                    @endcan
                    @can('withdrawal_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.withdrawal") }}" class="c-sidebar-nav-link {{ request()->is("admin/withdrawal-student") || request()->is("admin/withdrawal-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.withdrawal') }}
                            </a>
                        </li>
                    @endcan

                    @can('approved_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.approved") }}" class="c-sidebar-nav-link {{ request()->is("admin/approved-student") || request()->is("admin/approved-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.approved') }}
                            </a>
                        </li>
                    @endcan
                    @can('disapproved_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.disapproved") }}" class="c-sidebar-nav-link {{ request()->is("admin/disapproved-student") || request()->is("admin/disapproved-student/*") ? "active" : "" }}">
                                <i class="fas fa-mortar-pestle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.disapproved') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('student_speciality_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/specialties*") ? "c-show" : "" }} {{ request()->is("admin/sub-specialties*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-basketball-ball c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.studentSpeciality.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('specialty_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.specialties.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/specialties") || request()->is("admin/specialties/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-asterisk c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.specialty.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('sub_specialty_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sub-specialties.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sub-specialties") || request()->is("admin/sub-specialties/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-bandcamp c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.subSpecialty.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('courses_section_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/instructors*") ? "c-show" : "" }} {{ request()->is("admin/courses*") ? "c-show" : "" }} {{ request()->is("admin/student-moodles*") ? "c-show" : "" }} {{ request()->is("admin/course-categories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-coins c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.coursesSection.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('instructor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.instructors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/instructors") || request()->is("admin/instructors/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-accusoft c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.instructor.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.courses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.course.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_moodle_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-moodles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-moodles") || request()->is("admin/student-moodles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-edit c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentMoodle.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.course-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-categories") || request()->is("admin/course-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-bandcamp c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.courseCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('coupon_code_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.coupon-codes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coupon-codes") || request()->is("admin/coupon-codes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.couponCode.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cancelation_policy_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cancelation-policies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cancelation-policies") || request()->is("admin/cancelation-policies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-ban c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cancelationPolicy.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('zoom_meeting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.zoom-meetings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/zoom-meetings") || request()->is("admin/zoom-meetings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-meetup c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.zoomMeeting.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        @can('exams_section_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/certificats*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.examsSection.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('certificat_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.certificats.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/certificats") || request()->is("admin/certificats/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-certificate c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.certificat.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('exams_title_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.exams-titles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/exams-titles") || request()->is("admin/exams-titles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-broom c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.examsTitle.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('question_bank_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.question-banks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/question-banks") || request()->is("admin/question-banks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-piggy-bank c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.questionBank.title') }}
                            </a>
                        </li>
                    @endcan

                    @can('exam_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.exams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/exams") || request()->is("admin/exams/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-forumbee c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.exam.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('certificate_key_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.certificate-keys.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/certificate-keys") || request()->is("admin/certificate-keys/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.certificateKey.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('student_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill-wave c-sidebar-nav-icon">

                    </i>

                    {{ trans('cruds.payment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    {{--                    @can('Unverified_student_access')--}}
                    {{--                        <li class="c-sidebar-nav-item">--}}
                    {{--                            <a href="{{ route("admin.payments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "active" : "" }}">--}}
                    {{--                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">--}}

                    {{--                                </i>--}}
                    {{--                                {{ trans('cruds.payment.programs') }}--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                    @endcan--}}

                    {{--                    @can('approved_student_access')--}}
                    {{--                        <li class="c-sidebar-nav-item">--}}
                    {{--                            <a href="{{ route("admin.payments.lectures") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "active" : "" }}">--}}
                    {{--                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">--}}

                    {{--                                </i>--}}
                    {{--                                {{ trans('cruds.payment.lectures') }}--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                    @endcan--}}
                    @can('payment_method_access')

                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-methods.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-methods") || request()->is("admin/payment-methods/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentMethod.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('reservation_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reservations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reservations") || request()->is("admin/reservations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.reservation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_invoice_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.course-invoices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-invoices") || request()->is("admin/course-invoices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-receipt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.courseInvoice.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bank_list_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bank-lists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-lists") || request()->is("admin/bank-lists/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-money-check-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bankList.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan




        @can('followingusers_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/reservations*") ? "c-show" : "" }} {{ request()->is("admin/enrollments*") ? "c-show" : "" }} {{ request()->is("admin/course-invoices*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.followingusers.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-logs") || request()->is("admin/user-logs/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user_log.title') }}

                            </a>
                        </li>
                    @endcan
                        @php($unread = \App\Models\QaTopic::unreadCount())
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} c-sidebar-nav-link">
                                <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">
                                </i>
                                <span>{{ trans('global.messages') }}</span>
                                @if($unread > 0)
                                    <strong>( {{ $unread }} )</strong>
                                @endif
                            </a>
                        </li>
                </ul>
            </li>
        @endcan


{{--        @can('faq_management_access')--}}
{{--            <li class="c-sidebar-nav-dropdown">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.faqManagement.title') }}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                    @can('faq_category_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.faqCategory.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('faq_question_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.faqQuestion.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        @endcan--}}



{{--        @can('content_management_access')--}}
{{--            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.contentManagement.title') }}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                    @can('content_category_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.contentCategory.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('content_tag_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.contentTag.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

                        @can('blog_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.blogs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blogs") || request()->is("admin/blogs/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.blog.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('blogscomment_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.blogscomments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blogscomments") || request()->is("admin/blogscomments/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-comments c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.blogscomment.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('content_page_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.contentPage.title') }}
                                </a>
                            </li>
                        @endcan
{{--                        @can('job_access')--}}
{{--                            <li class="c-sidebar-nav-item">--}}
{{--                                <a href="{{ route("admin.jobs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/jobs") || request()->is("admin/jobs/*") ? "c-active" : "" }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.job.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('job_application_access')--}}
{{--                            <li class="c-sidebar-nav-item">--}}
{{--                                <a href="{{ route("admin.job-applications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/job-applications") || request()->is("admin/job-applications/*") ? "c-active" : "" }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.jobApplication.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}

{{--                </ul>--}}
{{--            </li>--}}
{{--        @endcan--}}
{{--        @can('website_access')--}}
{{--            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/headers*") ? "c-show" : "" }} {{ request()->is("admin/home-page-sliders*") ? "c-show" : "" }} {{ request()->is("admin/snippets*") ? "c-show" : "" }}">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                    <i class="fa-fw fab fa-adversal c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.website.title') }}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items">--}}



{{--                    @can('home_page_slider_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.home-page-sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/home-page-sliders") || request()->is("admin/home-page-sliders/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fab fa-adversal c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.homePageSlider.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('snippet_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.snippets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/snippets") || request()->is("admin/snippets/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fab fa-adversal c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.snippet.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('founder_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.founders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/founders") || request()->is("admin/founders/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-handshake c-sidebar-nav-icon">--}}
{{--                                </i>--}}
{{--                                {{ trans('cruds.founder.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('coming_soon_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.coming-soons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coming-soons") || request()->is("admin/coming-soons/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fab fa-contao c-sidebar-nav-icon">--}}
{{--                                </i>--}}
{{--                                {{ trans('cruds.comingSoon.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('enquiry_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.enquiries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/enquiries") || request()->is("admin/enquiries/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-question-circle c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.enquiry.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        @endcan--}}




{{--        @can('sponsors_access')--}}
{{--            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/reservations*") ? "c-show" : "" }} {{ request()->is("admin/enrollments*") ? "c-show" : "" }} {{ request()->is("admin/course-invoices*") ? "c-show" : "" }}">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                    <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.sponsors.title') }}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                 --}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        @endcan--}}




        @can('system_email_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">

                    <i class="fa-fw fas fa-money-bill-wave c-sidebar-nav-icon">

                    </i>

                    {{ trans('cruds.system_email.title') }}

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('system_email_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.system-emails.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-emails") || request()->is("admin/system-emails/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.system_email.fields.list') }}

                            </a>
                        </li>
                    @endcan
                    @can('newsletter_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.newsletters.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/newsletters") || request()->is("admin/newsletters/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-adjust c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.newsletter.title') }}
                            </a>
                        </li>
                    @endcan


                </ul>
            </li>
        @endcan
{{--        @can('memberships_access')--}}
{{--            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/reservations*") ? "c-show" : "" }} {{ request()->is("admin/enrollments*") ? "c-show" : "" }} {{ request()->is("admin/course-invoices*") ? "c-show" : "" }}">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                    <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.purchase.title') }}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items">--}}


{{--                </ul>--}}
{{--            </li>--}}
{{--        @endcan--}}






        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif


            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>
