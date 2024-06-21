   <!-- BEGIN: Main Menu-->
   <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if (app()->getLocale() == 'en')
                        <h2 class="brand-text mb-0 text-center"> <img class="pr-1" src="{{ asset('nazil/imgs/logo.png') }}"
                                style="width: 60px;"> {{ trans('panel.site_title') }}</h2>
                    @else
                        <h2 class="brand-text mb-0 text-center" style="font-size: 16px;"> <img
                                src="{{ asset('nazil/imgs/logo.png') }}" style="width: 40px;">
                            {{ trans('panel.site_title') }} </h2>
                    @endif
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->is('admin') ? 'active' : '' }} nav-item">
                <a href="{{ url('/admin') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title"
                        data-i18n="{{ trans('global.dashboard') }}">{{ trans('global.dashboard') }}</span>
                </a>
            </li>
            <li class=" navigation-header"><span>{{ trans('cruds.homePage.title') }}</span>
            </li>
            @can('home_page_access')
                <li
                    class="
                     {{ request()->is('admin/sliders*') ? 'active open' : '' }}
                     {{ request()->is('admin/slider-cards*') ? 'active open' : '' }}
                     {{ request()->is('admin/icon-texts*') ? 'active open' : '' }}
                     {{ request()->is('admin/icon-text-des*') ? 'active open' : '' }}
                     {{ request()->is('admin/partners*') ? 'active open' : '' }}
                     {{ request()->is('admin/accreditation-sponsors*') ? 'active open' : '' }}
                     {{ request()->is('admin/universities*') ? 'active open' : '' }}
                     {{ request()->is('admin/hospitals*') ? 'active open' : '' }}
                     {{ request()->is('admin/nationalities*') ? 'active open' : '' }}
                 nav-item">
                    <a href="#"><i class="feather icon-list"></i><span class="menu-title"
                            data-i18n="{{ trans('cruds.homePage.title') }}">{{ trans('cruds.homePage.title') }}</span></a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('slider_access')
                            <li><a href="{{ route('admin.sliders.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/sliders*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n="{{ trans('cruds.slider.title') }}">{{ trans('cruds.slider.title') }}</span></a>
                            </li>
                        @endcan
                        @can('slider_card_access')
                            <li><a href="{{ route('admin.slider-cards.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/slider-cards*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n="{{ trans('cruds.sliderCard.title') }}">{{ trans('cruds.sliderCard.title') }}</span></a>
                            </li>
                        @endcan
                        @can('icon_text_access')
                            <li><a href="{{ route('admin.icon-texts.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/icon-texts*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n=">{{ trans('cruds.iconText.title') }}">{{ trans('cruds.iconText.title') }}</span></a>
                            </li>
                        @endcan
                        @can('partner_access')
                            <li><a href="{{ route('admin.partners.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/partners*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n=">{{ trans('cruds.partner.title') }}">{{ trans('cruds.partner.title') }}</span></a>
                            </li>
                        @endcan
                        @can('icon_text_de_access')
                            <li><a href="{{ route('admin.icon-text-des.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/icon-text-des*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n=">{{ trans('cruds.iconTextDe.title') }}">{{ trans('cruds.iconTextDe.title') }}</span></a>
                            </li>
                        @endcan
                        @can('accreditation_sponsor_access')
                            <li><a href="{{ route('admin.accreditation-sponsors.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/accreditation-sponsors*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n=">{{ trans('cruds.accreditationSponsor.title') }}">{{ trans('cruds.accreditationSponsor.title') }}</span></a>
                            </li>
                        @endcan
                        @can('university_access')
                            <li><a href="{{ route('admin.universities.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/universities*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n=">{{ trans('cruds.university.title') }}">{{ trans('cruds.university.title') }}</span></a>
                            </li>
                        @endcan
                        @can('hospital_access')
                            <li><a href="{{ route('admin.hospitals.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/hospitals*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n=">{{ trans('cruds.hospital.title') }}">{{ trans('cruds.hospital.title') }}</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('membership_type_access')
                {{-- <li class="
                 {{ request()->is('admin/membership-types*') ? 'active open' : '' }}
                 {{ request()->is('admin/memberships*') ? 'active open' : '' }}
                 {{ request()->is('admin/user-memberships*') ? 'active open' : '' }}
                     nav-item">
                <a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="{{ trans('cruds.memberships.title') }}">{{ trans('cruds.memberships.title') }}</span></a>
                <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                    @can('membership_type_access')
                    <li><a href="{{ route('admin.membership-types.index') }}"><i class="feather icon-circle {{ request()->is('admin/membership-types*') ? 'active' : '' }}"></i><span class="menu-item" data-i18n="{{ trans('cruds.membershipType.title') }}">{{ trans('cruds.membershipType.title') }}</span></a>
                    </li>
                    @endcan
                    @can('membership_access')
                    <li><a href="{{ route('admin.memberships.index') }}"><i class="feather icon-circle {{ request()->is('admin/memberships*') ? 'active' : '' }}"></i><span class="menu-item" data-i18n="{{ trans('cruds.membership.title') }}">{{ trans('cruds.membership.title') }}</span></a>
                    </li>
                    @endcan
                    @can('user_membership_access')
                    <li><a href="{{ route('admin.user-memberships.index') }}"><i class="feather icon-circle {{ request()->is('admin/user-memberships*') ? 'active' : '' }}"></i><span class="menu-item" data-i18n="{{ trans('cruds.userMembership.title') }}">{{ trans('cruds.userMembership.title') }}</span></a>
                    </li>
                    @endcan
                </ul>
            </li> --}}
            @endcan

            @can('student_management_access')
                <li
                    class="
                 {{ request()->is('admin/Unverified-student*') ? 'active open' : '' }}
                 {{ request()->is('admin/binding-student*') ? 'active open' : '' }}
                 {{ request()->is('admin/withdrawal-student*') ? 'active open' : '' }}
                 {{ request()->is('admin/approved-student*') ? 'active open' : '' }}
                 {{ request()->is('admin/Unchecked-student*') ? 'active open' : '' }}
                 {{ request()->is('admin/disapproved-student*') ? 'active open' : '' }}
                 {{ request('type') == 'Unverified-student' ? 'active open' : '' }}
                 {{ request('type') == 'approved-student' ? 'active open' : '' }}
                 nav-item">
                    <a href="#"><i class="feather icon-list"></i><span class="menu-title"
                            data-i18n="{{ trans('cruds.student.title') }}">
                            {{ trans('cruds.student.title') }}</span></a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('Unverified_student_access')
                            <li><a href="{{ route('admin.student.Unverified') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/Unverified-student*') || request('type') == 'Unverified-student' ? 'active' : '' }} "></i><span
                                        class="menu-item"
                                        data-i18n="{{ trans('cruds.student.Unverified') }}">{{ trans('cruds.student.Unverified') }}</span></a>
                            </li>
                        @endcan
                        <!-- @can('unchecked_student_access')
     <li><a href="{{ route('admin.student.Unchecked') }}"><i class="feather icon-circle {{ request()->is('admin/Unchecked-student*') ? 'active' : '' }}"></i><span class="menu-item" data-i18n="{{ trans('cruds.student.Unchecked') }}">{{ trans('cruds.student.Unchecked') }}</span></a>
                                                                    </li>
 @endcan
                                            @can('binding_student_access')
     <li><a href="{{ route('admin.student.binding') }}"><i class="feather icon-circle {{ request()->is('admin/binding-student*') ? 'active' : '' }} "></i><span class="menu-item" data-i18n="{{ trans('cruds.student.binding') }}">{{ trans('cruds.student.binding') }}</span></a>
                                                                    </li>
 @endcan
                                            {{-- @can('withdrawal_student_access') --}}
                                            <li><a href="{{ route('admin.student.withdrawal') }}"><i class="feather icon-circle {{ request()->is('admin/withdrawal-student*') ? 'active' : '' }}"></i><span class="menu-item" data-i18n="{{ trans('cruds.student.withdrawal') }}">{{ trans('cruds.student.withdrawal') }}</span></a>
                                            </li>
                                            {{-- @endcan --}} -->
                        @can('approved_student_access')
                            <li><a href="{{ route('admin.student.approved') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/approved-student*') || request('type') == 'approved-student' ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n="{{ trans('cruds.student.approved') }}">{{ trans('cruds.student.approved') }}</span></a>
                            </li>
                        @endcan
                        <!-- @can('disapproved_student_access')
     <li><a href="{{ route('admin.student.disapproved') }}"><i class="feather icon-circle {{ request()->is('admin/disapproved-student*') ? 'active' : '' }} "></i><span class="menu-item" data-i18n="{{ trans('cruds.student.disapproved') }}">{{ trans('cruds.student.disapproved') }}</span></a>
                                                                    </li>
 @endcan -->
                    </ul>
                </li>
            @endcan

            @can('student_speciality_access')
                <li
                    class=" {{ request()->is('admin/specialties*') ? 'active open' : '' }}
             {{ request()->is('admin/sub-specialties*') ? 'active open' : '' }}   nav-item">
                    <a href="#"><i class="feather icon-list"></i><span class="menu-title"
                            data-i18n="{{ trans('cruds.specialty.title') }}">
                            {{ trans('cruds.specialty.title') }}</span></a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('specialty_access')
                            <li><a href="{{ route('admin.specialties.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/specialties*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n="{{ trans('cruds.specialty.title') }}">{{ trans('cruds.specialty.title') }}</span></a>
                            </li>
                        @endcan
                        @can('sub_specialty_access')
                            <li><a href="{{ route('admin.sub-specialties.index') }}"><i
                                        class="feather icon-circle {{ request()->is('admin/sub-specialties*') ? 'active' : '' }}"></i><span
                                        class="menu-item"
                                        data-i18n="{{ trans('cruds.subSpecialty.title') }}">{{ trans('cruds.subSpecialty.title') }}</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            <li class=" navigation-header"><span>{{ trans('cruds.coursesSection.title') }}</span></li>

            @can('courses_section_access')
                <li
                    class="
                 {{ request()->is('admin/instructors*') ? 'active open' : '' }}
                 {{ request()->is('admin/courses*') ? 'active open' : '' }}
                 {{ request()->is('admin/student-moodles*') ? 'active open' : '' }}
                 {{ request()->is('admin/course-categories*') ? 'active open' : '' }}
                 {{ request()->is('admin/zoom-meetings*') ? 'active open' : '' }}
                 {{ request()->is('admin/cancelation-policies*') ? 'active open' : '' }}
                 {{ request()->is('admin/coupon-codes*') ? 'active open' : '' }}
                  {{-- {{ request()->is("admin/course-quizes*") ? 'active open' : '' }} --}}
                 {{--                     {{ request()->is("admin/course-configrations*") ? "active open" : ""}} --}}
                 nav-item">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.coursesSection.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('instructor_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.instructors.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/instructors*') || request()->is('admin/instructors/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.instructor.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('course_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.courses.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.course.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        {{-- @can('student_moodle_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route('admin.student-moodles.index') }}" class="c-sidebar-nav-link">
                    <i class="feather icon-circle {{ request()->is('admin/student-moodles') || request()->is('admin/student-moodles/*') ? 'active' : '' }}"></i>
                    <span class="menu-item">{{ trans('cruds.studentMoodle.title') }}</span>
                    </a>
            </li>
            @endcan --}}
                        @can('course_category_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.course-categories.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/course-categories') || request()->is('admin/course-categories/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.courseCategory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('coupon_code_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.coupon-codes.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/coupon-codes') || request()->is('admin/coupon-codes/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.couponCode.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('cancelation_policy_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.cancelation-policies.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/cancelation-policies') || request()->is('admin/cancelation-policies/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.cancelationPolicy.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('zoom_meeting_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.zoom-meetings.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/zoom-meetings') || request()->is('admin/zoom-meetings/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.zoomMeeting.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        {{-- @can('course_quize_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.course-quizes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-quizes") || request()->is("admin/course-quizes/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-quidditch c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.courseQuize.title') }}
                    </a>
                </li>
            @endcan --}}

                        {{-- @can('course_configration_access') --}}
                        {{-- <li class="c-sidebar-nav-item"> --}}
                        {{-- <a href="{{ route("admin.course-configrations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-configrations") || request()->is("admin/course-configrations/*") ? "active" : "" }}"> --}}
                        {{-- <i class="fa-fw fas fa-cogs c-sidebar-nav-icon"> --}}

                        {{-- </i> --}}
                        {{-- {{ trans('cruds.courseConfigration.title') }} --}}
                        {{-- </a> --}}
                        {{-- </li> --}}
                        {{-- @endcan --}}
                    </ul>

                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'admin.lookups.index' ? 'active open' : '' }}">
                    <a href="#"><i class="feather icon-menu"></i><span class="menu-title"
                            data-i18n="{{ trans('cruds.course.course_attributes') }}">{{ trans('cruds.course.course_attributes') }}</span></a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @foreach ($lookup_types as $lookup_type)
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.lookups.index', ['type_slug' => $lookup_type->slug]) }}"
                                    class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is("course-lists/{$lookup_type->slug}/index") ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ $lookup_type->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            @endcan



            @can('exams_section_access')
                <li
                    class="c-sidebar-nav-dropdown
                 {{ request()->is('admin/exams-titles*') ? 'active open' : '' }}
                 {{ request()->is('admin/question-banks*') ? 'active open' : '' }}
                 {{ request()->is('admin/exams*') ? 'active open' : '' }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.examsSection.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('exams_title_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.exams-titles.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/exams-titles') || request()->is('admin/exams-titles/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.examsTitle.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('question_bank_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.question-banks.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/question-banks') || request()->is('admin/question-banks/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.questionBank.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('exam_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.exams.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/exams') || request()->is('admin/exams/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.exam.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('certificat_access')
                <li
                    class="c-sidebar-nav-dropdown {{ request()->is('admin/certificats*') ? 'active open' : '' }}
                         {{ request()->is('admin/certificate-keys*') ? 'active open' : '' }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.certificat.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('certificat_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.certificats.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/certificats') || request()->is('admin/certificats/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.certificat.title') }}</span>
                                </a>
                            </li>
                        @endcan

                        @can('certificate_key_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.certificate-keys.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/certificate-keys') || request()->is('admin/certificate-keys/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.certificateKey.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('reservation_access')
                <li
                    class="c-sidebar-nav-dropdown {{ request()->is('admin/payments*') ? 'active open' : '' }}
                 {{ request()->is('admin/payment-methods*') ? 'active open' : '' }}
                 {{ request()->is('admin/reservations*') ? 'active open' : '' }}
                 {{ request()->is('admin/course-invoices*') ? 'active open' : '' }}
                 {{ request()->is('admin/wallets*') ? 'active open' : '' }}
                 {{ request()->is('  admin/cancel-requests/*') ? 'active open' : '' }}
                 {{ request()->is('admin/bank-lists*') ? 'active open' : '' }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.payment.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('payment_method_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.payment-methods.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/payment-methods') || request()->is('admin/payment-methods/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.paymentMethod.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('reservation_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.reservations.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/reservations') || request()->is('admin/reservations/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.reservation.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('course_invoice_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.course-invoices.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/course-invoices') || request()->is('admin/course-invoices/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.courseInvoice.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('wallet_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.wallets.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/wallets') || request()->is('admin/wallets/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.wallet.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('cancel_request_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.cancel-requests.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/cancel-requests') || request()->is('admin/cancel-requests/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.cancelRequest.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('bank_list_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.bank-lists.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/bank-lists') || request()->is('admin/bank-lists/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.bankList.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('point_access')
                <li
                    class="c-sidebar-nav-dropdown
                 {{ request()->is('admin/point-types*') ? 'active open' : '' }}
                 {{ request()->is('admin/point-type-values*') ? 'active open' : '' }}
                  {{ request()->is('admin/points*') ? 'active open' : '' }}
                  {{ request()->is('admin/point-actions*') ? 'active open' : '' }}">


                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="feather icon-list"></i>
                <span class="menu-item">  {{ trans('cruds.point.title') }}</span>
                </a>

                <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                    @can('point_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.point-types.index') }}" class="c-sidebar-nav-link">
                                <i
                                    class="feather icon-circle {{ request()->is('admin/point-types') || request()->is('admin/point-types/*') ? 'active' : '' }}"></i>
                                <span class="menu-item"> {{ trans('cruds.pointType.title') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('point_type_value_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.point-type-values.index') }}" class="c-sidebar-nav-link">
                                <i
                                    class="feather icon-circle {{ request()->is('admin/point-type-values') || request()->is('admin/point-type-values/*') ? 'active' : '' }}"></i>
                                <span class="menu-item">   {{ trans('cruds.pointTypeValue.title') }}</span>
                            </a>
                        </li>
                    @endcan

                        @can('point_data_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.points.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/points') || request()->is('admin/points/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">  {{ trans('cruds.pointData.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('point_action_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.point-actions.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/point-actions') || request()->is('admin/point-actions*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">  {{ trans('cruds.pointAction.title') }}</span>
                                </a>
                            </li>
                        @endcan
                </ul>
                </li>
            @endcan

            @can('sna_report_access')
                <li
                    class="c-sidebar-nav-dropdown
                 {{ request()->is('admin/course-users*') ? 'active open' : '' }}
                 {{ request()->is('admin/user-courses*') ? 'active open' : '' }}
                 {{ request()->is('admin/coupon-code-courses*') ? 'active open' : '' }}">

                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item"> {{ trans('cruds.snaReport.title') }}</span>
                    </a>

                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('courses_user_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.course-users.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/course-users') || request()->is('admin/course-users/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item"> {{ trans('cruds.coursesUser.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_course_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.user-courses.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/user-courses') || request()->is('admin/user-courses/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item"> {{ trans('cruds.userCourse.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('coupon_code_course_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.coupon-code-courses.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/coupon-code-courses') || request()->is('admin/coupon-code-courses/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item"> {{ trans('cruds.couponCodeCourse.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <!----------------->
            @can('blog_access')
                <li
                    class="c-sidebar-nav-dropdown
                 {{ request()->is('admin/system-emails*') ? 'active open' : '' }}
                 {{ request()->is('admin/user-logs*') ? 'active open' : '' }}
                 {{ request()->is('admin/messenger*') ? 'active open' : '' }}
                 {{ request()->is('admin/content-categories*') ? 'active open' : '' }}
                 {{ request()->is('admin/content-tags*') ? 'active open' : '' }}
                 {{ request()->is('admin/enquiries*') ? 'active open' : '' }}
                 {{ request()->is('admin/editors*') ? 'active open' : '' }}
                 ">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.contentManagement.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">

                        @can('content_category_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.content-categories.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/content-categories') || request()->is('admin/content-categories/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.contentCategory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('content_tag_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.content-tags.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/content-tags') || request()->is('admin/content-tags/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.contentTag.title') }}</span>
                                </a>
                            </li>
                        @endcan

                        @can('blog_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.blogs.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.blog.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('blogscomment_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.blogscomments.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/blogscomments') || request()->is('admin/blogscomments/*') ? 'active' : '' }}">
                                    </i>
                                    <span class="menu-item"> {{ trans('cruds.blogscomment.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('content_page_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.content-pages.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/content-pages') || request()->is('admin/content-pages/*') ? 'active' : '' }}">
                                    </i>
                                    <span class="menu-item"> {{ trans('cruds.contentPage.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('enquiry_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.enquiries.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/enquiries') || request()->is('admin/enquiries/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.enquiry.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('editor_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.editors.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/editors') || request()->is('admin/enquiries/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.editor.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <!----------------->

            <li class=" navigation-header"><span>{{ trans('global.setting_and_managment') }}</span></li>

            @can('user_management_access')
                <li
                    class="c-sidebar-nav-dropdown {{ request()->is('admin/permissions*') ? 'active open' : '' }}
                 {{ request()->is('admin/roles*') ? 'active open' : '' }}
                 {{ request('type') == 'users' ? 'active open' : '' }}
                  ">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.userManagement.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('payment_method_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.permission.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.role.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.users.index') }}" class="c-sidebar-nav-link">
                                    <i class="feather icon-circle {{ request('type') == 'users' ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.user.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('followingusers_access')
                <li
                    class="c-sidebar-nav-dropdown {{ request()->is('admin/system-emails*') ? 'active open' : '' }}
                 {{ request()->is('admin/user-logs*') ? 'active open' : '' }}
                 {{ request()->is('admin/user-notifications/*') ? 'active open' : '' }}
                 {{ request()->is('admin/messenger*') ? 'active open' : '' }} ">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.followingusers.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                        @can('user_notification_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.user-notifications.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/user-notifications') || request()->is('admin/user-notifications/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item"> {{ trans('cruds.userNotification.title') }}</span>
                                </a>

                            </li>
                        @endcan
                        @can('notification_campain_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.notification-campains.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/notification-campains') || request()->is('admin/notification-campains/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item"> {{ trans('cruds.notificationCampain.title') }}</span>
                                </a>

                            </li>
                        @endcan


                        @can('user_alert_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.user-alerts.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/system-emails') || request()->is('admin/system-emails/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.userAlert.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_log_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.user-logs.index') }}" class="c-sidebar-nav-link">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/user-logs') || request()->is('admin/user-logs/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.user_log.title') }}</span>
                                </a>
                            </li>
                        @endcan


                        @php($unread = \App\Models\QaTopic::unreadCount())
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.messenger.index') }}" class="c-sidebar-nav-link">
                                <i
                                    class="feather icon-circle {{ request()->is('admin/messenger') || request()->is('admin/messenger/*') ? 'active' : '' }}"></i>
                                <span>{{ trans('global.messages') }}</span>
                                @if ($unread > 0)
                                    <strong>( {{ $unread }} )</strong>
                                @endif

                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('faq_management_access')
                <li
                    class="c-sidebar-nav-dropdown
             {{ request()->is('admin/faq-categories*') ? 'active open' : '' }}
             {{ request()->is('admin/faq-questions*') ? 'active open' : '' }}
        ">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item">{{ trans('cruds.faqManagement.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('faq_category_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.faq-categories.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle  {{ request()->is('admin/faq-categories') || request()->is('admin/faq-categories/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.faqCategory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('faq_question_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.faq-questions.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle {{ request()->is('admin/faq-questions') || request()->is('admin/faq-questions/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item">{{ trans('cruds.faqQuestion.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/system-emails*') ? 'active open' : '' }}
                 {{ request()->is('admin/newsletters*') ? 'active open' : '' }}
                 {{ request()->is('admin/messenger*') ? 'active open' : '' }}
                 {{ request()->is('admin/course-configrations*') ? 'active open' : '' }}
                 ">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="feather icon-list"></i>
                    <span class="menu-item">{{ trans('cruds.courseConfigration.configration') }}</span>
                </a>
                <ul class="c-sidebar-nav-dropdown-items" style="background-color: #edebeb;">
                    @can('system_email_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.system-emails.index') }}" class="c-sidebar-nav-link">
                                <i
                                    class="feather icon-circle  {{ request()->is('admin/system-emails') || request()->is('admin/system-emails/*') ? 'active' : '' }}"></i>
                                <span class="menu-item">{{ trans('cruds.system_email.title') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('newsletter_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.newsletters.index') }}" class="c-sidebar-nav-link">
                                <i
                                    class="feather icon-circle  {{ request()->is('admin/newsletters') || request()->is('admin/newsletters/*') ? 'active' : '' }}"></i>
                                <span class="menu-item">{{ trans('cruds.newsletter.title') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('course_configration_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.course-configrations.index') }}" class="c-sidebar-nav-link">
                                <i
                                    class="feather icon-circle  {{ request()->is('admin/course-configrations') || request()->is('admin/course-configrations/*') ? 'active' : '' }}"></i>
                                <span class="menu-item">{{ trans('cruds.courseConfigration.configration') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            @can('afaq_access')
                <li
                    class="c-sidebar-nav-dropdown
             {{ request()->is('admin/AFAQ/testimonials*') ? 'active open' : '' }}

        ">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-item"> {{ trans('cruds.afaQ.title') }}</span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('testimonial_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route('admin.testimonials.index') }}" class="c-sidebar-nav-link ">
                                    <i
                                        class="feather icon-circle  {{ request()->is('admin/testimonials') || request()->is('admin/testimonials/*') ? 'active' : '' }}"></i>
                                    <span class="menu-item"> {{ trans('cruds.testimonial.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('profile_password_edit')
                <li
                    class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }} nav-item">
                    <a href="{{ route('profile.password.edit') }}">
                        <i
                            class="feather icon-circle {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"></i>
                        <span class="menu-title"
                            data-i18n="{{ trans('global.change_password') }}">{{ trans('global.change_password') }}</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="feather icon-power"></i> <span class="menu-title"
                        data-i18n="{{ trans('global.logout') }}">{{ trans('global.logout') }}</span>
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
